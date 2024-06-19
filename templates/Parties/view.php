<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Party $party
 */

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
<div class="row">

    <div class="column-responsive column-80">
        <div class="parties view content">
            <h3><?= h($party->name) ?></h3>
            <table>

                <tr>
                    <th><?= __('Founded') ?></th>
                    <td><?= $party->founded ? h($party->founded->format('Y')) : 'Unknown' ?></td>

                </tr>
            </table>
            <br>
            <h5><?= h($party->description) ?></h5>
            <div class="related"> <?php if (!empty($party->candidates_parties_elections)) : ?>
                    <h4><?= __('Party Leaders at Elections') ?></h4>

                    <div class="table-responsive">
                        <table>
                            <tr>

                                <th><?= __('Leader') ?></th>

                                <th><?= __('Election') ?></th>

                            </tr>
                            <?php foreach ($party->candidates_parties_elections as $candidatesPartiesElections) : ?>
                                <tr>
                                    <?php
                                    // Fetch candidate and election entities based on their IDs
                                    $candidate = $candidates->get($candidatesPartiesElections->candidate_id);
                                    $election = $elections->get($candidatesPartiesElections->election_id);

                                    // Display candidate name as a link to its view page
                                    ?>
                                    <td><?= $this->Html->link(
                                            h($candidate->name),
                                            ['controller' => 'Candidates', 'action' => 'view', $candidate->id]
                                        ) ?></td>

                                    <?php
                                    // Display election jurisdiction + formatted date as a link to its view page
                                    ?>
                                    <td><?= $this->Html->link(
                                            h($election->date->format('Y'). ' ' . $election->jurisdiction ),
                                            ['controller' => 'Elections', 'action' => 'view', $election->id]
                                        ) ?></td>



                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <?php if (!empty($party->candidates_elections_electorates)) : ?>
                <h4><?= __('Lower House Results') ?></h4>




                    <!-- Display a dropdown for each unique election ID next to the table heading -->
                    <div style="display: flex; align-items: center;">
                        <h5><?= __('Select Election: ') ?></h5>
                        <select id="electionDropdown" style="margin-left: 10px;">
                            <option>Select Election</option>
                            <?php foreach ($uniqueElections as $electionLabel => $uniqueElectionId) : ?>
                                <?php
                                // Check if 'senate' query string is set and matches the current election ID
                                $selected = (isset($_GET['election']) && $_GET['election'] == $uniqueElectionId) ? 'selected' : '';
                                ?>
                                <option value="<?= h($uniqueElectionId) ?>" <?= $selected ?>><?= h($electionLabel) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <button class="btn-custom" id="showTableBtn">Show Table</button>
                <div class="table-responsive" style="display: none" >

                    <div class="collapsible-box">

                    <table id="resultsTable" id="resultsTableContainer">
                        <tr>
                            <th><?= __('Candidate') ?></th>
                            <th><?= __('Election') ?></th>
                            <th><?= __('Electorate') ?></th>
                            <th><?= __('Votes') ?></th>
                            <th><?= __('Swing') ?></th>
                            <th><?= __('Elected') ?></th>
                        </tr>
                        <?php foreach ($party->candidates_elections_electorates as $candidatesElectionsElectorates) : ?>
                            <tr data-election-id="<?= h($candidatesElectionsElectorates->election_id) ?>">
                                <td>
                                    <?php

                                    $candidate = $candidates->get($candidatesElectionsElectorates->candidate_id);
                                    echo $this->Html->link(h($candidate->name), ['controller' => 'Candidates', 'action' => 'view', $candidate->id]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $election = $elections->get($candidatesElectionsElectorates->election_id);
                                    $electionDate = $election->date;
                                    $electionYear = $electionDate->format('Y');
                                    $electionLabel = $electionYear . ' ' . $election->jurisdiction;

                                    echo $this->Html->link(h($electionLabel), ['controller' => 'Elections', 'action' => 'view', $election->id]);
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    $electorate = $electorates->get($candidatesElectionsElectorates->electorate_id);
                                    echo $this->Html->link(h($electorate->name), ['controller' => 'Electorates', 'action' => 'view', $electorate->id]);
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
                </div>

<br>
                <?php if (!empty($upperHouseContests)) : ?>
                    <h4><?= __('Upper House Results') ?></h4>




                    <div style="display: flex; align-items: center;">
                        <h5><?= __('Select Election: ') ?></h5>
                        <select id="senateElectionDropdown" style="margin-left: 10px;">
                            <option>Select Election</option>
                            <?php foreach ($uniqueSenateElections as $electionLabel => $uniqueElectionId) : ?>
                                <?php
                                // Check if 'senate' query string is set and matches the current election ID
                                $selected = (isset($_GET['senate']) && $_GET['senate'] == $uniqueElectionId) ? 'selected' : '';
                                ?>
                                <option value="<?= h($uniqueElectionId) ?>" <?= $selected ?>><?= h($electionLabel) ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <button class="btn-custom" id="showTableBtn2">Show Table</button>
                    <div class="table-responsive" style="display: none;">
                        <table class="content" id="resultsTable">
                            <tr>
                                <th><?= __('Candidate') ?></th>
                                <th><?= __('Election') ?></th>
                                <th><?= __('State') ?></th>
                                <th><?= __('Votes') ?></th>
                                <th><?= __('Elected') ?></th>
                            </tr>
                            <?php foreach ($upperHouseContests as $contest) : ?>
                                <tr data-election-id="<?= h($contest->election_id) ?>">
                                    <td>
                                        <?php

                                        $candidate = $candidates->get($contest->candidate_id);
                                        echo $this->Html->link(h($candidate->name), ['controller' => 'Candidates', 'action' => 'view', $candidate->id]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $election = $elections->get($contest->election_id);
                                        $electionDate = $election->date;
                                        $electionYear = $electionDate->format('Y');
                                        $electionLabel = $electionYear . ' ' . $election->jurisdiction;

                                        echo $this->Html->link(h($electionLabel), ['controller' => 'Elections', 'action' => 'view', $election->id]);
                                        ?>

                                    </td>
                                    <td>
                                        <?php

                                        echo h($contest->state);
                                        ?>
                                    </td>
                                    <td><?= h($contest->votes) ?></td>

                                    <td><?= h($contest->position ? "Yes (".$contest->position.")": "No") ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                        <?php endif; ?>
                    </div>

            </div>

            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        var electionDropdown = $('#electionDropdown');

        electionDropdown.on('change', function () {
            var selectedElectionId = $(this).val();

            // Construct the query string
            var queryString = selectedElectionId ? '?election=' + encodeURIComponent(selectedElectionId) : '';

            // Update the URL with the query string
            var currentUrl = window.location.href.split('?')[0];
            var newUrl = currentUrl + queryString;

            // Redirect to the new URL
            window.location.href = newUrl;
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#senateElectionDropdown').on('change', function () {
            var selectedValue = $(this).val();

            // Ensure that a valid option is selected
            if (selectedValue !== 'Select Election') {
                // Get the current URL and create a URLSearchParams object
                var urlParams = new URLSearchParams(window.location.search);

                // Set or append the 'senate' query parameter
                urlParams.set('senate', selectedValue);

                // Construct the new URL with the updated query parameters
                var newUrl = window.location.origin + window.location.pathname + '?' + urlParams.toString();

                // Redirect to the new URL
                window.location.href = newUrl;
            }
            else {
                var newUrl = window.location.origin + window.location.pathname;

                // Redirect to the new URL
                window.location.href = newUrl;
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Check if $selectedElectionId is set, and show the first table if true
        <?php if (isset($selectedElectionId)): ?>
        $(".table-responsive:first").show();
        // Scroll down 300 pixels
        $('html, body').animate({
            scrollTop: $(".table-responsive:first").offset().top - 200
        }, 1000); // Adjust the duration as needed
        <?php endif; ?>

        // Check if $senateQuery is set, and show the second table if true
        <?php if (isset($senateQuery)): ?>
        $(".table-responsive:last").show();
        // Scroll down 500 pixels
        $('html, body').animate({
            scrollTop: $(".table-responsive:last").offset().top - 200
        }, 1000); // Adjust the duration as needed
        <?php endif; ?>

        // Toggle visibility for the first table
        $("#showTableBtn").on("click", function () {
            $(".table-responsive:first").toggle();
        });

        // Toggle visibility for the second table
        $("#showTableBtn2").on("click", function () {
            $(".table-responsive:last").toggle();
        });
    });
</script>

