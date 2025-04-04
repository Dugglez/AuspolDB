<?php ?>
<div class="container text-center"></div>
<main class="main">
    <div class="container">
        <div class="content">

            <div class="row">
                <div class="column">
                    <h1>Elections</h1>
                    In Australia, members of parliament are elected using various systems that have evolved over time. This page will provide information on the specifics of these systems.
                    <br>    <br>
                    <h2>Federal</h2>
                    Prior to 1927, Federal Parliament sat at the Victorian Parliament. It then moved to Canberra, in what is now Old Parliament House. In 1988, it moved to New Parliament House, where it sits today.
                   <br><br>
                    <h3>House of Representatives</h3>
                    At the first Australian election in <?php
                    echo $this->Html->link(
                        '1901',
                        ['controller' => 'Elections', 'action' => 'view', 46]
                    );
                    ?>, 65 divisions (also known as electorates or seats) elected members. Of these, 63 were single-member electorates,
                    meaning they elected one member. The divisions of <?php
                    echo $this->Html->link(
                        'Tasmania',
                        ['controller' => 'Electorates', 'action' => 'view', 217]
                    );
                    ?> and <?php
                    echo $this->Html->link(
                        'South Australia',
                        ['controller' => 'Electorates', 'action' => 'view', 216]
                    );
                    ?> (which were divided into single member electorates at the next election) elected
                    five and seven members respectively. These members were elected using the First-past-the-post voting system, where a voter had one vote and the candidate with
                    the most votes was elected. Voting was restricted to men in 1901, but was expanded to include women in 1902.
                    In 1918, the Nationalist and Country parties were defeated in the Swan by-election by the Labor party. The two conservative parties
                    contesting the by-election split the conservative vote which allowed Labor to win. Subsequently, the Nationalist government introduced full preferential voting.
                    Voters were now required to number their ballot in order of preference. In 1924, voting in federal elections was made compulsory. Section 24 of the Constitution ties the number of Members of the House of Representatives to the senate.
                    In <?php
                    echo $this->Html->link(
                        '1949',
                        ['controller' => 'Elections', 'action' => 'view', 28]
                    );
                    ?>, the number of senators for each state was increased from six to ten, and the House of Representatives was expanded from 75 seats to 123 seats.
                    In <?php
                    echo $this->Html->link(
                        '1984',
                        ['controller' => 'Elections', 'action' => 'view', 13]
                    );
                    ?>, the number of senators was increased from ten to twelve, and the House of Representatives was expanded from 125 to 148 seats. Federal elections
                    generally occur every three years, but the Governor-General can dissolve parliament earlier on the advice of the Prime Minister. The last time this happened was <?php
                    echo $this->Html->link(
                        '1998',
                        ['controller' => 'Elections', 'action' => 'view', 8]
                    );
                    ?>.
                    <br>    <br>
                    <h3>Senate</h3>
                    At the first Australian election in <?php
                    echo $this->Html->link(
                        '1901',
                        ['controller' => 'Elections', 'action' => 'view', 46]
                    );
                    ?>, the six states elected six senators. Each voter had six votes (not six preferences, but six votes which were all counted),
                    and the top six candidates were elected. Of those six, the top three were elected for six year terms, and the bottom three were elected for three year terms.
                    Subsequently, only three members were elected at Senate election until 1914. Section 57 of the Constitution provides a mechanism for a government to render all
                    Senate seats vacant rather than half, if a requirement of legislative blockage by the Senate is met. This is known as a double dissolution election, and the first
                    double dissolution election was held in <?php
                    echo $this->Html->link(
                        '1914',
                        ['controller' => 'Elections', 'action' => 'view', 41]
                    );
                    ?>. Six other double dissolution elections were held in <?php
                    echo $this->Html->link(
                        '1951',
                        ['controller' => 'Elections', 'action' => 'view', 27]
                    );
                    ?>, <?php
                    echo $this->Html->link(
                        '1974',
                        ['controller' => 'Elections', 'action' => 'view', 18]
                    );
                    ?>, <?php
                    echo $this->Html->link(
                        '1975',
                        ['controller' => 'Elections', 'action' => 'view', 17]
                    );
                    ?>, <?php
                    echo $this->Html->link(
                        '1983',
                        ['controller' => 'Elections', 'action' => 'view', 14]
                    );
                    ?>, <?php
                    echo $this->Html->link(
                        '1987',
                        ['controller' => 'Elections', 'action' => 'view', 12]
                    );
                    ?> and <?php
                    echo $this->Html->link(
                        '2016',
                        ['controller' => 'Elections', 'action' => 'view', 2]
                    );
                    ?>. In <?php
                    echo $this->Html->link(
                        '1949',
                        ['controller' => 'Elections', 'action' => 'view', 28]
                    );
                    ?>, the Senate was
                    expanded from six seats per state to ten. The voting system was also changed from the block voting system (which produced disproportionate results) to the
                    Single Transferable Vote system. Senators were now elected with a quota of the votes, rather than candidates with the most votes being elected.
                    Generally, Senate elections are held on the same day as House of Representatives elections. Between 1951 and 1970, however, the two cycles of the two houses
                    were put out of sync. The <?php
                    echo $this->Html->link(
                        '1953',
                        ['controller' => 'Elections', 'action' => 'view', 50]
                    );
                    ?> Senate election was the first to be held without a House of Representatives election, and the <?php
                    echo $this->Html->link(
                        '1970',
                        ['controller' => 'Elections', 'action' => 'view', 47]
                    );
                    ?> Senate election was the last.
                    In 1974, four senators, two from the ACT and two from the NT were elected for the first time, following legislation which gave them Senate representation for the first time.
                    In <?php
                    echo $this->Html->link(
                        '1984',
                        ['controller' => 'Elections', 'action' => 'view', 13]
                    );
                    ?>, the Senate was expanded from ten to twelve senators per state. At the same time, the Hawke Government also introduced the Group Voting Ticket system. Under
                    the system, voters could choose to either nominate preferences for every candidate using the bottom half of the ballot (which was becoming more difficult as more parties began to contest the Senate),
                    or number one box on the top half of the ballot, which would have their preferences nominated by their preferred party on their behalf based on a registered ticket.
                    Rates of informality (or invalid votes) decreased, however the system led to some candidates with low primary votes but effective negotiating skills being elected.
                    The most well known example of this federally is <?php
                    echo $this->Html->link(
                        'Ricky Muir',
                        ['controller' => 'Candidates', 'action' => 'view', 15428]
                    );
                    ?>, who was elected as a senator for Victoria in 2013 with 0.51% of the vote. The 2013 result, and the Abbott and Turnbull governments' difficulty in dealing with the senators
                    it provided, led the Turnbull government to abolish the Group Voting Ticket. Voters could now choose to number at least six parties above the line, or twelve below the line,
                    though they could number more if they wished.

                    <br>    <br>
                    <h2>Victoria</h2>
                    During the years that the Federal Parliament sat in the Victorian Parliament, the Victorian Parliament sat at the Royal Exhibition Building.
                    Prior to 1870, Members of the Victorian Parliament were not paid a salary.
                    <br>    <br>
                    <h3>Legislative Council</h3>
                    The First Victorian Legislative Council, an upper house like the later Federal Senate, was convened in <?php
                    echo $this->Html->link(
                        '1851',
                        ['controller' => 'Elections', 'action' => 'view', 114]
                    );
                    ?>, with some members being appointed and others being elected.
                    The Second Victorian Legislative Council was wholly elected in <?php
                    echo $this->Html->link(
                        '1856',
                        ['controller' => 'Elections', 'action' => 'view', 117]
                    );
                    ?>, following the Constitution of Victoria receiving royal assent.
                    5 members for each of the six provinces of Victoria were elected. Terms lasted ten years, with the candidate at the first election
                    with the most votes receiving a ten-year term, while the candidate with the fifth-most votes received a two-year term.
                    Voting for the Legislative Council was restricted to men over the age of 21 who owned over £1000 of property.
                    According to <a href="http://psephos.adam-carr.net/countries/a/australia/states/vic/historic/intro.txt" target="_blank">Adam Carr</a>, "Until 1882 Legislative Council elections
                    took place in stages across a month, allowing candidates defeated at one electorate to stand again elsewhere."
                    The number of members and regions varied throughout the 19th century, until the 1904 reforms which standardised the number of provinces to seventeen, each with
                    two members.
                    In 1922, following Federal reform, preferential voting was implemented.
                    In 1937, voting became compulsory for those who met the property ownership requirement.
                    In 1950, the Country/Labor coalition government abolished the requirement of property ownership. At the <?php
                    echo $this->Html->link(
                        'election',
                        ['controller' => 'Elections', 'action' => 'view', 159]
                    );
                    ?> prior to the reform,
                    nine Liberal members were elected to Labor's four. At the <?php
                    echo $this->Html->link(
                        'election',
                        ['controller' => 'Elections', 'action' => 'view', 160]
                    );
                    ?> after the reform, the Liberals returned one member to Labor's eleven.
                    Prior to 1961, Legislative council elections were held every two, and then every three, years, out of sync with the Legislative Assembly. Since
                    <?php
                    echo $this->Html->link(
                        '1961',
                        ['controller' => 'Elections', 'action' => 'view', 69]
                    );
                    ?>, both houses' elections have been conducted on the same day.
                    In 1962, the franchise for the Legislative Council and Legislative Assembly was extended to all adults, regardless of race or gender.
                    In 1988, following federal reform in 1984, the Cain government implemented the Group Voting Ticket system. Under
                    the system, voters could choose to either nominate preferences for every candidate using the bottom half of the ballot (which was becoming more difficult as more parties began to contest the Senate),
                    or number one box on the top half of the ballot, which would have their preferences nominated by their preferred party on their behalf based on a registered ticket.
                    Rates of informality (or invalid votes) decreased, however the system led to some candidates with low primary votes but effective negotiating skills being elected.
                    The most notorious example of this in Victoria is <?php
                    echo $this->Html->link(
                        'Rod Barton',
                        ['controller' => 'Candidates', 'action' => 'view', 26110]
                    );
                    ?>, who was elected as a MLC for North-Eastern Metropolitan in 2018 with 0.62% of the vote.
                    In 2003, the Bracks government reformed the Legislative Council to be constituted of eight regions electing five members with proportional representation.
                    Reform of the Victorian system, which is the last in Australia to use Group Voting Tickets, has been called for for some time.
                    <br>    <br>
                    <h3>Legislative Assembly</h3>
                    The first election of the Victorian Legislative Assembly, a lower house like the federal House of Representatives,
                    was held in <?php
                    echo $this->Html->link(
                        '1856',
                        ['controller' => 'Elections', 'action' => 'view', 113]
                    );
                    ?>. Unlike the Legislative Council, voting for the Legislative Assembly was open to all men over 21
                    in 1857, regardless of property ownership. The Parliament of Victoria website adds that "[t]his included Aboriginal and Torres Strait Islander men,
                    though voter suppression prevented most from using this right".
                    According to <a href="http://psephos.adam-carr.net/countries/a/australia/states/vic/historic/intro.txt" target="_blank">Adam Carr</a>, until 1859
                    "On nomination day, voters would gather at an appointed place and vote for candidates by show of hands". He also notes that
                    "[u]ntil 1877 Legislative Assembly elections took place in stages across a month, allowing candidates defeated at one
                    electorate to stand again elsewhere."
                    Some electorates in Victoria returned more than one member. The last multi-member districts were abolished in 1907.
                    In 1908, the Legislative Assembly voting franchise was extended to non-aboriginal women.
                    In 1917, following Federal reform, preferential voting was implemented.
                    In 1962, the franchise for the Legislative Council and Legislative Assembly was extended to all adults, regardless of race or gender.
                    <br><br>
                    <h1>New South Wales</h1>
<p>The history of the New South Wales parliament and its election has been finely explained by others, and I would be paraphrasing them if I were to write my own version of what has already been said. You can find out about the history of the Legislative Assembly <a href="https://www.parliament.nsw.gov.au/la/roleandhistory/Pages/The-history-of-the-Legislative-Assembly.aspx">here</a> from the Parliament of New South Wales' website, and the Legislative Council <a href="https://www.abc.net.au/news/elections/nsw/2019/guide/legislative-council-history">here</a> from Antony Green.</p>
                    <br>
                    <h1>Queensland</h1>
                    <p>The Queensland Parliament has been unicameral for more than 100 years. The Queensland Legislative Council, which was never an elected body, was abolished in 1922.
                    The Queensland Legislative Assembly was first contested in 1860, after Queensland was established as a state, independent from New South Wales, in 1859. Prior to that,
                    the settled areas that would become Queensland sent representatives to the New South Wales Parliament. Between 1860 and 1888, the Legislative Assembly was elected using First Past the Post voting, with some electorates
                    returning multiple members. At the 1893 election, the system had changed, with the 'contingent' form of preferential voting being used. Queensland reverted back to FPTP at the 1944 election, before
                    switching to preferential voting at the 1963 election. The state changed from full-preferential to optional, then back to full again. In the first half of the 20th century, the Labor party
                    was dominant in Queensland, due to rural and regional areas receiving greater representation than Brisbane in the Parliament. Demographic and political changes in these rural areas where
                    Labor was once strong allowed the Country Party to come to power in 1957. The system was tweaked slightly to further favor the Country Party by the state's longest-serving Premier, 
                    <?php
                    echo $this->Html->link(
                        'Joh Bjelke-Petersen',
                        ['controller' => 'Candidates', 'action' => 'view', 39898]
                    );
                    ?>. Despite the malapportionment, Adam Carr believes that Labor would not have been able to form government in the years it spent out of office even if electorates were all the same size. On 
                    <a href="http://psephos.adam-carr.net/countries/a/australia/states/qld/historical/1989.txt" target="_blank">the 1989 election</a>, where Labor finally returned to office after more than 30 years in opposition, he wrote that "the real reasons Labor could 
not win elections in this period were political (the effects of the 
1957 split and a succession of mediocre leaders) and demographic 
(the decline of Labor's traditional base in the rural workforce and 
the rapid growth of Brisbane suburbia and the Gold and Sunshine 
Coasts, where Labor failed to win seats)". The Labor Party would return to dominance in Queensland after 1989, as the prosecution of corrupt elements in the Bjelke-Petersen government greatly tarnished the National brand.
                    The Nationals would not win another election in Queensland, only briefly forming minority government in 1996 before uniting with the Liberal party to form the Liberal National Party of Queensland in 2008.
                    </p>
                    <br><br>
                    <h1>Territories</h1>

                    <p>
                    Original Australian states have certain rights guaranteed to them under the Constitution, such as to minimum representation in the House of Representatives and equal 
                        representation with other original states in the Senate. Territories have no such guarantees. Until 1966, MPs representing the Northern Territory 
                        and the Australian Capital Territory could only vote in Parliament on matters that related to their constituents. Until 1977, territorians could not vote in referendums. 
                        The NT and ACT are the two self-governing territories of Australia, while all other territories are governed directly by the federal government. This self-government is 
                        at the discretion of the federal government, and can be revoked, as it did in 2015 to Norfolk Island, which had been self-governing since 1979. Discussion is ongoing 
                        about restoring self-government to Norfolk Island. Papua New Guinea was briefly a self-governing territory from 1973 before becoming independent from Australia in 1975. 
                        Laws passed by these self-governing territories are subject to veto by the federal Parliament.

                        
                    </p>
<br><br>
                    <h2>Australian Capital Territory</h2>

                    <p>
The Australian Capital Territory was ceded by New South Wales to the federal government in 1911. In 1925, the Federal Capital Commission provided advice to the federal government. 
                        It was a body of one elected commissioner and two commissioners nominated by government. In 1930, the ACT Advisory Council was created for a similar purpose, 
                        constituted of 3 elected members and four nominated members. In 1975, the ACT House of Assembly was created, a wholly-elected - but still advisory - body, 
                        without the power to make laws. In 1989, the ACT was granted self-government, and the first election was held for the ACT Legislative Assembly, a unicameral 
                        body empowered to make laws for the governance of the ACT. 
<br><br>
The first two ACT elections were conducted using a modified version of the D'Hondt system of proportional representation, where 17 members were elected from a single electorate, 
                        covering the entire territory. Since 1995, the ACT has used a Hare-Clark system of proportional representation, as is used for Tasmanian state elections. 
                        That year, the single constituency was split into 3 electorates. The Assembly was expanded in 2016 to 25 members representing 5 districts. The ACT, with 
                        a large public servant population, has had a Labor government since 2001. Conservative elements in the federal parliament have sought to intervene in 
                        self-government from time to time, over matters like voluntary assisted dying and drug law reform. Data for elections prior to self-government have 
                        not been recorded, as explained in <?php
                    echo $this->Html->link(
                        'this post',
                        ['controller' => 'Pages', 'action' => 'territoriestrouble']
                    );
                    ?>.
                        
                    </p>
<br><br>
                    <h2>Northern Territory</h1>

                    <p>

                        The Northern Territory was ceded by South Australia to the federal government in 1911. In 1947, a partially-elected Legislative Council 
                        was created, with 6 members elected and 7 members nominated by the government. Psephologist and historian Dean Jaensch recorded that 
                        the Legislative Council had the power to "make Ordinances for the peace, order and good government of the Territory". The Legislative 
                        Council's elected members represented single-member constituencies (except for Darwin, which returned two MLCs for the first few elections) 
                        and were elected using full preferential voting. In 1974, the Legislative Assembly was established, a fully-elected self-governing body. 
                        19 members were elected using full preferential voting. In 1983, the parliament expanded to 25 seats. The election of 2016 was conducted 
                        using optional preferential voting, which was reverted shortly after. The NT's electorates are very small in population, with MPs representing 
                        as little as 6000 people. Results for the NT Legislative Council, despite occurring prior to self-government, are recorded in AuspolDB's 
                        dataset but not displayed in the NT's section in the elections index, as explained in <?php
                    echo $this->Html->link(
                        'this post',
                        ['controller' => 'Pages', 'action' => 'territoriestrouble']
                    );
                    ?>.
                    </p>

                </div>

            </div>
</main>
