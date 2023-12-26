# This is a sample Python script.

# Press Shift+F10 to execute it or replace it with your code.
# Press Double Shift to search everywhere for classes, files, tool windows, actions, and settings.
import pandas as pd


def candidate_names():
    # Read CSV file into a DataFrame
    df = pd.read_csv('HouseFirstPrefsByCandidateByVoteTypeDownload-27966.csv')

    # Extract full name and create SQL insert statements
    sql_statements = []
    for index, row in df.iterrows():
        if pd.notna(row['Surname']) and pd.notna(row['GivenNm']):
            if 'Informal' in row['Surname'] or 'Informal' in row['GivenNm']:
                # Skip candidates with the word "Informal" in their name
                continue

            full_name = f"{row['GivenNm']} {row['Surname']}"
            # Use backticks to handle apostrophes in names
            full_name = full_name.replace("'", "`")

            capitalized_name = full_name.title()  # Capitalize the first letter of each word
            sql_statement = f"INSERT INTO `candidates`(`name`, `description`) VALUES ('{capitalized_name}', '')"
            sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_candidates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')


def electorates():
    # Read CSV file into a DataFrame
    df = pd.read_csv('HouseFirstPrefsByCandidateByVoteTypeDownload-27966.csv')

    # Create a set to store unique electorates
    unique_electorates = set()

    # Extract electorate information and create SQL insert statements
    sql_statements = []
    for index, row in df.iterrows():
        electorate_key = (row['DivisionNm'], row['StateAb'])

        if electorate_key not in unique_electorates:
            unique_electorates.add(electorate_key)

            # Escape apostrophes in the electorate name using backticks
            electorate_name = row['DivisionNm'].replace("'", "`")

            sql_statement = (
                f"INSERT INTO `electorates`(`name`, `jurisdiction`, `type`, `namesake`, `abolished`, `population`) "
                f"VALUES ('{electorate_name}', '{row['StateAb']}', 'Division', null, null, null)"
            )
            sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_electorates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')


def parties():
    # Read CSV file into a DataFrame
    df = pd.read_csv('HouseFirstPrefsByCandidateByVoteTypeDownload-27966.csv')

    # Create a set to store unique party names
    unique_parties = set()

    # Parties to ignore
    ignored_parties = {'A.L.P.', 'Labor', 'Informal'}

    # Extract party information and create SQL insert statements
    sql_statements = []
    for index, row in df.iterrows():
        party_name = row['PartyNm']

        # Skip parties to ignore
        if party_name in ignored_parties:
            continue

        # Skip 'Australian Labor Party' and 'Liberal'
        if party_name == 'Australian Labor Party' or party_name == 'Liberal':
            continue

        # Check if party_name is not NaN before replacing apostrophes
        if pd.notna(party_name):
            # Escape apostrophes in the party name using backticks
            party_name = party_name.replace("'", "`")

            if party_name not in unique_parties:
                unique_parties.add(party_name)

                sql_statement = (
                    f"INSERT INTO `parties`(`name`, `founded`) "
                    f"VALUES ('{party_name}', null)"
                )
                sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_parties.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')


def calculate_electorate_mapping():
    # Read electorates_insert.sql file and find the electorates' names
    with open('insert_electorates.sql', 'r') as f:
        lines = f.readlines()

    electorate_mapping = {}
    for idx, line in enumerate(lines):
        if 'INSERT INTO `electorates`' in line:
            # Extract electorate name from the line
            electorate_name = line.split("VALUES ('")[1].split("',")[0]
            # Calculate electorate ID based on the index in the file
            electorate_id = 152 + idx
            electorate_mapping[electorate_name] = electorate_id

    return electorate_mapping


def calculate_candidate_mapping():
    # Read candidates_insert.sql file and find the candidates' names
    with open('insert_candidates.sql', 'r') as f:
        lines = f.readlines()

    candidate_mapping = {}
    for idx, line in enumerate(lines):
        if 'INSERT INTO `candidates`' in line:
            # Extract candidate name from the line
            candidate_name = line.split("VALUES ('")[1].split("',")[0]
            # Calculate candidate ID based on the index in the file
            candidate_id = 183 + idx
            candidate_mapping[candidate_name] = candidate_id

    return candidate_mapping


def calculate_party_mapping():
    # Create a mapping of party names to party IDs
    party_mapping = {
        'Australian Labor Party': 1,
        'Liberal': 2,
        'United Australia Party': 3,
        'Pauline Hanson`s One Nation': 4,
        'Independent': 5,
        'The Greens': 6,
        'Liberal Democrats': 7,
        'FUSION: Science, Pirate, Secular, Climate Emergency': 8,
        'Democratic Alliance': 9,
        'Australian Federation Party': 10,
        'The Nationals': 11,
        'Citizens Party': 12,
        'Sustainable Australia Party - Stop Overdevelopment / Corruption': 13,
        'Australian Democrats': 14,
        'Informed Medical Options Party': 15,
        'Shooters, Fishers and Farmers Party': 16,
        'Animal Justice Party': 17,
        'TNL': 18,
        'Indigenous - Aboriginal Party of Australia': 19,
        'Socialist Alliance': 20,
        'NT CLP': 21,
        'Queensland Greens': 22,
        'Australian Values Party': 23,
        'Liberal National Party of Queensland': 24,
        'The Great Australian Party': 25,
        'Katter`s Australian Party (KAP)': 26,
        'Legalise Cannabis Australia': 27,
        'Australian Progressives': 28,
        'National Party': 29,
        'Centre Alliance': 30,
        'Drew Pavlou Democratic Alliance': 31,
        'Jacqui Lambie Network': 32,
        'The Local Party': 33,
        'Victorian Socialists': 34,
        'Derryn Hinch`s Justice Party': 35,
        'Reason Australia': 36,
        'The Greens (WA)': 37,
        'Australian Christians': 38,
        'WESTERN AUSTRALIA PARTY': 39,
        'A.L.P.': 1,  # Mapping A.L.P. to Australian Labor Party
        'Labor': 1  # Mapping Labor to Australian Labor Party
    }
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
    df = pd.read_csv('HouseTcpByCandidateByVoteTypeDownload-27966.csv')

    # Calculate mappings dynamically
    electorate_mapping = calculate_electorate_mapping()
    candidate_mapping = calculate_candidate_mapping()
    party_mapping = calculate_party_mapping()

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

        # Extract relevant information
        election_id = 0  # Assuming election_id is the same for all rows

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
        informal_votes = get_informal_votes('HouseFirstPrefsByCandidateByVoteTypeDownload-27966.csv',
                                            winning_row['DivisionNm'])
        turnout = formal_votes + informal_votes

        # Check division name for apostrophes
        division_name = winning_row['DivisionNm'].replace("'", "`")

        # Calculate twocp_or_majority as xx.xx
        twocp_or_majority = two_cp_or_majority * 100

        # Generate SQL statement
        sql_statement = (
            f"INSERT INTO `elections_electorates` "
            f"(`election_id`, `electorate_id`, `2cp_or_majority`, "
            f"`winning_candidate`, `winning_party`, `second_candidate`, "
            f"`second_party`, `formal_votes`, `informal_votes`, `turnout`) "
            f"VALUES ('{election_id}', '{electorate_mapping[division_name]}', "
            f"'{twocp_or_majority:.2f}', '{winning_candidate_id}', "
            f"'{winning_party_id}', '{losing_candidate_id}', "
            f"'{losing_party_id}', '{formal_votes}', "
            f"'{informal_votes}', '{turnout}')"
        )

        sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_elections_electorates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')


def candidates_elections_electorates():
    # Read CSV file into a DataFrame
    df = pd.read_csv('HouseFirstPrefsByCandidateByVoteTypeDownload-27966.csv')

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
        winner = 1 if row['Elected'] == 'Y' else 0

        # Generate SQL statement
        sql_statement = (
            f"INSERT INTO `candidates_elections_electorates` "
            f"(`candidate_id`, `election_id`, `electorate_id`, `party_id`, "
            f"`votes`, `swing`, `winner`) VALUES "
            f"('{candidate_id}', '0', '{electorate_id}', '{party_id}', "
            f"'{row['TotalVotes']}', '{row['Swing']}', '{winner}')"
        )
        sql_statements.append(sql_statement)

    # Write SQL statements to a file
    with open('insert_candidates_elections_electorates.sql', 'w') as f:
        for statement in sql_statements:
            f.write(statement + ';\n')


# Press the green button in the gutter to run the script.
if __name__ == '__main__':
    candidates_elections_electorates()

# See PyCharm help at https://www.jetbrains.com/help/pycharm/
