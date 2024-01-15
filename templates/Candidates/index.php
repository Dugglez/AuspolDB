<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Candidate> $candidates
 */
?>
<style>
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
<div class="candidates index content">
    <div style="display: flex; align-items: center;">
        <h3><?= __('Candidates') ?></h3>
        <a id="randomCandidateButton" href="#" style="white-space: nowrap; margin-left:20px" class="btn btn-custom">View Random Candidate</a>
        <a id="randomContestButton" href="#" style="white-space: nowrap; margin-left:20px" class="btn btn-custom">View Random Contest</a>
        <input type="text" id="candidateSearch" placeholder="Search candidates..." style="max-width: 375px; margin-left: 100px;">
        <?= $this->Html->link('Search', '#', ['id' => 'searchButton', 'class' => 'btn-custom', 'style' => 'margin-left: 10px; margin-bottom: 15px']) ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>

            </thead>
            <tbody>
            <table>
                <?php $count = 0; ?>
                <?php foreach ($candidates as $candidate): ?>
                    <?php if ($count % 4 == 0): ?>
                        <tr>
                    <?php endif; ?>

                    <td><?= $this->Html->link(
                            h($candidate->name),
                            ['action' => 'view', $candidate->id]
                        ) ?></td>

                    <?php if ($count % 4 == 3 || $count == count($candidates) - 1): ?>
                        </tr>
                    <?php endif; ?>

                    <?php $count++; ?>
                <?php endforeach; ?>
            </table>

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
        // Function to handle candidate search
        function performCandidateSearch() {
            // Get the search input value
            var searchString = $('#candidateSearch').val();
            var modifiedSearchString = searchString.replace(/'/g, '`');

            // Create a link with the search query
            var searchLink = '<?= $this->Url->build(['controller' => 'Candidates', 'action' => 'index']) ?>?search=' + modifiedSearchString;

            // Navigate to the link
            window.location.href = searchLink;
        }

        // Event listener for Enter key press
        $('#candidateSearch').on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default form submission behavior
                performCandidateSearch();
            }
        });

        // Event listener for button click
        $('#searchButton').on('click', function() {
            performCandidateSearch();
        });
    });
</script>

<?php
// Assuming $candidateIds is an array of candidate IDs
$candidateIdsJSON = json_encode($candidateIds);
?>


<script>
    document.getElementById('randomCandidateButton').addEventListener('click', function() {
        var candidateIds = <?php echo $candidateIdsJSON; ?>;

        if (Array.isArray(candidateIds) && candidateIds.length > 0) {
            // Generate a random candidate ID
            var randomCandidateId = candidateIds[Math.floor(Math.random() * candidateIds.length)];

            var randomCandidateUrl = '<?php echo $this->Url->build(['controller' => 'Candidates', 'action' => 'view']); ?>' + '/' + randomCandidateId;
            window.location.href = randomCandidateUrl;
        } else {
            // Handle the case when candidateIds is not a valid array
            console.error('Invalid candidateIds array');
        }
    });
</script>

<script>
    document.getElementById('randomContestButton').addEventListener('click', function() {
        var upperIds = <?php echo $upperIdsJson; ?>;
        var lowerIds = <?php echo $lowerIdsJson; ?>;

        if (Array.isArray(lowerIds) && Array.isArray(upperIds) && (upperIds.length + lowerIds.length) > 0) {
            // Generate a random number from 1 to 10
            var randomNumber = Math.floor(Math.random() * 10) + 1;

            if (randomNumber === 7) {
                // Select a random entry from upperIds
                var randomUpperEntry = upperIds[Math.floor(Math.random() * upperIds.length)];

                // Redirect to elections view with election_id and state as query string
                window.location.href = '/elections/view/' + randomUpperEntry.election_id + '?senate=' + encodeURIComponent(randomUpperEntry.state);
            } else {
                // Select a random entry from lowerIds
                var randomLowerEntry = lowerIds[Math.floor(Math.random() * lowerIds.length)];

                // Redirect to electorates view with electorate_id and election_id as query string
                window.location.href = '/electorates/view/' + randomLowerEntry.electorate_id + '?contest=' + randomLowerEntry.election_id;
            }
        } else {
            // Handle the case when candidateIds is not a valid array
            console.error('Invalid candidateIds array');
        }
    });

</script>

