# This is a sample Python script.

# Press Shift+F10 to execute it or replace it with your code.
# Press Double Shift to search everywhere for classes, files, tool windows, actions, and settings.
import pandas as pd

val, election, election_id = 12246, 'Fed2004', 6

tcpbycandidate = f'HouseTcpByCandidateByVoteTypeDownload-{val}.csv'
tcpflow = f'HouseTcpFlowByDivisionDownload-{val}.csv'
firstprefs = f'HouseFirstPrefsByCandidateByVoteTypeDownload-{val}.csv'





def candidate_names():
    # Read CSV file into a DataFrame
    df = pd.read_csv(firstprefs)

    # Extract full name and create SQL insert statements
    sql_statements = []
    existing_candidates = set()

    # Check if 'allcandidates.txt' exists and load existing candidate names
    try:
        with open('allcandidates.txt', 'r') as existing_file:
            existing_candidates = set(existing_file.read().splitlines())
    except FileNotFoundError:
        pass  # File doesn't exist, proceed with an empty set

    # Create a list to store newly encountered candidates
    new_candidates = []

    # Iterate through the DataFrame
    for index, row in df.iterrows():
        if pd.notna(row['Surname']) and pd.notna(row['GivenNm']):
            if 'Informal' in row['Surname'] or 'Informal' in row['GivenNm']:
                # Skip candidates with the word "Informal" in their name
                continue

            full_name = f"{row['GivenNm']} {row['Surname']}"
            # Use backticks to handle apostrophes in names
            full_name = full_name.replace("'", "`")

            capitalized_name = full_name.title()  # Capitalize the first letter of each word

            # Check if the candidate is already present in the existing candidates set
            if capitalized_name not in existing_candidates and capitalized_name not in new_candidates:
                # If not, add the candidate to the list and generate SQL statement
                new_candidates.append(capitalized_name)
                sql_statement = f"INSERT INTO `candidates`(`name`, `description`) VALUES ('{capitalized_name}', '')"
                sql_statements.append(sql_statement)

    # Sort new candidate names before writing to 'allcandidates.txt'
    new_candidates.sort()
    with open('allcandidates.txt', 'a') as existing_file:
        for candidate in new_candidates:
            existing_file.write(candidate + '\n')
    sql_statements.sort()
    # Write SQL statements to a file
    with open('insert_candidates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')
    print(f"Number of new candidates added: {len(new_candidates)}")


def electorates():
    # Read CSV file into a DataFrame
    df = pd.read_csv(firstprefs)

    # Create a set to store unique electorates
    unique_electorates = set()

    # Check if 'allelectorates.txt' exists and load existing electorates
    try:
        with open('allelectorates.txt', 'r') as existing_file:
            existing_electorates = set(existing_file.read().splitlines())
    except FileNotFoundError:
        existing_electorates = set()  # File doesn't exist, proceed with an empty set

    # Create a list to store newly encountered electorates
    new_electorates = []

    # Extract electorate information and create SQL insert statements
    sql_statements = []
    for index, row in df.iterrows():
        electorate_key = (row['DivisionNm'], row['StateAb'])

        if electorate_key not in unique_electorates:
            unique_electorates.add(electorate_key)

            # Escape apostrophes in the electorate name using backticks
            electorate_name = row['DivisionNm'].replace("'", "`")

            # Check if the electorate is already present in the existing electorates set
            if electorate_name not in existing_electorates and electorate_name not in new_electorates:
                # If not, add the electorate to the list and generate SQL statement
                new_electorates.append(electorate_name)
                sql_statement = (
                    f"INSERT INTO `electorates`(`name`, `jurisdiction`, `type`, `namesake`, `abolished`, `population`) "
                    f"VALUES ('{electorate_name}', '{row['StateAb']}', 'Division', null, null, null)"
                )
                sql_statements.append(sql_statement)

    # Sort new electorates before writing to 'allelectorates.txt'
    new_electorates.sort()
    with open('allelectorates.txt', 'a') as existing_file:
        for electorate in new_electorates:
            existing_file.write(electorate + '\n')
    sql_statements.sort()
    # Write SQL statements to a file
    with open('insert_electorates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')

    print(f"Number of new electorates added: {len(new_electorates)}")


def parties():
    # Read CSV file into a DataFrame
    df = pd.read_csv(firstprefs)

    # Create a set to store unique party names
    unique_parties = set()

    # Parties to ignore
    ignored_parties = {'Informal'}

    # Read existing parties from allparties.txt
    try:
        with open('allparties.txt', 'r') as f:
            existing_parties = set(f.read().splitlines())
    except FileNotFoundError:
        existing_parties = set()

    # Extract party information and create SQL insert statements
    sql_statements = []
    for index, row in df.iterrows():
        party_name = row['PartyNm']

        # Skip parties to ignore
        if party_name in ignored_parties:
            continue

        # Check if party_name is not NaN before replacing apostrophes
        if pd.notna(party_name):
            # Escape apostrophes in the party name using backticks
            party_name = party_name.replace("'", "`")

            if party_name not in unique_parties and party_name not in existing_parties:
                unique_parties.add(party_name)
                existing_parties.add(party_name)

                # Write the party name to allparties.txt
                with open('allparties.txt', 'a') as all_parties_file:
                    all_parties_file.write(f"{party_name}\n")

                sql_statement = (
                    f"INSERT INTO `parties`(`name`, `founded`) "
                    f"VALUES ('{party_name}', null)"
                )
                sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_parties.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')
    print(f"Number of new parties added: {len(unique_parties)}")


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


def get_informal_votes(csv_file, division_name):
    # Read CSV file into a DataFrame
    df = pd.read_csv(csv_file)

    # Find the entry with DivisionNm = division_name and GivenNm = 'Informal'
    informal_entry = df[(df['DivisionNm'] == division_name) & (df['GivenNm'] == 'Informal')]

    if not informal_entry.empty:
        return informal_entry.iloc[0]['TotalVotes']
    else:
        return 0  # If no Informal entry found, set informal votes to 0


def elections_electorates():
    # Read CSV file into a DataFrame
    df = pd.read_csv(tcpbycandidate)

    # Calculate mappings dynamically
    electorate_mapping = calculate_electorate_mapping()
    candidate_mapping = calculate_candidate_mapping()
    party_mapping = calculate_party_mapping()

    # Load the CSV file
    transfer_df = pd.read_csv(tcpbycandidate)

    # Iterate through the DataFrame to generate SQL statements
    sql_statements = []
    for i in range(0, len(df), 2):
        row1 = df.iloc[i]
        row2 = df.iloc[i + 1]

        # Determine winning and losing candidate rows
        if row1['TotalVotes'] >= row2['TotalVotes']:
            winning_row = row1
            losing_row = row2
        else:
            winning_row = row2
            losing_row = row1

        winning_candidate_name = (winning_row['GivenNm'] + ' ' + winning_row['Surname'].title()).replace("'", "`")
        losing_candidate_name = (losing_row['GivenNm'] + ' ' + losing_row['Surname'].title()).replace("'", "`")

        winning_candidate_id = candidate_mapping[winning_candidate_name]
        winning_party_id = party_mapping[winning_row['PartyNm'].replace("'", "`")]
        losing_candidate_id = candidate_mapping[losing_candidate_name]
        losing_party_id = party_mapping[losing_row['PartyNm'].replace("'", "`")]

        # Calculate 2cp_or_majority
        total_votes_winner = winning_row['TotalVotes']
        total_votes_loser = losing_row['TotalVotes']
        two_cp_or_majority = total_votes_winner / (total_votes_winner + total_votes_loser)

        # Calculate formal votes, informal votes, and turnout
        formal_votes = total_votes_winner + total_votes_loser
        informal_votes = get_informal_votes(firstprefs,
                                            winning_row['DivisionNm'])
        turnout = formal_votes + informal_votes

        # Get the transfer data for the current electorate from transfer_df
        electorate_transfers = transfer_df[transfer_df['DivisionNm'] == winning_row['DivisionNm']]

        # Calculate winning_votes and second_votes, realised after I already had these a few lines back...
        winning_votes = electorate_transfers['TotalVotes'].max()
        second_votes = electorate_transfers['TotalVotes'].min()

        # Check division name for apostrophes
        division_name = winning_row['DivisionNm'].replace("'", "`")

        # Calculate twocp_or_majority as xx.xx
        twocp_or_majority = two_cp_or_majority * 100

        # Generate SQL statement
        sql_statement = (
            f"INSERT INTO `elections_electorates` "
            f"(`election_id`, `electorate_id`, `twocp_or_majority`, "
            f"`winning_candidate`, `winning_party`, `winning_votes`, `second_candidate`, "
            f"`second_party`, `second_votes`, `formal_votes`, `informal_votes`, `turnout`) "
            f"VALUES ('{election_id}', '{electorate_mapping[division_name]}', "
            f"'{twocp_or_majority:.2f}', '{winning_candidate_id}', "
            f"'{winning_party_id}', '{winning_votes}', '{losing_candidate_id}', "
            f"'{losing_party_id}', '{second_votes}', '{formal_votes}', "
            f"'{informal_votes}', '{turnout}')"
        )

        sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_elections_electorates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')


def candidates_elections_electorates():
    # Read CSV file into a DataFrame
    df = pd.read_csv(firstprefs)

    # Calculate mappings
    candidate_mapping = calculate_candidate_mapping()
    electorate_mapping = calculate_electorate_mapping()
    party_mapping = calculate_party_mapping()

    # Extract relevant information and create SQL insert statements
    sql_statements = []
    for index, row in df.iterrows():
        # Skip rows where GivenNm is 'Informal'
        if row['GivenNm'] == 'Informal':
            continue

        # Calculate candidate_id
        candidate_name = f"{row['GivenNm']} {row['Surname'].title()}".replace("'", "`")
        candidate_id = candidate_mapping.get(candidate_name)

        # Calculate electorate_id
        electorate_id = electorate_mapping.get(row['DivisionNm'].replace("'", "`"))

        # Calculate party_id
        party_id = party_mapping.get(str(row['PartyNm']).replace("'", "`"))

        # Calculate winner
        winner = 1 if row['Elected'] in ('Y', '#') else 0
        prev_winner = 1 if row['HistoricElected'] == 'Y' else 0

        # Generate SQL statement
        sql_statement = (
            f"INSERT INTO `candidates_elections_electorates` "
            f"(`candidate_id`, `election_id`, `electorate_id`, `party_id`, "
            f"`votes`, `swing`, `winner`, `prev_winner`) VALUES "
            f"('{candidate_id}', '{election_id}', '{electorate_id}', '{party_id}', "
            f"'{row['TotalVotes']}', '{row['Swing']}', '{winner}', '{prev_winner}')"
        )
        sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_candidates_elections_electorates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')

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


# Press the green button in the gutter to run the script.
if __name__ == '__main__':
    candidate_names()
    electorates()
    parties()
    elections_electorates()
    candidates_elections_electorates()
    combine_sql_files(f'combined_{election}.sql', 'insert_candidates.sql',
                      'insert_electorates.sql', 'insert_parties.sql','insert_elections_electorates.sql',
                      'insert_candidates_elections_electorates.sql')

# See PyCharm help at https://www.jetbrains.com/help/pycharm/
