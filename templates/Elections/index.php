<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Election> $elections
 */

use Cake\Chronos\Chronos;

?>
<style>
    .btn-custom-green {
        display: inline-block;
        padding: 6px 20px; /* Adjusted padding */
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50; /* Green color */
        color: white;
        border: 1px solid #4CAF50;
        border-radius: 5px;
        cursor: pointer;
        line-height: 24px; /* Adjusted line-height */
        margin-bottom: 20px; /* Added margin to the bottom */
    }

    .btn-custom-green:hover {
        background-color: #45a049; /* Darker green color */
    }

    .btn-custom-grey {
        display: inline-block;
        padding: 6px 20px; /* Adjusted padding */
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #D3D3D3; /* Grey color */
        color: black;
        border: 1px solid #D3D3D3;
        border-radius: 5px;
        cursor: pointer;
        line-height: 24px; /* Adjusted line-height */
        margin-bottom: 20px; /* Added margin to the bottom */
    }

    .btn-custom-grey:hover {
        background-color: #A9A9A9; /* Darker grey color */
    }
</style>



<div class="elections index content">
    <div class="jurisdiction-buttons" style="display: flex; justify-content: space-between;">
        <h3><?= __('Elections') ?></h3>
        <?php
$jurisdictions = ['Federal', 'ACT', 'VIC', 'NSW', 'NT', 'WA', 'SA', 'TAS', 'QLD'];

foreach ($jurisdictions as $jurisdiction) {
    // Set the class based on the jurisdiction
    $class = in_array($jurisdiction, ['Federal', 'NSW', 'VIC', 'QLD', 'NT', 'ACT']) ? 'btn btn-custom-green' : 'btn btn-custom-grey';

    echo $this->Html->link(
        $jurisdiction,
        ['controller' => 'Elections', 'action' => 'index', '?' => ['jurisdiction' => $jurisdiction]],
        ['class' => $class]
    );
}
?>
    </div>



    <div class="table-responsive">
        <table>
            <thead>
                <tr>

                    <th><?= h('Election') ?></th>



                    <th><?= h('Outgoing Government') ?></th>
                    <th><?= h('Incoming Government') ?></th>


                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($elections as $election): ?>
                <tr>

                    <td><?= $this->Html->link(
                            h($election->date->format('Y')) . ' ' . h($election->jurisdiction),
                            ['controller' => 'Elections', 'action' => 'view', $election->id]
                        ) ?></td>

                    <td>
                        <?php
                        if ($election->outgoing_government_party !== null) {
                            $partyName = $parties->get($election->outgoing_government_party)->name;
                            echo $this->Html->link(
                                h($partyName),
                                ['controller' => 'Parties', 'action' => 'view', $election->outgoing_government_party]
                            );
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($election->incoming_government_party !== null) {
                            $partyName = $parties->get($election->incoming_government_party)->name;
                            echo $this->Html->link(
                                h($partyName),
                                ['controller' => 'Parties', 'action' => 'view', $election->incoming_government_party]
                            );
                        }
                        ?>
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
