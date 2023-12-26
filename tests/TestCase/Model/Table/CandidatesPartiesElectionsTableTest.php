<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatesPartiesElectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatesPartiesElectionsTable Test Case
 */
class CandidatesPartiesElectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatesPartiesElectionsTable
     */
    protected $CandidatesPartiesElections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CandidatesPartiesElections',
        'app.Candidates',
        'app.Parties',
        'app.Elections',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CandidatesPartiesElections') ? [] : ['className' => CandidatesPartiesElectionsTable::class];
        $this->CandidatesPartiesElections = $this->getTableLocator()->get('CandidatesPartiesElections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CandidatesPartiesElections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesPartiesElectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesPartiesElectionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
