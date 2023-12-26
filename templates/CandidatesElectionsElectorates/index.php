<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CandidatesElectionsElectorate> $candidatesElectionsElectorates
 */
?>
<div class="candidatesElectionsElectorates index content">
    <?= $this->Html->link(__('New Candidates Elections Electorate'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Candidates Elections Electorates') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('candidate_id') ?></th>
                    <th><?= $this->Paginator->sort('election_id') ?></th>
                    <th><?= $this->Paginator->sort('electorate_id') ?></th>
                    <th><?= $this->Paginator->sort('party_id') ?></th>
                    <th><?= $this->Paginator->sort('votes') ?></th>
                    <th><?= $this->Paginator->sort('swing') ?></th>
                    <th><?= $this->Paginator->sort('winner') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidatesElectionsElectorates as $candidatesElectionsElectorate): ?>
                <tr>
                    <td><?= $this->Number->format($candidatesElectionsElectorate->id) ?></td>
                    <td><?= $candidatesElectionsElectorate->has('candidate') ? $this->Html->link($candidatesElectionsElectorate->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $candidatesElectionsElectorate->candidate->id]) : '' ?></td>
                    <td><?= $candidatesElectionsElectorate->has('election') ? $this->Html->link($candidatesElectionsElectorate->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $candidatesElectionsElectorate->election->id]) : '' ?></td>
                    <td><?= $candidatesElectionsElectorate->has('electorate') ? $this->Html->link($candidatesElectionsElectorate->electorate->name, ['controller' => 'Electorates', 'action' => 'view', $candidatesElectionsElectorate->electorate->id]) : '' ?></td>
                    <td><?= $candidatesElectionsElectorate->has('party') ? $this->Html->link($candidatesElectionsElectorate->party->name, ['controller' => 'Parties', 'action' => 'view', $candidatesElectionsElectorate->party->id]) : '' ?></td>
                    <td><?= $this->Number->format($candidatesElectionsElectorate->votes) ?></td>
                    <td><?= $this->Number->format($candidatesElectionsElectorate->swing) ?></td>
                    <td><?= h($candidatesElectionsElectorate->winner) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $candidatesElectionsElectorate->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidatesElectionsElectorate->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidatesElectionsElectorate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesElectionsElectorate->id)]) ?>
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
