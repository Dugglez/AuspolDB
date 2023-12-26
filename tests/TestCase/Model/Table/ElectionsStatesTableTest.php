<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElectionsStatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElectionsStatesTable Test Case
 */
class ElectionsStatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ElectionsStatesTable
     */
    protected $ElectionsStates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ElectionsStates',
        'app.Candidates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ElectionsStates') ? [] : ['className' => ElectionsStatesTable::class];
        $this->ElectionsStates = $this->getTableLocator()->get('ElectionsStates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ElectionsStates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ElectionsStatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
