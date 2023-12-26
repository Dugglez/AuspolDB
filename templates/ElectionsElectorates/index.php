<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ElectionsElectorate> $electionsElectorates
 */
?>
<div class="electionsElectorates index content">
    <?= $this->Html->link(__('New Elections Electorate'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Elections Electorates') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('election_id') ?></th>
                    <th><?= $this->Paginator->sort('electorate_id') ?></th>
                    <th><?= $this->Paginator->sort('twocp_or_majority') ?></th>
                    <th><?= $this->Paginator->sort('winning_candidate') ?></th>
                    <th><?= $this->Paginator->sort('winning_party') ?></th>
                    <th><?= $this->Paginator->sort('second_candidate') ?></th>
                    <th><?= $this->Paginator->sort('second_party') ?></th>
                    <th><?= $this->Paginator->sort('formal_votes') ?></th>
                    <th><?= $this->Paginator->sort('informal_votes') ?></th>
                    <th><?= $this->Paginator->sort('turnout') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($electionsElectorates as $electionsElectorate): ?>
                <tr>
                    <td><?= $this->Number->format($electionsElectorate->id) ?></td>
                    <td><?= $electionsElectorate->has('election') ? $this->Html->link($electionsElectorate->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $electionsElectorate->election->id]) : '' ?></td>
                    <td><?= $electionsElectorate->has('electorate') ? $this->Html->link($electionsElectorate->electorate->name, ['controller' => 'Electorates', 'action' => 'view', $electionsElectorate->electorate->id]) : '' ?></td>
                    <td><?= $this->Number->format($electionsElectorate->twocp_or_majority) ?></td>
                    <td><?= $this->Number->format($electionsElectorate->winning_candidate) ?></td>
                    <td><?= $this->Number->format($electionsElectorate->winning_party) ?></td>
                    <td><?= $electionsElectorate->second_candidate === null ? '' : $this->Number->format($electionsElectorate->second_candidate) ?></td>
                    <td><?= $electionsElectorate->second_party === null ? '' : $this->Number->format($electionsElectorate->second_party) ?></td>
                    <td><?= $electionsElectorate->formal_votes === null ? '' : $this->Number->format($electionsElectorate->formal_votes) ?></td>
                    <td><?= $electionsElectorate->informal_votes === null ? '' : $this->Number->format($electionsElectorate->informal_votes) ?></td>
                    <td><?= $electionsElectorate->turnout === null ? '' : $this->Number->format($electionsElectorate->turnout) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $electionsElectorate->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $electionsElectorate->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $electionsElectorate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $electionsElectorate->id)]) ?>
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
