<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ElectionsFixture
 */
class ElectionsFixture extends TestFixture
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
                'date' => '2023-12-24',
                'jurisdiction' => 'Lorem ipsum dolor sit amet',
                'electoral_system' => 'Lorem ipsum dolor sit amet',
                'parliamentary_status' => 'Lorem ipsum dolor sit amet',
                'outgoing_government_party' => 1,
                'incoming_government_party' => 1,
                'government_seats' => 1,
                'nongovernment_seats' => 1,
            ],
        ];
        parent::init();
    }
}
