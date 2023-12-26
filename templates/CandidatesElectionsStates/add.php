<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CandidatesElectionsState $candidatesElectionsState
 * @var \Cake\Collection\CollectionInterface|string[] $candidates
 * @var \Cake\Collection\CollectionInterface|string[] $elections
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Candidates Elections States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="candidatesElectionsStates form content">
            <?= $this->Form->create($candidatesElectionsState) ?>
            <fieldset>
                <legend><?= __('Add Candidates Elections State') ?></legend>
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
