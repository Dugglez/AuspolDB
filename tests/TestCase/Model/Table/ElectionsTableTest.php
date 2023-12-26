<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElectionsTable Test Case
 */
class ElectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ElectionsTable
     */
    protected $Elections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Elections',
        'app.CandidatesElectionsElectorates',
        'app.CandidatesElectionsStates',
        'app.CandidatesPartiesElections',
        'app.Electorates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Elections') ? [] : ['className' => ElectionsTable::class];
        $this->Elections = $this->getTableLocator()->get('Elections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Elections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ElectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
