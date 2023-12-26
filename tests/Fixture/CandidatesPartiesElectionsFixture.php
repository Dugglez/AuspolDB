<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CandidatesPartiesElectionsFixture
 */
class CandidatesPartiesElectionsFixture extends TestFixture
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
                'party_id' => 1,
                'election_id' => 1,
            ],
        ];
        parent::init();
    }
}
