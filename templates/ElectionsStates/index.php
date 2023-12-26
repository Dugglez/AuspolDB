<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ElectionsState> $electionsStates
 */
?>
<div class="electionsStates index content">
    <?= $this->Html->link(__('New Elections State'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Elections States') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('formal_votes') ?></th>
                    <th><?= $this->Paginator->sort('informal_votes') ?></th>
                    <th><?= $this->Paginator->sort('turnout') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($electionsStates as $electionsState): ?>
                <tr>
                    <td><?= $this->Number->format($electionsState->id) ?></td>
                    <td><?= h($electionsState->state) ?></td>
                    <td><?= $electionsState->formal_votes === null ? '' : $this->Number->format($electionsState->formal_votes) ?></td>
                    <td><?= $electionsState->informal_votes === null ? '' : $this->Number->format($electionsState->informal_votes) ?></td>
                    <td><?= $electionsState->turnout === null ? '' : $this->Number->format($electionsState->turnout) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $electionsState->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $electionsState->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $electionsState->id], ['confirm' => __('Are you sure you want to delete # {0}?', $electionsState->id)]) ?>
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
