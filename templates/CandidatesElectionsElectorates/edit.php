<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesElectionsElectorate $candidatesElectionsElectorate
 * @var string[]|\Cake\Collection\CollectionInterface $candidates
 * @var string[]|\Cake\Collection\CollectionInterface $elections
 * @var string[]|\Cake\Collection\CollectionInterface $electorates
 * @var string[]|\Cake\Collection\CollectionInterface $parties
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidatesElectionsElectorate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesElectionsElectorate->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Candidates Elections Electorates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesElectionsElectorates form content">
            <?= $this->Form->create($candidatesElectionsElectorate) ?>
            <fieldset>
                <legend><?= __('Edit Candidates Elections Electorate') ?></legend>
                <?php
                    echo $this->Form->control('candidate_id', ['options' => $candidates]);
                    echo $this->Form->control('election_id', ['options' => $elections]);
                    echo $this->Form->control('electorate_id', ['options' => $electorates]);
                    echo $this->Form->control('party_id', ['options' => $parties]);
                    echo $this->Form->control('votes');
                    echo $this->Form->control('swing');
                    echo $this->Form->control('winner');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
