<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ElectionsElectoratesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ElectionsElectoratesController Test Case
 *
 * @uses \App\Controller\ElectionsElectoratesController
 */
class ElectionsElectoratesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        'app.CandidatesElectionsElectorates',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ElectionsElectoratesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ElectionsElectoratesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ElectionsElectoratesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ElectionsElectoratesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ElectionsElectoratesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
