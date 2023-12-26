<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesPartiesElection $candidatesPartiesElection
 * @var string[]|\Cake\Collection\CollectionInterface $candidates
 * @var string[]|\Cake\Collection\CollectionInterface $parties
 * @var string[]|\Cake\Collection\CollectionInterface $elections
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidatesPartiesElection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesPartiesElection->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Candidates Parties Elections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesPartiesElections form content">
            <?= $this->Form->create($candidatesPartiesElection) ?>
            <fieldset>
                <legend><?= __('Edit Candidates Parties Election') ?></legend>
                <?php
                    echo $this->Form->control('candidate_id', ['options' => $candidates]);
                    echo $this->Form->control('party_id', ['options' => $parties]);
                    echo $this->Form->control('election_id', ['options' => $elections]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
