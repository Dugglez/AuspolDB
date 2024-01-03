<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Electorate $electorate
 */

?> <style>
    .tooltip-container {
        position: relative;
        display: inline-block;
    }

    .tooltip-content {
        display: none;
        position: absolute;
        top: -75px; /* Adjust the distance from the question mark */
        transform: translateX(-20%);
        background-color: #333;
        color: #fff;
        padding: 16px;
        border-radius: 8px;
        white-space: nowrap;
        z-index: 1000;
    }

    .question-mark {
        cursor: pointer;
        display: inline-block;
        width: 16px;
        height: 16px;
        background-color: #ccc;
        color: #fff;
        text-align: center;
        line-height: 16px;
        border-radius: 50%;
        font-size: 12px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="overlay">
    <div class="tooltip-content">
        2CP (Two-candidate preferred) indicates the percentage of votes that the winning candidate received after preference distribution.
    </div>
</div>
<div class="row">
    <?php
    $stateMappings = [
        'Federal' => 'Federal',
        'NSW' => 'New South Wales',
        'VIC' => 'Victoria',
        'QLD' => 'Queensland',
        'SA' => 'South Australia',
        'WA' => 'Western Australia',
        'TAS' => 'Tasmania',
        'ACT' => 'Australian Capital Territory',
        'NT' => 'Northern Territory',
    ];
    ?>
    <div class="column-responsive column-80">
        <div class="electorates view content">
            <h3><?= h($electorate->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Jurisdiction') ?></th>
                    <td><?= h($electorate->jurisdiction) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td>
                        <?= h($electorate->type) ?>

                        <?php
                        // Check conditions for displaying the message
                        if (($electorate->name === "South Australia" || $electorate->name === "Tasmania") && $electorate->type === 'Division') {
                            $memberCount = ($electorate->name === "South Australia") ? 7 : 5;
                            echo " (Proportional district that elected $memberCount members, disregard 2CP)";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Population') ?></th>
                    <td><?= $electorate->population === null ? __('Unknown') : $this->Number->format($electorate->population) ?></td>
                </tr>
                <tr>
                    <th><?= __('Abolished') ?></th>
                    <td><?= $electorate->abolished === null ? __('Unknown') : ($electorate->abolished ? __('Yes') : __('No')) ?></td>
                </tr>
                </tr>
            </table>

            <div class="text">
                <strong><?= __('Namesake') ?></strong>
                <blockquote>
                    <?= $electorate->namesake === null ? __('Unknown.') : $this->Text->autoParagraph(h($electorate->namesake)); ?>

                </blockquote>
            </div>
            <div class="related">

                <table>
                    <tr>
                        <th>Member</th>
                        <th>To</th> <!-- Swapped "From Year" and "To Year" columns -->
                        <th>From</th>
                    </tr>

                    <?php
                    $prevWinnerId = null;
                    $streakStartYear = null;

                    foreach ($winners as $electionId => $winnerId) {
                        $election = $electionslist->get($electionId);
                        $electionDate = $election->date;
                        $electionYear = $electionDate->format('Y');
                        $electionLabel = h($electionYear);

                        // Get candidate name based on winnerId
                        $candidate = $candidates->get($winnerId);
                        $candidateName = h($candidate->name);
                        if (isset($prevWinnerId)) {
                            $prevCandName = h($candidates->get($prevWinnerId)->name);
                        }
                        if ($winnerId !== $prevWinnerId or !isset($prevWinnerId)) {
                            // Output the row for the streak
                            if ($streakStartYear !== null) {
                                echo "<tr>
                        <td>{$this->Html->link($prevCandName, ['controller' => 'Candidates', 'action' => 'view', $prevWinnerId])}</td>
                        <td>{$this->Html->link($electionLabel, ['controller' => 'Elections', 'action' => 'view', $election->id])}</td>
                        <td>{$this->Html->link($streakStartYear, ['controller' => 'Elections', 'action' => 'view', $streakStartElectionId])}</td>
                      </tr>";
                            }

                            // Start a new streak
                            $streakStartYear = $electionYear;
                            $streakStartElectionId = $electionId;
                        }

                        // Update the previous winner ID
                        $prevWinnerId = $winnerId;
                    }

                    // Output the last row if there is an ongoing streak
                    if ($streakStartYear !== null) {
                        echo "<tr>
                <td>{$this->Html->link($candidateName, ['controller' => 'Candidates', 'action' => 'view', $winnerId])}</td>
                <td>{$this->Html->link($electionLabel, ['controller' => 'Elections', 'action' => 'view', $election->id])}</td>
                <td>{$this->Html->link($streakStartYear, ['controller' => 'Elections', 'action' => 'view', $streakStartElectionId])}</td>
              </tr>";
                    }
                    ?>

                </table>








            </div>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var electionDropdown = $('#electionDropdown');
                    var tableRows = $('#candidatesTable tbody tr');

                    // Initially hide all rows (including headers)
                    tableRows.hide();

                    electionDropdown.on('change', function () {
                        var selectedElectionId = $(this).val();

                        // Hide all rows before showing the selected ones
                        tableRows.hide();

                        // Show rows for the selected election or show all if "All" is selected
                        if (selectedElectionId === 'All') {
                            tableRows.show();
                        } else {
                            var selectedRows = tableRows.filter('[data-election-id="' + selectedElectionId + '"]');
                            selectedRows.show();
                        }

                        // Show headers if there are rows being displayed
                        if (tableRows.is(':visible')) {
                            tableRows.filter(':first-child').show();
                        }

                        // Scroll to the bottom of the screen
                        $('html, body').animate({
                            scrollTop: 500
                        }, 'fast');

                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var electionDropdown = $('#electionDropdown');
                    var electionInfoTableContainer = $('#electionInfoTableContainer');

                    electionDropdown.on('change', function () {
                        var selectedElectionId = $(this).val();

                        // Hide the table initially
                        electionInfoTableContainer.hide();

                        // Show the table and the row that matches the selected election
                        if (selectedElectionId !== 'Select Election') {
                            $('#electionInfoTable tr[data-election-id]').hide();
                            $('#electionInfoTable tr[data-election-id="' + selectedElectionId + '"]').show();
                            electionInfoTableContainer.show();
                        }
                    });
                });
            </script>

            <div class="related">
                <?php if (!empty($electorate->candidates_elections_electorates)) : ?>
                    <h4><?= __('Electorate Results') ?></h4>
                    <?php
// Get unique election IDs and jurisdictions from $electorate->CEE
                    $uniqueElectionIds = array_unique(array_column($electorate->candidates_elections_electorates, 'election_id'));
                    $uniqueElections = [];

                    foreach ($uniqueElectionIds as $uniqueElectionId) {
                        // Find the corresponding election
                        $election = $electionslist->get($uniqueElectionId);

                        // Concatenate jurisdiction with date (formatted as year)
                        $electionDate = $election->date;
                        $electionYear = $electionDate->format('Y');
                        $electionLabel = $electionYear . ' ' . $stateMappings[$election->jurisdiction];
                        // Store in associative array
                        $uniqueElections[$uniqueElectionId] = $electionLabel;
                    }
                    ?>

                    <!-- Display a dropdown for each unique election ID next to the table heading -->
                    <div style="display: flex; align-items: center;">
                        <h5><?= __('Select Election: ') ?></h5>
                        <select id="electionDropdown" style="margin-left: 10px;">
                            <option value="Select">Select Election</option>
                            <?php foreach ($uniqueElections as $uniqueElectionId => $electionLabel) : ?>
                                <option value="<?= h($uniqueElectionId) ?>"><?= h($electionLabel) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <script>
                        document.getElementById('electionDropdown').addEventListener('change', function () {
                            var selectedLabel = this.options[this.selectedIndex].text;


                            // Select elements with specific classes and IDs
                            var questionMarks = document.querySelectorAll('.question-mark');
                            var tooltipContainers = document.querySelectorAll('.tooltip-container');
                            var warnheader = document.querySelectorAll('.tooltip-content');

                            // Select additional elements to hide
                            var elementsToHide = [
                                document.getElementById('electionInfoTable'),
                                document.getElementById('content'),
                            ];

                            // Check if the selected label contains 'Federal'
                            if (selectedLabel.includes('Federal')) {
                                questionMarks.forEach(function (questionMark) {
                                    questionMark.style.display = 'block';
                                });

                                tooltipContainers.forEach(function (tooltipContainer) {
                                    tooltipContainer.style.display = 'flex';
                                });

                                // Show the warnheader
                                warnheader.forEach(function (warn) {
                                    warn.style.display = 'block';
                                });
                                document.getElementById('electionInfoTable').style.display = 'block'
                            } else {
                                // Hide all elements with class 'question-mark' and 'tooltip-container'
                                questionMarks.forEach(function (questionMark) {
                                    questionMark.style.display = 'none';
                                });

                                tooltipContainers.forEach(function (tooltipContainer) {
                                    tooltipContainer.style.display = 'none';
                                });

                                // Hide additional elements
                                elementsToHide.forEach(function (element) {
                                    if (element) {
                                        element.style.display = 'none';
                                    }
                                });

                                // Hide the warnheader
                                warnheader.forEach(function (warn) {
                                    warn.style.display = 'none';
                                });
                            }
                        });
                    </script>




                    <div class="tooltip-container" style="display: none; align-items: center; position: relative;">
                        <h5 style="display: inline-block; margin-right: 5px;">Please note: Federal 2CP Vote counts from 1983 and earlier are inaccurate.</h5>
                        <div class="tooltip" style="display: inline-block; margin-top: -22px" data-tooltip="Please note: Federal 2CP Vote counts from 1983 and earlier are inaccurate;">
                            <span class="question-mark">?</span>
                        </div>
                        <div style="display: none;" class="tooltip-content">
                            <p>
                                2CP vote counts prior to 1984 were not recorded in electorates where a majority of votes were achieved by one candidate.
                                The vote counts provided are based on the 2CP percentage, meaning they are inaccurate to within 0.1% of the formal vote.
                            </p>
                        </div>
                    </div>







                    <div id="content" class="tooltip" style="display: none; background-color: #333; color: #fff; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); font-size: 14px; ">
                        2CP (Two-candidate preferred) represents the percentage of formal votes
                        a candidate received after the distribution of preferences. Prior to the 1919 election, Australian federal elections used
                        First Past the Post, where voters could not allocate their preferences. As such, in elections before 1919, there is no 2CP.
                        Instead, the majority is recorded, which is the difference in votes between the winning candidate and the second candidate.
                    </div>
                    <div class="table-responsive" id="electionInfoTableContainer" style="margin-top: 20px; display: none;">
                        <table id="electionInfoTable">
                            <tr>
                                <th style="display: flex;">
                                        <?= __('2CP/Majority ') ?>
                                    <p class="question-mark" style="display: none; margin-left: 5px; margin-top: 5px;" onclick="toggleTooltip('content')">?</p>

                                </th>
                                <th><?= __('Elected Candidate') ?></th>
                                <th><?= __('Party') ?></th>
                                <th><?= __('Votes') ?></th>
                                <th><?= __('Second Candidate') ?></th>
                                <th><?= __('Party') ?></th>
                                <th><?= __('Votes') ?></th>
                            </tr>
                            <?php foreach ($elections_electorates as $electionsElectorate) : ?>
                                <tr data-election-id="<?= h($electionsElectorate->election_id) ?>">
                                    <td>
                                        <?php
                                        $twocp_or_majority = h($electionsElectorate->twocp_or_majority);

                                        if ($twocp_or_majority == 99.99) {
                                            echo 'Uncontested';
                                        } else {
                                            // Check if $twocp_or_majority is greater than 100
                                            if ($twocp_or_majority > 100) {
                                                // Display as integer with no decimals
                                                echo intval($twocp_or_majority);
                                            } else {
                                                // Display as it is
                                                echo $twocp_or_majority;
                                            }
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <?php
                                        // Get the winning candidate information
                                        $winningCandidate = $candidates->get($electionsElectorate->winning_candidate);
                                        echo $this->Html->link(h($winningCandidate->name), ['controller' => 'Candidates', 'action' => 'view', $winningCandidate->id]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Get the winning party information
                                        $winningParty = $parties->get($electionsElectorate->winning_party);
                                        echo $this->Html->link(h($winningParty->name), ['controller' => 'Parties', 'action' => 'view', $winningParty->id]);
                                        ?>
                                    </td>
                                    <td><?= h($electionsElectorate->winning_votes) ?></td>
                                    <td>
                                        <?php
                                        // Get the second candidate information
                                        $secondCandidate = isset($electionsElectorate->second_candidate) ? $candidates->get($electionsElectorate->second_candidate) : null;
                                        echo isset($secondCandidate->name) ? $this->Html->link(h($secondCandidate->name), ['controller' => 'Candidates', 'action' => 'view', $secondCandidate->id]) : 'None';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Get the second party information
                                        $secondParty = isset($electionsElectorate->second_candidate) ? $parties->get($electionsElectorate->second_party) : null;
                                        echo isset($secondParty->name) ? $this->Html->link(h($secondParty->name), ['controller' => 'Parties', 'action' => 'view', $secondParty->id]) : 'None';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo isset($electionsElectorate->second_votes) ? h($electionsElectorate->second_votes) : 'None';
                                        ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </table><br>
                    </div>

                    <div class="table-responsive">
                        <table id="candidatesTable">
                            <tr>
                                <th><?= __('Candidate') ?></th>
                                <th><?= __('Party') ?></th>
                                <th><?= __('Votes') ?></th>
                                <th><?= __('Swing') ?></th>
                                <th><?= __('Elected') ?></th>
                            </tr>
                            <?php foreach ($electorate->candidates_elections_electorates as $candidatesElectionsElectorates) : ?>
                                <tr data-election-id="<?= h($candidatesElectionsElectorates->election_id) ?>">
                                    <td>
                                        <?php
                                        // Get the candidate information
                                        $candidate = $candidates->get($candidatesElectionsElectorates->candidate_id);
                                        echo $this->Html->link(h($candidate->name), ['controller' => 'Candidates', 'action' => 'view', $candidate->id]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Get the party information
                                        $party = $parties->get($candidatesElectionsElectorates->party_id);
                                        echo $this->Html->link(h($party->name), ['controller' => 'Parties', 'action' => 'view', $party->id]);
                                        ?>
                                    </td>
                                    <td><?= h($candidatesElectionsElectorates->votes) ?></td>
                                    <td>
                                        <?php
                                        $swing = h($candidatesElectionsElectorates->swing);
                                        if ($swing > 0) {
                                            echo $swing . ' <img src="/webroot/img/green.png" alt="Up Arrow" style="max-width: 12px; max-height: 12px;">';
                                        } elseif ($swing < 0) {
                                            echo $swing . ' <img src="/webroot/img/red.png" alt="Down Arrow" style="max-width: 12px; max-height: 12px;">';
                                        } else {
                                            echo $swing; // Display swing percentage without arrow for zero swing
                                        }
                                        ?>
                                    </td>
                                    <td><?= $candidatesElectionsElectorates->winner ? __('Yes') : __('No'); ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                </div>
                <?php endif; ?>
<br>
                <h4><?= __('Contested in') ?></h4>
                <?php if (!empty($electorate->elections)) : ?>
                    <div class="table-responsive">

                        <?php
                        $count = count($electorate->elections);
                        foreach ($electorate->elections as $key => $election) :
                            $formattedDate = $this->Time->format($election->date, 'Y');
                            $jurisdiction = $stateMappings[$election->jurisdiction];
                            ?>

                            <?= $this->Html->link(
                            $formattedDate . ' ' . $jurisdiction,
                            ['controller' => 'Elections', 'action' => 'view', $election->id]
                        ) ?><?php
                            // Add comma if it's not the last election
                            echo ($key < $count - 1) ? ', ' : '.';
                            ?>



                        <?php endforeach; ?>

                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".question-mark").click(function () {
            // Toggle the tooltip-content within the same tooltip-container
            $(this).closest(".tooltip-container").find(".tooltip-content").toggle();
        });

        // Hide all tooltip-content when clicking outside any tooltip-container
        $(document).click(function (event) {
            if (!$(event.target).closest(".tooltip-container").length) {
                $(".tooltip-content").hide();
            }
        });
    });
</script>

<script>
    // Function to toggle the visibility of the tooltip
    function toggleTooltip(elementId) {
        var tooltip = document.getElementById(elementId);
        if (tooltip.style.display === 'block') {
            tooltip.style.display = 'none';
        } else {
            tooltip.style.display = 'block';
        }
    }
</script>
