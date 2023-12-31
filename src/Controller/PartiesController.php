<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parties Controller
 *
 * @property \App\Model\Table\PartiesTable $Parties
 * @method \App\Model\Entity\Party[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $searchString = $this->request->getQuery('search');

        // Create a base query
        $query = $this->Parties->find('all');

        // Add a condition to filter parties based on the search query
        if ($searchString !== null) {
            $query->where(['name LIKE' => '%' . $searchString . '%']);
        }

        $parties = $this->paginate($query, ['limit' => 200]);

        $this->set(compact('parties'));
    }

    /**
     * View method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $party = $this->Parties->get($id, [
            'contain' => ['CandidatesElectionsElectorates', 'CandidatesPartiesElections'],
        ]);

        $candidates = $this->fetchTable('Candidates');
        $electorates = $this->fetchTable('Electorates');
        $elections = $this->fetchTable('Elections');

        // Get unique election IDs from CandidatesElectionsElectorates
        $uniqueElectionIds = array_unique(
            array_column($party['candidates_elections_electorates'], 'election_id')
        );

        $upperHouseContests = $this->fetchTable('CandidatesElectionsStates')->find('all', [
            'conditions' => ['CandidatesElectionsStates.party_id' => $id],
        ])->toArray();


        // Initialize the associative array for unique elections
        $uniqueElections = [];

        // Check if the election query parameter is set
        $selectedElectionId = $this->request->getQuery('election');

        if ($selectedElectionId !== null) {
            // Filter CandidatesElectionsElectorates based on the election query parameter
            $party['candidates_elections_electorates'] = array_filter(
                $party['candidates_elections_electorates'],
                function ($row) use ($selectedElectionId) {
                    return $row['election_id'] == $selectedElectionId;
                }
            );
        } else {
            // If the election query parameter is null, limit the results to 200
            $party['candidates_elections_electorates'] = array_slice($party['candidates_elections_electorates'], 0, 200);
        }

        // Populate the associative array with unique elections
        foreach ($uniqueElectionIds as $uniqueElectionId) {
            // Find the corresponding election
            $election = $elections->get($uniqueElectionId);

            // Concatenate jurisdiction with date (formatted as year)
            $electionDate = $election->date;
            $electionYear = $electionDate->format('Y');
            $electionLabel = $electionYear . ' ' . $election->jurisdiction;

            // Store in associative array
            $uniqueElections[$electionLabel] = $uniqueElectionId;
        }

        $this->set(compact('party', 'candidates', 'electorates', 'elections', 'uniqueElections', 'upperHouseContests'));
    }






    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    /*public function add()
    {
        $party = $this->Parties->newEmptyEntity();
        if ($this->request->is('post')) {
            $party = $this->Parties->patchEntity($party, $this->request->getData());
            if ($this->Parties->save($party)) {
                $this->Flash->success(__('The party has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The party could not be saved. Please, try again.'));
        }
        $this->set(compact('party'));
    }*/

    /**
     * Edit method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* public function edit($id = null)
     {
         $party = $this->Parties->get($id, [
             'contain' => [],
         ]);
         if ($this->request->is(['patch', 'post', 'put'])) {
             $party = $this->Parties->patchEntity($party, $this->request->getData());
             if ($this->Parties->save($party)) {
                 $this->Flash->success(__('The party has been saved.'));

                 return $this->redirect(['action' => 'index']);
             }
             $this->Flash->error(__('The party could not be saved. Please, try again.'));
         }
         $this->set(compact('party'));
     }*/

     /**
      * Delete method
      *
      * @param string|null $id Party id.
      * @return \Cake\Http\Response|null|void Redirects to index.
      * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
      */
   /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $party = $this->Parties->get($id);
        if ($this->Parties->delete($party)) {
            $this->Flash->success(__('The party has been deleted.'));
        } else {
            $this->Flash->error(__('The party could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
