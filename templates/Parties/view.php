<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Party $party
 */
?>
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
                <h4><?= __('Election Results') ?></h4>
                <?php if (!empty($party->candidates_elections_electorates)) : ?>

                    <?php
// Get unique election IDs and jurisdictions from $party->CEE
                    $uniqueElectionIds = array_unique(array_column($party->candidates_elections_electorates, 'election_id'));
                    $uniqueElections = [];

                    foreach ($uniqueElectionIds as $uniqueElectionId) {
                        // Find the corresponding election
                        $election = $elections->get($uniqueElectionId);

                        // Concatenate jurisdiction with date (formatted as year)
                        $electionLabel =  date('Y', strtotime($election->date)) . ' '.$election->jurisdiction;

                        // Store in associative array
                        $uniqueElections[$uniqueElectionId] = $electionLabel;
                    }
                    ?>

                    <!-- Display a dropdown for each unique election ID next to the table heading -->
                    <div style="display: flex; align-items: center;">
                        <h5><?= __('Select Election: ') ?></h5>
                        <select id="electionDropdown" style="margin-left: 10px;">
                            <option value="All">All results</option>
                            <?php foreach ($uniqueElections as $uniqueElectionId => $electionLabel) : ?>
                                <option value="<?= h($uniqueElectionId) ?>"><?= h($electionLabel) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <div class="table-responsive">
                    <table id="resultsTable">
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
                                    $electionLabel = date('Y', strtotime($election->date)) . ' ' . $election->jurisdiction;
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

            </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add an event listener to the election dropdown to trigger the filtering -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var electionDropdown = document.getElementById('electionDropdown');
        var tableRows = document.querySelectorAll('#resultsTable tbody tr');

        electionDropdown.addEventListener('change', function () {
            var selectedElectionId = this.value;

            // Hide all rows initially, excluding the first row (header)
            tableRows.forEach(function (row, index) {
                if (index > 0) {
                    row.style.display = 'none';
                }
            });

            // Show rows for the selected election or show all if "All" is selected
            if (selectedElectionId === 'All') {
                tableRows.forEach(function (row) {
                    row.style.display = '';
                });
            } else {
                var selectedRows = document.querySelectorAll('#resultsTable tbody tr[data-election-id="' + selectedElectionId + '"]');
                selectedRows.forEach(function (row) {
                    row.style.display = '';
                });
            }
        });
    });

</script>


