<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesElectionsElectorate $candidatesElectionsElectorate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Candidates Elections Electorate'), ['action' => 'edit', $candidatesElectionsElectorate->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Candidates Elections Electorate'), ['action' => 'delete', $candidatesElectionsElectorate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesElectionsElectorate->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Candidates Elections Electorates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Candidates Elections Electorate'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesElectionsElectorates view content">
            <h3><?= h($candidatesElectionsElectorate->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Candidate') ?></th>
                    <td><?= $candidatesElectionsElectorate->has('candidate') ? $this->Html->link($candidatesElectionsElectorate->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $candidatesElectionsElectorate->candidate->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Election') ?></th>
                    <td><?= $candidatesElectionsElectorate->has('election') ? $this->Html->link($candidatesElectionsElectorate->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $candidatesElectionsElectorate->election->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Electorate') ?></th>
                    <td><?= $candidatesElectionsElectorate->has('electorate') ? $this->Html->link($candidatesElectionsElectorate->electorate->name, ['controller' => 'Electorates', 'action' => 'view', $candidatesElectionsElectorate->electorate->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Party') ?></th>
                    <td><?= $candidatesElectionsElectorate->has('party') ? $this->Html->link($candidatesElectionsElectorate->party->name, ['controller' => 'Parties', 'action' => 'view', $candidatesElectionsElectorate->party->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($candidatesElectionsElectorate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Votes') ?></th>
                    <td><?= $this->Number->format($candidatesElectionsElectorate->votes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Swing') ?></th>
                    <td><?= $this->Number->format($candidatesElectionsElectorate->swing) ?></td>
                </tr>
                <tr>
                    <th><?= __('Winner') ?></th>
                    <td><?= $candidatesElectionsElectorate->winner ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
