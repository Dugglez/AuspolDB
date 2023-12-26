<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElectionsElectoratesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElectionsElectoratesTable Test Case
 */
class ElectionsElectoratesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ElectionsElectoratesTable
     */
    protected $ElectionsElectorates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ElectionsElectorates',
        'app.Elections',
        'app.Electorates',
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
        $config = $this->getTableLocator()->exists('ElectionsElectorates') ? [] : ['className' => ElectionsElectoratesTable::class];
        $this->ElectionsElectorates = $this->getTableLocator()->get('ElectionsElectorates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ElectionsElectorates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ElectionsElectoratesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ElectionsElectoratesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
