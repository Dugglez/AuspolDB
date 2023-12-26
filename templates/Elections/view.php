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
                    <td><?= h($election->electoral_system) ?></td>
                </tr>
                <tr>
                    <th><?= __('Government Type') ?></th>
                    <td><?= h($election->parliamentary_status) ?></td>
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
                    <th><?= __('Majority') ?></th>
                    <td>
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

            <div class="related"> <?php if (!empty($election->electorates)) : ?>
                <div style="display: flex; align-items: center;">
                <h4 style="margin-right: 100px"><?= __('Electorates') ?></h4>
                    <select id="stateSelector" style="margin-right: -250px;max-width: 255px;">
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

                    <input type="text" id="electorateSearch" placeholder="Search electorates..." style="max-width:200px; margin-left: 280px;">
                    <button id="searchElectorateButton" class="btn-custom" style="margin-left: 10px; margin-bottom: 15px">Search</button>
                </div>

                    <div class="table-responsive">
                        <table id="electoratesTable">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Jurisdiction') ?></th>
                                <th><?= __('Type') ?></th>
                            </tr>
                            <?php foreach ($election->electorates as $electorates) : ?>
                                <tr data-state="<?= h($electorates->jurisdiction) ?>">
                                    <td><?= $this->Html->link(
                                            h($electorates->name),
                                            ['controller' => 'Electorates', 'action' => 'view', $electorates->id]
                                        ) ?></td>
                                    <td><?= h($electorates->jurisdiction) ?></td>
                                    <td><?= h($electorates->type) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- eventually 8 buttons for senate results in each jurisdiction-->
            </div>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    $(document).ready(function () {
        // Listen for changes in the stateSelector dropdown
        $('#stateSelector').on('change', function () {
            // Get the selected state value
            var selectedState = $(this).val();

            // Hide all electorates
            $('table#electoratesTable tr').hide();

            // Show only electorates that match the selected state
            if (selectedState !== '') {
                $('table#electoratesTable tr[data-state="' + selectedState + '"]').show();
            } else {
                // Show all electorates if no state is selected
                $('table#electoratesTable tr').show();
            }

            // Jump down 50 pixels
            $('html, body').animate({
                scrollTop: $(document).scrollTop() + 200
            }, 500);
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
