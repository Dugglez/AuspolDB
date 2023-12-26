<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidate $candidate
 */
?>


    <div class="column-responsive column-80">
        <div class="candidates view content">
            <h3><?= h($candidate->name) ?></h3>

            <div class="text">
                <strong><?= __('About') ?></strong>
                 <br><br>
                <?= $this->Text->autoParagraph(
                    h($candidate->description) ?: 'No information available.'
                ); ?>


            </div>
            <div class="related">
                <h4><?= __('Lower House Contests') ?></h4>
                <?php if (!empty($lowerHouseContests)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Election') ?></th>
                                <th><?= __('Electorate') ?></th>
                                <th><?= __('Party') ?></th>
                                <th><?= __('Votes') ?></th>
                                <th><?= __('Swing') ?></th>
                                <th><?= __('Elected?') ?></th>

                            </tr>
                            <?php foreach ($lowerHouseContests as $lowerHouseContest) : ?>
                                <tr>
                                    <td>
                                        <?php
                                        $electionId = $lowerHouseContest->election_id;
                                        $election = $elections->get($electionId);

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


                                        // Format the election information
                                        $electionInfo = $this->Html->link(
                                            h($election->date->format('Y') . ' ' . $jurisdiction),
                                            ['controller' => 'Elections', 'action' => 'view', $electionId],
                                            ['date' => $election->date]
                                        );

                                        echo $electionInfo;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        $electorateId = $lowerHouseContest->electorate_id;
                                        $electorate = $electorates->get($electorateId);

                                        // Format the electorate information
                                        $electorateInfo = $this->Html->link(
                                            h($electorate->name),
                                            ['controller' => 'Electorates', 'action' => 'view', $electorateId]
                                        );

                                        echo $electorateInfo;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        $partyId = $lowerHouseContest->party_id;
                                        $party = $parties->get($partyId);

                                        // Format the party information
                                        $partyInfo = $this->Html->link(
                                            h($party->name),
                                            ['controller' => 'Parties', 'action' => 'view', $partyId]
                                        );

                                        echo $partyInfo;
                                        ?>
                                    </td>
                                    <td><?= h($lowerHouseContest->votes) ?></td>
                                    <td>
                                        <?php
                                        $swing = h($lowerHouseContest->swing);
                                        if ($swing > 0) {
                                            echo $swing . ' <img src="/webroot/img/green.png" alt="Up Arrow" style="max-width: 15px; max-height: 15px;">';
                                        }
                                        elseif ($swing < 0) {
                                            echo $swing . ' <img src="/webroot/img/red.png" alt="Down Arrow" style="max-width: 15px; max-height: 15px;">';
                                        } else {
                                            echo $swing; // Display swing percentage without arrow for zero swing
                                        }
                                        ?>
                                    </td>

                                    <td><?= h($lowerHouseContest->winner) ? __('Yes') : __('No') ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($candidate->elections_states)) : ?>
            <div class="related">
                <h4><?= __('Upper House Contests') ?></h4>

                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('Composition') ?></th>
                            <th><?= __('Formal Votes') ?></th>
                            <th><?= __('Informal Votes') ?></th>
                            <th><?= __('Turnout') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($candidate->elections_states as $electionsStates) : ?>
                        <tr>
                            <td><?= h($electionsStates->id) ?></td>
                            <td><?= h($electionsStates->state) ?></td>
                            <td><?= h($electionsStates->composition) ?></td>
                            <td><?= h($electionsStates->formal_votes) ?></td>
                            <td><?= h($electionsStates->informal_votes) ?></td>
                            <td><?= h($electionsStates->turnout) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ElectionsStates', 'action' => 'view', $electionsStates->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ElectionsStates', 'action' => 'edit', $electionsStates->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ElectionsStates', 'action' => 'delete', $electionsStates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $electionsStates->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

                </div>
                <?php endif; ?>

            <?php if (!empty($candidate->candidates_parties_elections)) : ?>
            <div class="related">
                <h4><?= __('Parties led at an election') ?></h4>

                <div class="table-responsive">
                    <table>
                        <tr>


                            <th><?= __('Party') ?></th>
                            <th><?= __('Election') ?></th>

                        </tr>
                        <?php foreach ($candidate->candidates_parties_elections as $candidatesPartiesElections) : ?>
                            <tr>
                                <td> 
                                <?php
                                $partyId =$candidatesPartiesElections->party_id;
                                $party = $parties->get($partyId);

                                // Format the party information
                                $partyInfo = $this->Html->link(
                                    h($party->name),
                                    ['controller' => 'Parties', 'action' => 'view', $partyId]
                                );

                                echo $partyInfo;
                                ?>
                               </td>
                                <td>
                                    <?php
                                    $electionId = $candidatesPartiesElections->election_id;
                                    $election = $elections->get($electionId);

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


                                    // Format the election information
                                    $electionInfo = $this->Html->link(
                                        h($election->date->format('Y') . ' ' . $jurisdiction),
                                        ['controller' => 'Elections', 'action' => 'view', $electionId],
                                        ['date' => $election->date]
                                    );

                                    echo $electionInfo;
                                    ?>
                                </td>


                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>

            </div>

    </div>
</div>
