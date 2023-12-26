<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElectoratesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElectoratesTable Test Case
 */
class ElectoratesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ElectoratesTable
     */
    protected $Electorates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Electorates',
        'app.CandidatesElectionsElectorates',
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
        $config = $this->getTableLocator()->exists('Electorates') ? [] : ['className' => ElectoratesTable::class];
        $this->Electorates = $this->getTableLocator()->get('Electorates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Electorates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ElectoratesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
