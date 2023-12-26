<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CandidatesPartiesElection> $candidatesPartiesElections
 */
?>
<div class="candidatesPartiesElections index content">
    <?= $this->Html->link(__('New Candidates Parties Election'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Candidates Parties Elections') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('candidate_id') ?></th>
                    <th><?= $this->Paginator->sort('party_id') ?></th>
                    <th><?= $this->Paginator->sort('election_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidatesPartiesElections as $candidatesPartiesElection): ?>
                <tr>
                    <td><?= $this->Number->format($candidatesPartiesElection->id) ?></td>
                    <td><?= $candidatesPartiesElection->has('candidate') ? $this->Html->link($candidatesPartiesElection->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $candidatesPartiesElection->candidate->id]) : '' ?></td>
                    <td><?= $candidatesPartiesElection->has('party') ? $this->Html->link($candidatesPartiesElection->party->name, ['controller' => 'Parties', 'action' => 'view', $candidatesPartiesElection->party->id]) : '' ?></td>
                    <td><?= $candidatesPartiesElection->has('election') ? $this->Html->link($candidatesPartiesElection->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $candidatesPartiesElection->election->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $candidatesPartiesElection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidatesPartiesElection->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidatesPartiesElection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesPartiesElection->id)]) ?>
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
