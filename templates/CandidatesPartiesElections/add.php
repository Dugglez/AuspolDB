<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesPartiesElection $candidatesPartiesElection
 * @var \Cake\Collection\CollectionInterface|string[] $candidates
 * @var \Cake\Collection\CollectionInterface|string[] $parties
 * @var \Cake\Collection\CollectionInterface|string[] $elections
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Candidates Parties Elections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesPartiesElections form content">
            <?= $this->Form->create($candidatesPartiesElection) ?>
            <fieldset>
                <legend><?= __('Add Candidates Parties Election') ?></legend>
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
