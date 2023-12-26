<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatesTable Test Case
 */
class CandidatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatesTable
     */
    protected $Candidates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Candidates',
        'app.CandidatesPartiesElections',
        'app.ElectionsElectorates',
        'app.ElectionsStates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Candidates') ? [] : ['className' => CandidatesTable::class];
        $this->Candidates = $this->getTableLocator()->get('Candidates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Candidates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CandidatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
