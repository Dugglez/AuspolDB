<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ElectionsState $electionsState
 * @var string[]|\Cake\Collection\CollectionInterface $candidates
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $electionsState->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $electionsState->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Elections States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="electionsStates form content">
            <?= $this->Form->create($electionsState) ?>
            <fieldset>
                <legend><?= __('Edit Elections State') ?></legend>
                <?php
                    echo $this->Form->control('state');
                    echo $this->Form->control('composition');
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
