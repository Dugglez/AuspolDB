<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CandidatesElectionsElectoratesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CandidatesElectionsElectoratesController Test Case
 *
 * @uses \App\Controller\CandidatesElectionsElectoratesController
 */
class CandidatesElectionsElectoratesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\CandidatesElectionsElectoratesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\CandidatesElectionsElectoratesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\CandidatesElectionsElectoratesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\CandidatesElectionsElectoratesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\CandidatesElectionsElectoratesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
