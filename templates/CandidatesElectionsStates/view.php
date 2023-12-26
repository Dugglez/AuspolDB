<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesElectionsState $candidatesElectionsState
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Candidates Elections State'), ['action' => 'edit', $candidatesElectionsState->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Candidates Elections State'), ['action' => 'delete', $candidatesElectionsState->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesElectionsState->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Candidates Elections States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Candidates Elections State'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesElectionsStates view content">
            <h3><?= h($candidatesElectionsState->state) ?></h3>
            <table>
                <tr>
                    <th><?= __('Candidate') ?></th>
                    <td><?= $candidatesElectionsState->has('candidate') ? $this->Html->link($candidatesElectionsState->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $candidatesElectionsState->candidate->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Election') ?></th>
                    <td><?= $candidatesElectionsState->has('election') ? $this->Html->link($candidatesElectionsState->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $candidatesElectionsState->election->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($candidatesElectionsState->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($candidatesElectionsState->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Votes') ?></th>
                    <td><?= $candidatesElectionsState->votes === null ? '' : $this->Number->format($candidatesElectionsState->votes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Swing') ?></th>
                    <td><?= $candidatesElectionsState->swing === null ? '' : $this->Number->format($candidatesElectionsState->swing) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $candidatesElectionsState->position === null ? '' : $this->Number->format($candidatesElectionsState->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Winner') ?></th>
                    <td><?= $candidatesElectionsState->winner ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
