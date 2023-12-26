<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatesElectionsStatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatesElectionsStatesTable Test Case
 */
class CandidatesElectionsStatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatesElectionsStatesTable
     */
    protected $CandidatesElectionsStates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CandidatesElectionsStates',
        'app.Candidates',
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
        $config = $this->getTableLocator()->exists('CandidatesElectionsStates') ? [] : ['className' => CandidatesElectionsStatesTable::class];
        $this->CandidatesElectionsStates = $this->getTableLocator()->get('CandidatesElectionsStates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CandidatesElectionsStates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesElectionsStatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesElectionsStatesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
