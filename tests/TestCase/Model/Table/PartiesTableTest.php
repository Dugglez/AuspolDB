<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartiesTable Test Case
 */
class PartiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartiesTable
     */
    protected $Parties;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Parties',
        'app.CandidatesElectionsElectorates',
        'app.CandidatesPartiesElections',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Parties') ? [] : ['className' => PartiesTable::class];
        $this->Parties = $this->getTableLocator()->get('Parties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Parties);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PartiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
