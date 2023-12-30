<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Party> $parties
 */
?><style>
    .btn-custom {
        display: inline-block;
        padding: 6px 20px; /* Adjusted padding */
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50; /* Green color, you can change this */
        color: white;
        border: 1px solid #4CAF50;
        border-radius: 5px;
        cursor: pointer;
        line-height: 24px; /* Adjusted line-height */
        margin-bottom: 20px; /* Added margin to the bottom */
    }

    .btn-custom:hover {
        background-color: #45a049; /* Darker green color, you can change this */
    }
</style>
<div class="parties index content">

    <div style="display: flex; align-items: center;">
        <h3><?= __('Parties') ?></h3>
        <input type="text" id="partySearch" placeholder="Search parties..." style="max-width: 375px; margin-left: 480px;">
        <?= $this->Html->link('Search', '#', ['id' => 'searchButton', 'class' => 'btn-custom', 'style' => 'margin-left: 10px; margin-bottom: 15px']) ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= h('Name') ?></th>
                    <th><?= h('Founded') ?></th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($parties as $party): ?>
                <tr>
                    <td><?= $this->Html->link(h($party->name), ['controller' => 'Parties', 'action' => 'view', $party->id]) ?></td>
                    <td><?= h($party->founded ? $party->founded->format('Y') : 'Unknown') ?></td>


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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to handle party search
        function performPartySearch() {
            // Get the search input value
            var searchString = $('#partySearch').val();

            // Create a link with the search query
            var searchLink = '<?= $this->Url->build(['controller' => 'Parties', 'action' => 'index']) ?>?search=' + searchString;

            // Navigate to the link
            window.location.href = searchLink;
        }

        // Event listener for Enter key press
        $('#partySearch').on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default form submission behavior
                performPartySearch();
            }
        });

        // Event listener for button click
        $('#searchButton').on('click', function() {
            performPartySearch();
        });
    });
</script>
