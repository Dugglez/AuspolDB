<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CandidatesPartiesElectionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CandidatesPartiesElectionsController Test Case
 *
 * @uses \App\Controller\CandidatesPartiesElectionsController
 */
class CandidatesPartiesElectionsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\CandidatesPartiesElectionsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\CandidatesPartiesElectionsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\CandidatesPartiesElectionsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\CandidatesPartiesElectionsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\CandidatesPartiesElectionsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
