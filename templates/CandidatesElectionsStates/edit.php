<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesElectionsState $candidatesElectionsState
 * @var string[]|\Cake\Collection\CollectionInterface $candidates
 * @var string[]|\Cake\Collection\CollectionInterface $elections
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidatesElectionsState->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $candidatesElectionsState->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Candidates Elections States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesElectionsStates form content">
            <?= $this->Form->create($candidatesElectionsState) ?>
            <fieldset>
                <legend><?= __('Edit Candidates Elections State') ?></legend>
                <?php
                    echo $this->Form->control('candidate_id', ['options' => $candidates]);
                    echo $this->Form->control('election_id', ['options' => $elections]);
                    echo $this->Form->control('state');
                    echo $this->Form->control('votes');
                    echo $this->Form->control('swing');
                    echo $this->Form->control('winner');
                    echo $this->Form->control('position');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
