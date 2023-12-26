<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesPartiesElection $candidatesPartiesElection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Candidates Parties Election'), ['action' => 'edit', $candidatesPartiesElection->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Candidates Parties Election'), ['action' => 'delete', $candidatesPartiesElection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesPartiesElection->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Candidates Parties Elections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Candidates Parties Election'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesPartiesElections view content">
            <h3><?= h($candidatesPartiesElection->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Candidate') ?></th>
                    <td><?= $candidatesPartiesElection->has('candidate') ? $this->Html->link($candidatesPartiesElection->candidate->name, ['controller' => 'Candidates', 'action' => 'view', $candidatesPartiesElection->candidate->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Party') ?></th>
                    <td><?= $candidatesPartiesElection->has('party') ? $this->Html->link($candidatesPartiesElection->party->name, ['controller' => 'Parties', 'action' => 'view', $candidatesPartiesElection->party->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Election') ?></th>
                    <td><?= $candidatesPartiesElection->has('election') ? $this->Html->link($candidatesPartiesElection->election->jurisdiction, ['controller' => 'Elections', 'action' => 'view', $candidatesPartiesElection->election->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($candidatesPartiesElection->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
