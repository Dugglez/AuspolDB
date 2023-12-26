<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatesElectionsElectoratesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatesElectionsElectoratesTable Test Case
 */
class CandidatesElectionsElectoratesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatesElectionsElectoratesTable
     */
    protected $CandidatesElectionsElectorates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CandidatesElectionsElectorates',
        'app.Candidates',
        'app.Elections',
        'app.Electorates',
        'app.Parties',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CandidatesElectionsElectorates') ? [] : ['className' => CandidatesElectionsElectoratesTable::class];
        $this->CandidatesElectionsElectorates = $this->getTableLocator()->get('CandidatesElectionsElectorates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CandidatesElectionsElectorates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesElectionsElectoratesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesElectionsElectoratesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
