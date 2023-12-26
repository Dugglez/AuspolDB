<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ElectionsElectorate $electionsElectorate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Elections Electorate'), ['action' => 'edit', $electionsElectorate->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Elections Electorate'), ['action' => 'delete', $electionsElectorate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $electionsElectorate->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Elections Electorates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Elections Electorate'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="electionsElectorates view content">
            <h3><?= h($electionsElectorate->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Election') ?></th>
                    <td><?= $electionsElectorate->has('election') ? $this->Html->link($electionsElectorate->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $electionsElectorate->election->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Electorate') ?></th>
                    <td><?= $electionsElectorate->has('electorate') ? $this->Html->link($electionsElectorate->electorate->name, ['controller' => 'Electorates', 'action' => 'view', $electionsElectorate->electorate->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($electionsElectorate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Twocp Or Majority') ?></th>
                    <td><?= $this->Number->format($electionsElectorate->twocp_or_majority) ?></td>
                </tr>
                <tr>
                    <th><?= __('Winning Candidate') ?></th>
                    <td><?= $this->Number->format($electionsElectorate->winning_candidate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Winning Party') ?></th>
                    <td><?= $this->Number->format($electionsElectorate->winning_party) ?></td>
                </tr>
                <tr>
                    <th><?= __('Second Candidate') ?></th>
                    <td><?= $electionsElectorate->second_candidate === null ? '' : $this->Number->format($electionsElectorate->second_candidate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Second Party') ?></th>
                    <td><?= $electionsElectorate->second_party === null ? '' : $this->Number->format($electionsElectorate->second_party) ?></td>
                </tr>
                <tr>
                    <th><?= __('Formal Votes') ?></th>
                    <td><?= $electionsElectorate->formal_votes === null ? '' : $this->Number->format($electionsElectorate->formal_votes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Informal Votes') ?></th>
                    <td><?= $electionsElectorate->informal_votes === null ? '' : $this->Number->format($electionsElectorate->informal_votes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Turnout') ?></th>
                    <td><?= $electionsElectorate->turnout === null ? '' : $this->Number->format($electionsElectorate->turnout) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Candidates') ?></h4>
                <?php if (!empty($electionsElectorate->candidates)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($electionsElectorate->candidates as $candidates) : ?>
                        <tr>
                            <td><?= h($candidates->id) ?></td>
                            <td><?= h($candidates->name) ?></td>
                            <td><?= h($candidates->description) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Candidates', 'action' => 'view', $candidates->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Candidates', 'action' => 'edit', $candidates->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Candidates', 'action' => 'delete', $candidates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidates->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
