import os
import requests
import chardet
import pandas as pd
import re

# Specify the path to the file
file_path = '2001/2001repsnsw.txt'  # Replace with the actual path
election_id = 7

def download_files():
    # Define base URL
    base_url = "http://psephos.adam-carr.net/countries/a/australia/"

    # Define states and elections
    states = ['nsw', 'vic', 'sa', 'nt', 'wa', 'qld', 'tas', 'act']
    elections = ['2001', '1998', '1996', '1993', '1990', '1987', '1984', '1983', '1980', '1977', '1975', '1974', '1972',
                 '1969', '1966', '1963', '1961', '1958', '1955', '1954', '1951', '1949', '1946', '1943', '1940', '1937',
                 '1934', '1931', '1929', '1928', '1925', '1922', '1919', '1917', '1914', '1913', '1910', '1906', '1903',
                 '1901']

    # Create folders for each year
    for election in elections:
        os.makedirs(election, exist_ok=True)

    # Download files for each state and election
    for state in states:
        for election in elections:
            url = f"{base_url}{election}/{election}reps{state}.txt"
            response = requests.get(url)

            if response.status_code == 200:
                # Save the file in the corresponding year folder
                with open(f"{election}/{election}reps{state}.txt", 'wb') as file:
                    file.write(response.content)
                print(f"Downloaded: {election}reps{state}.txt")
            else:
                print(f"Failed to download: {election}reps{state}.txt")


def detect_encoding(file_path):
    with open(file_path, 'rb') as file:
        raw_data = file.read()
        result = chardet.detect(raw_data)
        return result['encoding']


def remove_header(file_path):
    encoding = detect_encoding(file_path)

    with open(file_path, 'r', encoding=encoding) as file:
        lines = file.readlines()

    # Find the line with the first comma
    comma_line_index = next((i for i, line in enumerate(lines) if ',' in line), None)

    if comma_line_index is not None:
        # Delete everything before the line with the first comma
        del lines[:comma_line_index]

        # Save the modified content back to the file
        with open(file_path, 'w', encoding=encoding) as file:
            file.writelines(lines)


def process_files():
    # Iterate through all files in the current directory and its subdirectories
    for root, dirs, files in os.walk('.'):
        for filename in files:
            if filename.endswith(".txt"):
                file_path = os.path.join(root, filename)
                remove_header(file_path)




def extract_candidate_names(file_path):
    # Read the file content
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        lines = file.readlines()

    # Find the line indices where the candidate names start and end
    start_index = None
    end_index = None
    all_candidate_names = []

    for i, line in enumerate(lines):
        if "Candidate" in line:
            start_index = i + 2  # Skip two lines to reach the actual names

        elif "Total" in line and start_index is not None and end_index is None:
            end_index = i - 2  # Exclude the line with "Total" and the line before it


            # Process the candidate names for this electorate
            candidate_lines = lines[start_index:end_index + 1]
            candidate_names = []

            for line in candidate_lines:
                split_index = line.find('   ')  # Find the first instance of 5 consecutive spaces

                if split_index != -1:
                    left_side = line[:split_index].strip()
                    candidate_names.append(left_side)
                else:
                    print(f"No 5 consecutive spaces found in the line: {line}")

            # Add candidate names for this electorate to the overall list
            all_candidate_names.extend(candidate_names)

            # Reset indices after processing an electorate
            start_index = None
            end_index = None

    if not all_candidate_names:
        print("Candidate names or Total not found in the file.")

    return all_candidate_names

def update_allcandidates(candidate_names):
    all_candidates_path = 'allcandidates.txt'

    # Remove asterisks, plus signs, and replace apostrophes with backticks
    cleaned_candidate_names = [name.replace('*', '').replace('+', '').replace("'", "`").strip().title() for name in candidate_names]

    # Check existing candidates
    try:
        with open(all_candidates_path, 'r') as f:
            existing_candidates = set(f.read().splitlines())
    except FileNotFoundError:
        existing_candidates = set()

    # Identify new candidates
    new_candidates = [name for name in cleaned_candidate_names if name not in existing_candidates]

    # Update and add new candidates to allcandidates.txt
    with open(all_candidates_path, 'a') as f:
        for candidate in new_candidates:
            f.write(candidate + '\n')

    return new_candidates





def generate_insert_statements(new_candidates):
    sql_statements = []
    for candidate in new_candidates:
        # Use backticks to handle apostrophes in names
        candidate = candidate.replace("'", "`")

        # Remove asterisk from the winner's name
        candidate = candidate.replace('*', '')
        candidate = candidate.replace('+', '')

        # Capitalize the first letter of each word
        capitalized_name = ' '.join(part.title() for part in candidate.split())

        # Generate SQL statement
        sql_statement = f"INSERT INTO `candidates`(`name`, `description`) VALUES ('{capitalized_name}', '')"
        sql_statements.append(sql_statement)

    with open('insert_candidates.sql', 'w') as file:
        for statement in sql_statements:
            file.write(statement + ';\n')
    return sql_statements



def extract_and_update_electorates(file_path, allelectorates_path):
    # Read the file content
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        lines = file.readlines()

    # Find lines with ", NSW" (or other state abbreviations) to identify electorate names
    electorate_lines = [line.strip() for line in lines if re.search(r',\s*(NSW|Vic|Qld|WA|SA|Tas|ACT|NT)', line)]

    for i in range(len(electorate_lines)):
        electorate_lines[i] = electorate_lines[i].split(',')[0].strip().title()

    # Check existing electorates
    try:
        with open(allelectorates_path, 'r') as f:
            existing_electorates = set(f.read().splitlines())
    except FileNotFoundError:
        existing_electorates = set()

    # Identify new electorates, excluding those with colons or 'Born ' in the name
    new_electorates = [
        line.split(',')[0].strip().title()
        for line in electorate_lines
        if line not in existing_electorates
        and ':' not in line
        and 'Born ' not in line
        and '.' not in line
        and 'President' not in line
    ]

    # Update and add new electorates to allelectorates.txt
    with open(allelectorates_path, 'a') as f:
        for electorate in new_electorates:
            f.write(electorate + '\n')

    # Write to insert_electorates.sql
    jurisdiction = os.path.splitext(os.path.basename(file_path))[0][-3:].upper()  # Extract state abbreviation from file_path
    with open('insert_electorates.sql', 'a') as sql_file:
        for electorate in new_electorates:
            sql_file.write(f"INSERT INTO `electorates`(`name`, `jurisdiction`, `type`, `namesake`, `abolished`, `population`) VALUES "
                           f"('{electorate}', '{jurisdiction}', 'Division', NULL, NULL, NULL);\n")

    return new_electorates

def extract_parties(file_path):
    allparties_path = 'allparties.txt'

    # Read existing party names from allparties.txt
    try:
        with open(allparties_path, 'r') as f:
            existing_party_names = set(f.read().splitlines())
    except FileNotFoundError:
        existing_party_names = set()

    # Read the file content
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        lines = file.readlines()


    # Find the line indices where the candidate names start and end
    start_index = None
    end_index = None
    party_names = set()

    for i, line in enumerate(lines):
        if "Candidate" in line:
            start_index = i + 2  # Skip two lines to reach the actual names

        elif "Total" in line and start_index is not None and end_index is None:
            end_index = i - 2  # Exclude the line with "Total" and the line before it

            # Process the candidate names for this electorate
            candidate_lines = lines[start_index:end_index + 1]

            # Extract party names from candidate lines
            for line in candidate_lines:
                split_index = line.find('   ')  # Find the first instance of 5 consecutive spaces

                if split_index != -1:
                    right_side = line[split_index + 3:].strip()  # Extract the right side after the 3 spaces

                    # Check if there is a party name (should contain alphabetic characters)
                    if any(char.isalpha() for char in right_side):
                        party_name_split = right_side.split(maxsplit=1)

                        if len(party_name_split) > 1:
                            party_name = party_name_split[0].strip()

                            # Check if the party name is not in existing_party_names before adding
                            if party_name not in existing_party_names:
                                party_names.add(party_name)

            # Reset indices after processing an electorate
            start_index = None
            end_index = None

    # Update and add new party names to allparties.txt
    with open(allparties_path, 'a') as f:
        for party_name in party_names:
            f.write(party_name + '\n')

        # Generate and write SQL insert statements to insert_parties.sql
    with open('insert_parties.sql', 'a') as f_insert_parties:
        for party_name in party_names:
            # Generate SQL insert statement with description and founded set to null
            sql_statement = f"INSERT INTO `parties`(`name`, `description`, `founded`) VALUES ('{party_name}', 'No information available.', NULL)"
            f_insert_parties.write(sql_statement + ';\n')

    return list(party_names)


def calculate_electorate_mapping():
    # Read allelectorates.txt file and find the electorates' names
    try:
        with open('allelectorates.txt', 'r') as f:
            electorates = f.read().splitlines()
    except FileNotFoundError:
        electorates = []

    electorate_mapping = {}
    for idx, electorate_name in enumerate(electorates, start=1):
        electorate_mapping[electorate_name] = idx

    return electorate_mapping


def calculate_candidate_mapping():
    # Read allcandidates.txt file and find the candidates' names
    try:
        with open('allcandidates.txt', 'r') as f:
            candidates = f.read().splitlines()
    except FileNotFoundError:
        candidates = []

    candidate_mapping = {}
    for idx, candidate_name in enumerate(candidates, start=1):
        candidate_mapping[candidate_name] = idx

    return candidate_mapping


def calculate_party_mapping():
    # Read allparties.txt file and find the parties' names
    try:
        with open('allparties.txt', 'r') as f:
            parties = f.read().splitlines()
    except FileNotFoundError:
        parties = []

    party_mapping = {party: idx + 1 for idx, party in enumerate(parties)}

    return party_mapping
def extract_and_insert_election_electorate_data(file_path, insert_file_path):
    # Read the file content
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        lines = file.readlines()

    # List to store extracted data
    extracted_data = []

    # Exclusion rules
    exclusion_keywords = [':', 'Born ', '.', 'President']

    # Iterate through the lines in the file
    for i, line in enumerate(lines):
        # Check if the line contains a state or territory acronym
        if re.search(r',\s*(NSW|Vic|Qld|WA|SA|Tas|ACT|NT)\s*$', line):
            # If the condition is met, add the current line and subsequent lines to the list until the next condition is met
            data_chunk = [line.strip()]
            j = i + 1  # Start from the next line
            while j < len(lines) and not re.search(r',\s*(NSW|Vic|Qld|WA|SA|Tas|ACT|NT)\s*$', lines[j]):
                data_chunk.append(lines[j].strip())
                j += 1
            if not any(keyword in data_chunk[0] for keyword in exclusion_keywords):
                # Add the extracted data chunk to the list
                extracted_data.append(data_chunk)

    # Calculate electorate mapping
    electorate_mapping = calculate_electorate_mapping()
    ee_count = 0
    # Open the output file for writing
    with open(insert_file_path, 'w') as output_file:
        # Iterate through the extracted data
        for data_chunk in extracted_data:
            # Extract electorate name (on the first line, all text prior to the comma)
            electorate_name = re.split(r',', data_chunk[0])[0].strip().title()

            # Get electorate_id from the mapping
            electorate_id = electorate_mapping.get(electorate_name)



            winning_candidate = winning_party = winning_votes = second_candidate = second_party = second_votes = formal_votes = informal_votes = turnout = 'null'

            for i in range(len(data_chunk)):
                current_line = data_chunk[i].strip()

                # Check if the lines start with the relevant information
                if current_line.startswith("Votes cast"):
                    # Extract turnout from the current line
                    turnout = int(
                        re.search(r'(\d{1,3}(?:,\d{3})*)\s+\d+\.\d+\s+[+-]?\d+\.\d+$', current_line).group(1).replace(
                            ',', ''))



                elif current_line.startswith("Informal votes"):
                    # Extract informal votes from the current line
                    informal_votes = int(
                        re.search(r'(\d{1,3}(?:,\d{3})*)\s+\d+\.\d+\s+[+-]?\d+\.\d+$', current_line).group(1).replace(
                            ',', ''))



                elif current_line.startswith("Formal votes"):
                    # Extract formal votes from the current line
                    formal_votes = int(
                        re.search(r'(\d{1,3}(?:,\d{3})*)\s+\d+\.\d+\s+[+-]?\d+\.\d+$', current_line).group(1).replace(
                            ',', ''))



            # Iterate from the end of the data chunk
            for i in range(len(data_chunk) - 1, 0, -1):
                current_line = data_chunk[i].strip()
                next_line = data_chunk[i - 1].strip()


                # Check if both lines end in a decimal
                if re.search(r'\b\d+\.\d+$', current_line) and re.search(r'\b\d+\.\d+$', next_line):
                    # Extract the decimal values
                    current_decimal = float(re.search(r'(\d+\.\d+)$', current_line).group(1))
                    next_decimal = float(re.search(r'(\d+\.\d+)$', next_line).group(1))

                    # Extract winning votes and second votes from the numeric values prior to current decimal and next decimal
                    winning_votes = int(
                        re.search(r'(\d{1,3}(?:,\d{3})*)\s+\d+\.\d+$', next_line).group(1).replace(',', ''))
                    second_votes = int(
                        re.search(r'(\d{1,3}(?:,\d{3})*)\s+\d+\.\d+$', current_line).group(1).replace(',', ''))



                    # Set twocp_or_majority to the larger of the two decimals
                    twocp_or_majority = max(current_decimal, next_decimal)

                    # Extract the two surnames from the lines
                    current_surname = re.split(r'\s\s\s+', current_line)[0].strip()
                    next_surname = re.split(r'\s\s\s+', next_line)[0].strip()

                    # Apply transformations to the surnames
                    winning_surname = current_surname.replace('*', '').replace('+', '').replace("'",
                                                                                                "`").strip().title()
                    second_surname = next_surname.replace('*', '').replace('+', '').replace("'", "`").strip().title()

                    start_index = None
                    end_index = None
                    all_candidate_names = []

                    for i, line in enumerate(data_chunk):
                        if "Candidate" in line:
                            start_index = i + 2  # Skip two lines to reach the actual names

                        elif "Total" in line and start_index is not None and end_index is None:
                            end_index = i - 2  # Exclude the line with "Total" and the line before it

                            # Print the text between start and end indices
                            candidates_and_results = data_chunk[start_index:end_index + 1]

                            for line in candidates_and_results:
                                line_upper = line.upper()  # Make the comparison case-insensitive
                                split_index = line.find('   ')

                                if split_index != -1:
                                    candidate_name = line[:split_index].strip()
                                    candidate_name = candidate_name.replace('*', '').replace('+', '').replace("'",
                                                                                                              "`").strip().title()

                                    if winning_surname.upper() in line_upper:
                                        winning_candidate = calculate_candidate_mapping().get(candidate_name)
                                    elif second_surname.upper() in line_upper:
                                        second_candidate = calculate_candidate_mapping().get(candidate_name)

                                    candidate_info = line[split_index:].strip()

                                    # Find the party from the right split
                                    party = None
                                    party_candidate_info = candidate_info.split()
                                    for element in party_candidate_info:
                                        if element.isalpha():
                                            party = element
                                            break

                                    if winning_surname.upper() in line_upper:
                                        winning_candidate = calculate_candidate_mapping().get(candidate_name)
                                        winning_party = calculate_party_mapping().get(
                                            party) if party else 'NULL'  # Set to 'UNKNOWN' if party is not found
                                    elif second_surname.upper() in line_upper:
                                        second_candidate = calculate_candidate_mapping().get(candidate_name)
                                        second_party = calculate_party_mapping().get(
                                            party) if party else 'NULL'  # Set to 'UNKNOWN' if party is not found


                            # Reset indices after processing an electorate
                            start_index = None
                            end_index = None




                    # Exit the loop once we've found the values
                    break

            # Create the SQL statement
            sql_statement = f"INSERT INTO `elections_electorates`(`election_id`, `electorate_id`, `twocp_or_majority`, `winning_candidate`, `winning_party`, `winning_votes`, `second_candidate`, `second_party`, `second_votes`, `formal_votes`, `informal_votes`, `turnout`) VALUES ({election_id},{electorate_id},{twocp_or_majority},{winning_candidate},{winning_party},{winning_votes},{second_candidate},{second_party},{second_votes},{formal_votes},{informal_votes},{turnout});"

            # Write the SQL statement to the output file
            output_file.write(sql_statement + ';\n')
            ee_count += 1
    print(f"New EEs added: {ee_count}")


def generate_candidates_elections_electorates_sql(file_path):
    # Open the file and read its contents
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        lines = file.readlines()

        # List to store extracted data
    extracted_data = []
    # Placeholder values for each field
    candidate_id = 'NULL'
    electorate_id = 'NULL'
    party_id = 'NULL'
    votes = 'NULL'
    swing = 'NULL'
    winner = 'NULL'
    prev_winner = 'NULL'
    winning_surname = ''

        # Exclusion rules
    exclusion_keywords = [':', 'Born ', '.', 'President']

    start_index = None
    end_index = None
    sql_statements = []

    # Iterate through the lines in the file
    for i, line in enumerate(lines):
    # Check if the line contains a state or territory acronym
        if re.search(r',\s*(NSW|Vic|Qld|WA|SA|Tas|ACT|NT)\s*$', line):
        # If the condition is met, add the current line and subsequent lines to the list until the next condition is met
            data_chunk = [line.strip()]
            j = i + 1  # Start from the next line
            while j < len(lines) and not re.search(r',\s*(NSW|Vic|Qld|WA|SA|Tas|ACT|NT)\s*$', lines[j]):
                data_chunk.append(lines[j].strip())
                j += 1
            if not any(keyword in data_chunk[0] for keyword in exclusion_keywords):
            # Add the extracted data chunk to the list
                extracted_data.append(data_chunk)

    for data_chunk in extracted_data:

        # Iterate from the end of the data chunk
        for i in range(len(data_chunk) - 1, 0, -1):
            current_line = data_chunk[i].strip()
            next_line = data_chunk[i - 1].strip()

            # Check if both lines end in a decimal
            if re.search(r'\b\d+\.\d+$', current_line) and re.search(r'\b\d+\.\d+$', next_line):
                current_surname = current_line.split()[0].title()
                next_surname = next_line.split()[0].title()

                # Set the winning candidate's surname
                winning_surname = current_surname if float(current_line.split()[-1]) > float(
                    next_line.split()[-1]) else next_surname

                # Print the result (you can replace the print statement with your actual logic)

                break

        for i, line in enumerate(lines):
            # Extract electorate name from the first line
            electorate_name = data_chunk[0].split(',')[0].strip().title()

        # Get electorate_id from electorate_mapping
            electorate_id = calculate_electorate_mapping().get(electorate_name)

            if "Candidate" in line:
                start_index = i + 2  # Skip two lines to reach the actual names

            elif "Total" in line and start_index is not None and end_index is None:
                end_index = i - 2  # Exclude the line with "Total" and the line before it

                # Print the text between start and end indices
                candidates_and_results = data_chunk[start_index:end_index + 1]

                for line in candidates_and_results:
                    if not line or line.startswith(('Total', '---')) or not re.match(r'^[A-Za-z\'-]+\s+[A-Za-z\'-]+',
                                                                                     line):
                        break
                    line_upper = line.upper()  # Make the comparison case-insensitive
                    split_index = line.find('   ')
                    swing = 'NULL'
                    if split_index != -1:
                        candidate_name = line[:split_index].strip()

                        if '*' in candidate_name:
                            prev_winner = 1
                            winner = 0
                        elif '+' in candidate_name:
                            prev_winner = 0
                            winner = 1
                        else:
                            prev_winner = 0
                            winner = 0
                        if winning_surname in candidate_name.title():
                            winner = 1
                        candidate_name = candidate_name.replace('*', '').replace('+', '').replace("'",
                                                                                                  "`").strip().title()
                        candidate_id = calculate_candidate_mapping().get(candidate_name)
                        candidate_info = line[split_index:].strip()

                        # Find the party from the right split
                        party = None
                        party_candidate_info = candidate_info.split()

                        for element in party_candidate_info:
                            if element.isalpha():
                                party = element
                            elif '.' not in element:
                                votes = int(element.replace(',', ''))
                            elif element[0] in ('+', '-'):
                                swing = float(element.replace('+', ''))



                        party_id = calculate_party_mapping().get(
                            party) if party else 'NULL'  # Set to 'UNKNOWN' if party is not found

                        # Generate the SQL statement with placeholders
                        sql_statement = (
                            f"INSERT INTO `candidates_elections_electorates` "
                            f"(`candidate_id`, `election_id`, `electorate_id`, `party_id`, `votes`, `swing`, `winner`, `prev_winner`) "
                            f"VALUES "
                            f"({candidate_id}, {election_id}, {electorate_id}, {party_id}, {votes}, {swing}, {winner}, {prev_winner});"
                        )

                        sql_statements.append(sql_statement)
                start_index = None
                end_index = None
    with open('insert_candidates_elections_electorates.sql', 'w') as sql_file:
        for statement in sql_statements:
            sql_file.write(statement + ';\n')
    print(f"New CEEs added: {len(sql_statements)}")


def combine_sql_files(output_filename, *input_filenames):
    try:
        # Open the output file in write mode
        with open(output_filename, 'w') as output_file:
            # Iterate over each input filename
            for input_filename in input_filenames:
                try:
                    # Open each input file in read mode
                    with open(input_filename, 'r') as input_file:
                        # Read the content of the input file
                        file_content = input_file.read()
                        # Write the content to the output file
                        output_file.write(file_content)
                except FileNotFoundError:
                    print(f"File not found: {input_filename}")
    except Exception as e:
        print(f"Error combining files: {e}")


if __name__ == "__main__":


    # Extract candidate names
    candidate_names = extract_candidate_names(file_path)

    # Update allcandidates.txt and get new candidates
    new_candidates = update_allcandidates(candidate_names)

    # Generate SQL insert statements for new candidates
    sql_statements = generate_insert_statements(new_candidates)

    # Display the results
    print(f"New candidates added: {len(new_candidates)}")

    new_electorates = extract_and_update_electorates(file_path, allelectorates_path='allelectorates.txt')

    print(f"New electorates added: {len(new_electorates)}")

    new_parties = extract_parties(file_path)

    print(f"New parties added: {len(new_parties)}")

    extract_and_insert_election_electorate_data(file_path, insert_file_path="insert_elections_electorates.sql")

    generate_candidates_elections_electorates_sql(file_path)

    combine_sql_files(f'combined_{file_path[:4]}.sql', 'insert_candidates.sql',
                      'insert_electorates.sql', 'insert_parties.sql','insert_elections_electorates.sql',
                      'insert_candidates_elections_electorates.sql')

