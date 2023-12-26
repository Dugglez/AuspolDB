<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ElectionsElectoratesFixture
 */
class ElectionsElectoratesFixture extends TestFixture
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
                'election_id' => 1,
                'electorate_id' => 1,
                'twocp_or_majority' => 1.5,
                'winning_candidate' => 1,
                'winning_party' => 1,
                'second_candidate' => 1,
                'second_party' => 1,
                'formal_votes' => 1,
                'informal_votes' => 1,
                'turnout' => 1.5,
            ],
        ];
        parent::init();
    }
}
