<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CandidatesElectionsStatesFixture
 */
class CandidatesElectionsStatesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'candidate_id' => 1,
                'election_id' => 1,
                'state' => 'Lorem ipsum dolor sit amet',
                'votes' => 1,
                'swing' => 1.5,
                'winner' => 1,
                'position' => 1,
            ],
        ];
        parent::init();
    }
}
