<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ElectionsElectorate $electionsElectorate
 * @var \Cake\Collection\CollectionInterface|string[] $elections
 * @var \Cake\Collection\CollectionInterface|string[] $electorates
 * @var \Cake\Collection\CollectionInterface|string[] $candidates
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Elections Electorates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="electionsElectorates form content">
            <?= $this->Form->create($electionsElectorate) ?>
            <fieldset>
                <legend><?= __('Add Elections Electorate') ?></legend>
                <?php
                    echo $this->Form->control('election_id', ['options' => $elections]);
                    echo $this->Form->control('electorate_id', ['options' => $electorates]);
                    echo $this->Form->control('twocp_or_majority');
                    echo $this->Form->control('winning_candidate');
                    echo $this->Form->control('winning_party');
                    echo $this->Form->control('second_candidate');
                    echo $this->Form->control('second_party');
                    echo $this->Form->control('formal_votes');
                    echo $this->Form->control('informal_votes');
                    echo $this->Form->control('turnout');
                    echo $this->Form->control('candidates._ids', ['options' => $candidates]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
