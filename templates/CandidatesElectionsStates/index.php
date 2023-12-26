<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CandidatesElectionsState> $candidatesElectionsStates
 */
?>
<div class="candidatesElectionsStates index content">
    <?= $this->Html->link(__('New Candidates Elections State'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Candidates Elections States') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('candidate_id') ?></th>
                    <th><?= $this->Paginator->sort('election_id') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('votes') ?></th>
                    <th><?= $this->Paginator->sort('swing') ?></th>
                    <th><?= $this->Paginator->sort('winner') ?></th>
                    <th><?= $this->Paginator->sort('position') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidatesElectionsStates as $candidatesElectionsState): ?>
                <tr>
                    <td><?= $this->Number->format($candidatesElectionsState->id) ?></td>
                    <td><?= $candidatesElectionsState->has('candidate') ? $this->Html->link($candidatesElectionsState->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $candidatesElectionsState->candidate->id]) : '' ?></td>
                    <td><?= $candidatesElectionsState->has('election') ? $this->Html->link($candidatesElectionsState->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $candidatesElectionsState->election->id]) : '' ?></td>
                    <td><?= h($candidatesElectionsState->state) ?></td>
                    <td><?= $candidatesElectionsState->votes === null ? '' : $this->Number->format($candidatesElectionsState->votes) ?></td>
                    <td><?= $candidatesElectionsState->swing === null ? '' : $this->Number->format($candidatesElectionsState->swing) ?></td>
                    <td><?= h($candidatesElectionsState->winner) ?></td>
                    <td><?= $candidatesElectionsState->position === null ? '' : $this->Number->format($candidatesElectionsState->position) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $candidatesElectionsState->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidatesElectionsState->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidatesElectionsState->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesElectionsState->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
