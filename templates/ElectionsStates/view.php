<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ElectionsState $electionsState
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Elections State'), ['action' => 'edit', $electionsState->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Elections State'), ['action' => 'delete', $electionsState->id], ['confirm' => __('Are you sure you want to delete # {0}?', $electionsState->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Elections States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Elections State'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="electionsStates view content">
            <h3><?= h($electionsState->state) ?></h3>
            <table>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($electionsState->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($electionsState->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Formal Votes') ?></th>
                    <td><?= $electionsState->formal_votes === null ? '' : $this->Number->format($electionsState->formal_votes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Informal Votes') ?></th>
                    <td><?= $electionsState->informal_votes === null ? '' : $this->Number->format($electionsState->informal_votes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Turnout') ?></th>
                    <td><?= $electionsState->turnout === null ? '' : $this->Number->format($electionsState->turnout) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Composition') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($electionsState->composition)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Candidates') ?></h4>
                <?php if (!empty($electionsState->candidates)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($electionsState->candidates as $candidates) : ?>
                        <tr>
                            <td><?= h($candidates->id) ?></td>
                            <td><?= h($candidates->name) ?></td>
                            <td><?= h($candidates->description) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Candidates', 'action' => 'view', $candidates->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Candidates', 'action' => 'edit', $candidates->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Candidates', 'action' => 'delete', $candidates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidates->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
