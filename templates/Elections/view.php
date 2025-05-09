<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Election $election
 */

$stateMappings = [
    'NSW' => 'New South Wales',
    'VIC' => 'Victorian',
    'QLD' => 'Queensland',
    'SA' => 'South Australian',
    'WA' => 'Western Australian',
    'TAS' => 'Tasmanian',
    'ACT' => 'Australian Capital Territory',
    'NT' => 'Northern Territory',
];

$jurisdiction = $stateMappings[$election->jurisdiction] ?? $election->jurisdiction;

?>
<style>
    .btn-custom {
        display: inline-block;
        padding: 6px 20px; /* Adjusted padding */
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50; /* Green color, you can change this */
        color: white;
        border: 1px solid #4CAF50;
        border-radius: 5px;
        cursor: pointer;
        line-height: 24px; /* Adjusted line-height */
        margin-bottom: 20px; /* Added margin to the bottom */
    }

    .btn-custom:hover {
        background-color: #45a049; /* Darker green color, you can change this */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchQuery = <?= json_encode($searchQuery) ?>;

        if (searchQuery !== null) {
            // Scroll to the element with the ID 'searchElectorateButton' with smooth animation
            var searchButton = document.getElementById('searchElectorateButton');

            if (searchButton) {
                searchButton.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
</script>


<div class="row">

    <div class="column-responsive column-80">
        <div class="elections view content">
            <h3><?= h($election->date->format('Y')." ".$jurisdiction)." Election" ?></h3>
            <table>
                <tr>
                    <th><?= __('Electoral System') ?></th>
                    <td class="election-system" data-system="<?= h($election->electoral_system) ?>">
                        <?= h($election->electoral_system) ?>
                        <div class="info-box" style="display: none;"></div>
                    </td>

                    <style>
                        .info-box {
                            position: absolute;
                            background-color: #fff;
                            border: 1px solid #ccc;
                            padding: 10px;
                            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                            z-index: 1;
                        }
                    </style>
                </tr>
                <tr>
                    <th><?= __('Government Type') ?></th>
                    <td class="parliamentary-status" data-status="<?= h($election->parliamentary_status) ?>">
                        <?= h($election->parliamentary_status) ?>
                        <div class="info-box" style="display: none;"></div>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Outgoing Government Party') ?></th>
                    <td>
                        <?php if ($election->outgoing_government_party !== null): ?>
                            <?php
                            $party = $parties->get($election->outgoing_government_party);
                            echo $this->Html->link(
                                $party->name,
                                ['controller' => 'Parties', 'action' => 'view', $election->outgoing_government_party]
                            );
                            ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Incoming Government Party') ?></th>
                    <td>
                        <?php if ($election->incoming_government_party !== null): ?>
                            <?php
                            $party = $parties->get($election->incoming_government_party);
                            echo $this->Html->link(
                                $party->name,
                                ['controller' => 'Parties', 'action' => 'view', $election->incoming_government_party]
                            );
                            ?>
                        <?php endif; ?>
                    </td>
                </tr>


                <tr>
                    <th><?= __('Government Seats') ?></th>
                    <td><?= $election->government_seats === null ? '' : $this->Number->format($election->government_seats) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nongovernment Seats') ?></th>
                    <td><?= $election->nongovernment_seats === null ? '' : $this->Number->format($election->nongovernment_seats) ?></td>
                </tr>
                <tr>
                    <th class="majority-header">
                        <?= __('Majority') ?>
                        <div class="info-box" style="display: none;">The difference between the number of Government seats and non-government seats.</div>
                    </th>
                    <td class="majority-cell">
                        <?php
                        if ($election->government_seats !== null && $election->nongovernment_seats !== null) {
                            $majority = $election->government_seats - $election->nongovernment_seats;
                            echo $majority > 0 ? $this->Number->format($majority) : 'N/A';
                        } else {
                            echo '';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($election->date->format('d/m/Y')) ?></td>

                </tr>
                <tr>
                    <th><?= __('House Composition') ?></th>
                    <?php
                    arsort($houseComposition); // Sort the array by counts in descending order
                    ?>

                    <td>
                        <?php foreach ($houseComposition as $partyId => $count): ?>
                            <?php echo $count . ' ' . $parties->get($partyId)->name; ?><br>
                        <?php endforeach; ?>
                    </td>

                </tr>
                <div class="related">
            </table><?php if (!empty($election->candidates_parties_elections)) : ?>

                <h4><?= __('Party Leaders at this Election') ?></h4>

                    <div class="table-responsive">
                        <table>
                            <tr>

                                <th><?= __('Leader') ?></th>
                                <th><?= __('Party') ?></th>


                            </tr>
                            <?php foreach ($election->candidates_parties_elections as $candidatesPartiesElections) : ?>
                                <tr>
                                    <?php
                                    $candidate = $candidates->get($candidatesPartiesElections->candidate_id);
                                    $party = $parties->get($candidatesPartiesElections->party_id);
                                    ?>

                                    <td><?= $this->Html->link(
                                            h($candidate->name),
                                            ['controller' => 'Candidates', 'action' => 'view', $candidate->id]
                                        ) ?></td>

                                    <td><?= $this->Html->link(
                                            h($party->name),
                                            ['controller' => 'Parties', 'action' => 'view', $party->id]
                                        ) ?></td>


                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>

            <?php
            // Collect candidates data
            $candidatesData = [];
            foreach ($election->candidates_elections_electorates as $candidatesElectionsElectorates) {
                // Check if winner and prev_winner are different
                if ($candidatesElectionsElectorates->winner != $candidatesElectionsElectorates->prev_winner) {
                    $candidate = $candidates->get($candidatesElectionsElectorates->candidate_id);
                    $party = $parties->get($candidatesElectionsElectorates->party_id);
                    $electorate = $electorates->get($candidatesElectionsElectorates->electorate_id);

                    $swing = h($candidatesElectionsElectorates->swing);
                    $swingHtml = '';
                    if ($swing > 0) {
                        $swingHtml = $swing . ' <img src="/webroot/img/green.png" alt="Up Arrow" style="max-width: 12px; max-height: 12px;">';
                    } elseif ($swing < 0) {
                        $swingHtml = $swing . ' <img src="/webroot/img/red.png" alt="Down Arrow" style="max-width: 12px; max-height: 12px;">';
                    } else {
                        $swingHtml = $swing; // Display swing percentage without arrow for zero swing
                    }

                    $candidatesData[] = [
                        'name' => h($candidate->name),
                        'party' => h($party->name),
                        'electorate' => h($electorate->name),
                        'votes' => h($candidatesElectionsElectorates->votes),
                        'swing' => $swingHtml,
                        'winnerStatus' => $candidatesElectionsElectorates->winner ? __('Incoming') : __('Outgoing'),
                    ];
                }
            }

            // Sort candidates data based on the winner value
            usort($candidatesData, function ($a, $b) {
                // Assuming 'winner' values are 'Incoming' or 'Outgoing'
                return $b['winnerStatus'] === 'Incoming' ? 1 : -1;
            });
            ?>
            <?php if ($election->jurisdiction == 'Federal') : ?>
            <div class="table-responsive" id="newMembersTableContainer" style="margin-top: 20px;">
                <h4><?= __('Incoming/Outgoing Members') ?></h4>
                <div class="collapsible-box" >
                    <button class="collapsible btn-custom">Show Table</button>
                    <div class="content"style="display: none">
                        <table>
                            <tr>
                                <th><?= __('Candidate') ?></th>
                                <th><?= __('Party') ?></th>
                                <th><?= __('Electorate') ?></th>
                                <th><?= __('Votes') ?></th>
                                <th><?= __('Swing') ?></th>
                                <th><?= __('Status') ?></th>
                            </tr>
                            <?php foreach ($candidatesData as $candidateData) : ?>
                                <tr>
                                    <td>
                                        <?= $this->Html->link($candidateData['name'], ['controller' => 'Candidates', 'action' => 'view', $candidates->find()->where(['name' => $candidateData['name']])->firstOrFail()->id]) ?>
                                    </td>
                                    <td>
                                        <?= $this->Html->link($candidateData['party'], ['controller' => 'Parties', 'action' => 'view', $parties->find()->where(['name' => $candidateData['party']])->firstOrFail()->id]) ?>
                                    </td>
                                    <td>
                                        <?= $this->Html->link($candidateData['electorate'], ['controller' => 'Electorates', 'action' => 'view', $electorates->find()->where(['name' => $candidateData['electorate']])->firstOrFail()->id]) ?>
                                    </td>
                                    <td><?= $candidateData['votes'] ?></td>
                                    <td><?= $candidateData['swing'] ?></td>
                                    <td><?= $candidateData['winnerStatus'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

            </div>
            <?php endif; ?>

            <div class="related">
                <?php if ($electionType != 'Senate') : ?>

                <div style="display: flex; align-items: center;">
                    <h4 style="margin-right: 100px;white-space: nowrap;"><?= __('Lower House') ?></h4>
                    <?php if ($election->jurisdiction == 'Federal') : ?>
                    <select id="stateSelector" style="margin-right: -250px; max-width: 255px;" onchange="checkSelectedOption()">
                        <option value="">All States/Territories</option>
                        <option value="ACT">Australian Capital Territory</option>
                        <option value="NSW">New South Wales</option>
                        <option value="NT">Northern Territory</option>
                        <option value="QLD">Queensland</option>
                        <option value="SA">South Australia</option>
                        <option value="TAS">Tasmania</option>
                        <option value="VIC">Victoria</option>
                        <option value="WA">Western Australia</option>
                    </select>
                    <?php endif; ?>
                    <input type="text" id="electorateSearch" placeholder="Search electorates..." style="max-width:200px; margin-left: 280px;">
                    <button id="searchElectorateButton" class="btn-custom" style="margin-left: 10px; margin-bottom: 15px">Search</button>
                </div>

                <!-- Collapsible Electorates Table -->
                <div class="table-responsive">
                    <div class="collapsible-box">
                        <button class="collapsible btn-custom">Show Table</button>
                        <div id="repsTable" class="content" style="display: none">
                            <table>
                                <tr>
                                    <th><?= __('Name') ?></th>
                                    <th><?= __('Jurisdiction') ?></th>
                                    <th><?= __('Type') ?></th>
                                </tr>
                                <?php foreach ($election->electorates as $electorate) : ?>
                                    <tr data-state="<?= h($electorate->jurisdiction) ?>">
                                        <td>
                                            <?= $this->Html->link(
                                                h($electorate->name),
                                                [
                                                    'controller' => 'Electorates',
                                                    'action' => 'view',
                                                    $electorate->id,
                                                    '?' => ['contest' => $election->id]
                                                ]
                                            ) ?>
                                        </td>

                                        <td><?= h($electorate->jurisdiction) ?></td>
                                        <td><?= h($electorate->type) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <?php if (!empty($upperHouseContests)) : ?>
                    <div style="display: flex; align-items: center;">
                        <h4 style="margin-right: 100px; white-space: nowrap;"><?= __('Upper House') ?></h4>

                        <select id="stateSenateSelector" style="max-width: 255px;">
                            <option value="">Please select</option>
                            <?php foreach ($jurisdictions as $jurisdiction): ?>
                                <option value="<?= $jurisdiction->state ?>" <?= ($senateQueryString !== null && $jurisdiction->state === $senateQueryString) ? 'selected' : '' ?>>
                                    <?= h($jurisdiction->state) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <?php if ($composition != ''): ?>
                            <div style="margin-left: 20px; white-space: pre;">
                                <p><?php
                                    // Split the string into an array using space as the delimiter
                                    $compositionArray = explode(' ', $composition);

                                    // Iterate over the array and format the output
                                    $output = '';
                                    foreach ($compositionArray as $key => $value) {
                                        // Add a newline after every number except the first one
                                        if ($key > 0 && is_numeric($value)) {
                                            $output .= "\n";
                                        }

                                        // Concatenate the current value to the output
                                        $output .= $value . ' ';
                                    }

                                    // Remove trailing space
                                    $output = rtrim($output);

                                    // Display the formatted output
                                    echo $output;
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>



                    </div>

                    <!-- Collapsible Electorates Table -->
                    <div class="table-responsive">
                        <div class="collapsible-box">
                            <button class="collapsible btn-custom">Show Table</button>
                            <div id="senateTable" class="content" style="display: none">
                                <table>
                                    <tr>
                                        <th>Candidate</th>
                                        <th>Party</th>
                                        <th>State</th>
                                        <th>Votes</th>
                                        <th>Elected</th>
                                    </tr>
                                    <?php foreach ($upperHouseContests as $contest) : ?>
                                        <tr>
                                            <td>
                                                <?php

                                                $candidate = $candidates->get($contest->candidate_id);
                                                echo $this->Html->link(h($candidate->name), ['controller' => 'Candidates', 'action' => 'view', $candidate->id]);
                                                ?>
                                            </td>
                                            <td>
                                                <?=
                                                $this->Html->link(
                                                    str_replace('&amp;', '&', $parties->get($contest->party_id)->name),
                                                    ['controller' => 'Parties', 'action' => 'view', $contest->party_id]
                                                ) ?>
                                            </td>


                                            <td><?= h($contest->state) ?></td>

                                            <td><?= h($contest->votes) ?></td>

                                            <td><?= h($contest->position ? "Yes (".$contest->position.")": "No") ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


            </div>

        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    // Check if the search query is 'senate'
    var searchQuery = '<?= $senateQueryString ?>'; // Replace with your actual PHP variable

    // Select the content div
    var contentDiv = document.getElementById('senateTable');

    // Check if the search query is not null and equals 'senate'
    if (searchQuery) {
        // Set the display style to block
        contentDiv.style.display = 'block';
    } else {
        // Set the display style to none
        contentDiv.style.display = 'none';
    }
</script>



<script>
    $(document).ready(function () {
        // Listen for changes in the stateSenateSelector dropdown
        $('#stateSenateSelector').on('change', function () {
            // Get the selected value
            var selectedValue = $(this).val();

            // Get the current URL
            var currentUrl = window.location.href;

            // Check if the URL already contains a 'senate' query parameter
            var regex = new RegExp('[?&]senate(=([^&#]*)|&|#|$)');
            var results = regex.exec(currentUrl);

            if (results === null) {
                // If 'senate' query parameter doesn't exist, append it
                var separator = currentUrl.includes('?') ? '&' : '?';
                var updatedUrl = currentUrl + separator + 'senate=' + selectedValue;
                window.location.href = updatedUrl;


            } else {
                // If 'senate' query parameter exists, replace its value
                var updatedUrl = currentUrl.replace(results[0], '?senate=' + selectedValue);
                window.location.href = updatedUrl;

            }
        });
    });
</script>

<script>


    // If the $senateQueryString is set, scroll down by 500 pixels
    $(document).ready(function () {
        // Check if $selectedElectionId is set, and show the first table if true

        // Check if $senateQuery is set, and show the second table if true
        <?php if (isset($senateQueryString)): ?>
        $(".table-responsive:last").show();
        // Scroll down 500 pixels
        $('html, body').animate({
            scrollTop: $(".table-responsive:last").offset().top - 200
        }, 1000); // Adjust the duration as needed
        <?php endif; ?>
    });
</script>

<script>
    $(document).ready(function() {
        $('#searchElectorateButton').on('click', function() {
            // Get the search input value
            var searchElectorateString = $('#electorateSearch').val();

            // Create a link with the search query
            var searchElectorateLink = '<?= $this->Url->build(['action' => 'view', $election->id]) ?>?search=' + searchElectorateString;

            // Redirect to the link
            window.location.href = searchElectorateLink;
        });
    });
</script>

<script>
    $(document).ready(function() {
        var button = $("#searchElectorateButton");
        var content = $(".content");

        button.on("click", function() {
            content.slideToggle(500, function() {
                if (content.is(":visible")) {
                    $('html, body').animate({
                        scrollTop: content.offset().top
                    }, 500);
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function () {
        // Listen for changes in the stateSelector dropdown
        $('#stateSelector').on('change', function () {
            // Get the selected state value
            var selectedState = $(this).val();

            // Hide all electorates
            $('.collapsible-box .content table tr').hide();

            // Show only electorates that match the selected state
            if (selectedState !== '') {
                $('.collapsible-box .content table tr[data-state="' + selectedState + '"]').show();

            } else {
                // Show all electorates if no state is selected
                $('.collapsible-box .content table tr').show();
            }


        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    });
</script>

<script>
    function checkSelectedOption() {
        // Get the select element
        var stateSelector = document.getElementById('stateSelector');

        // Get the selected option value
        var selectedValue = stateSelector.options[stateSelector.selectedIndex].value;

        // Get the repsTable element
        var repsTable = document.getElementById('repsTable');

        // Check if the selected value is not an empty string
        if (selectedValue !== "") {
            // Set the display style to block
            repsTable.style.display = 'block';
        } else {
            // Set the display style to none
            repsTable.style.display = 'none';
        }
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var electionSystemTd = document.querySelector('.election-system');
        var infoBox = electionSystemTd.querySelector('.info-box');

        electionSystemTd.addEventListener('mouseover', function() {
            var system = electionSystemTd.dataset.system;

            // Set information based on the electoral system value
            var infoText;
            switch (system) {
                case 'FPTP':
                    infoText = 'First-Past-the-Post (FPTP): The candidate with the most votes is elected.';
                    break;
                case 'Block Voting':
                    infoText = 'Block Voting: Voters are given a certain number of votes. The candidates\n' +
                        'with the most votes are elected. The number of vacancies is usually equal to\n' +
                        'the number of votes the voter has.';
                    break;
                case 'STV':
                    infoText = 'Single Transferable Vote (STV): ' +
                        'A voter has one vote which they may nominate preferences for.\n' +
                        'Candidates who reach a required number of votes (the quota) are elected.';
                    break;
                case 'Hare-Clark':
                    infoText = 'Hare-Clark: ' +
                        'A voter has one vote which they may nominate preferences for.\n' +
                        'Candidates who reach a required number of votes (the quota) are elected.';
                    break;
                case 'Modified d\'Hondt Electoral System':
                    infoText = 'Modified d\'Hondt Electoral System: ' +
                        'A voter may issue preferences above and below the line on their ballot.\n' +
                        'Candidates who reach a quota of votes (and receive a minimum number of\n' +
                        'first preferences) are elected.';
                    break;
                case 'Other':
                    infoText = 'Other';
                    break;
                case 'OPV':
                    infoText = 'Optional Preferential Voting (OPV): ' +
                        'A voter has one vote, and may nominate preferences if they choose.\n' +
                        'Voters who do not nominate preferences may have their vote exhaust and fail to contribute\n' +
                        'to the election of a candidate. The candidate who receives the most votes\n' +
                        'after the distribution of preferences is elected.';
                    break;
                case 'FPV':
                    infoText = 'Full Preferential Voting (FPV): ' +
                        'A voter has one vote, and must nominate preferences for each candidate on the ballot.\n' +
                    'Voters who do not nominate preferences will have cast an informal vote.\n' +
                        'The candidate who receives a majority of votes after the distribution of preferences is elected.';
                    break;

                default:
                    infoText = 'Default information for unknown system';
            }

            // Display the information box
            infoBox.textContent = infoText;
            infoBox.style.display = 'block';
        });

        electionSystemTd.addEventListener('mouseout', function() {
            // Hide the information box when hover stops
            infoBox.style.display = 'none';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var parliamentaryStatusTd = document.querySelector('.parliamentary-status');
        var infoBox = parliamentaryStatusTd.querySelector('.info-box');

        parliamentaryStatusTd.addEventListener('mouseover', function() {
            var status = parliamentaryStatusTd.dataset.status;

            // Set information based on the parliamentary status value
            var infoText;
            switch (status) {
                case 'Majority':
                    infoText = 'Majority: A party (or formalised coalition of parties) is able to control a majority of ' +
                        'votes on the floor of the House.';
                    break;
                case 'Minority':
                    infoText = 'Minority: A governing party (or formalised coalition of parties) must rely on the support ' +
                        'of crossbench members to control the majority of votes on the floor of the House.';
                    break;
                case null:
                    infoText = 'No parliamentary status information';
                    break;

                default:
                    infoText = 'Default information for unknown status';
            }

            // Display the information box
            infoBox.textContent = infoText;
            infoBox.style.display = 'block';
        });

        parliamentaryStatusTd.addEventListener('mouseout', function() {
            // Hide the information box when hover stops
            infoBox.style.display = 'none';
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var majorityCell = document.querySelector('.majority-cell');
        var infoBox = majorityCell.previousElementSibling.querySelector('.info-box');

        majorityCell.addEventListener('mouseover', function() {
            // Display the information box when hovering over the cell
            infoBox.style.display = 'block';
        });

        majorityCell.addEventListener('mouseout', function() {
            // Hide the information box when hover stops
            infoBox.style.display = 'none';
        });
    });
</script>
