<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Electorates Controller
 *
 * @property \App\Model\Table\ElectoratesTable $Electorates
 * @method \App\Model\Entity\Electorate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElectoratesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $searchString = $this->request->getQuery('search');

        $query = $this->Electorates->find();

        // If search string is not null, add a condition
        if ($searchString !== null) {
            $query->where(['name LIKE' => '%' . $searchString . '%']);
        }

        // Paginate the results
        $electorates = $this->paginate($query, ['limit' => 200]);

        $this->set(compact('electorates'));
    }

    /**
     * View method
     *
     * @param string|null $id Electorate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contestId = $this->request->getQuery('contest');


        $electorate = $this->Electorates->get($id, [
            'contain' => ['Elections', 'CandidatesElectionsElectorates'],
        ]);

        $elections_electorates = $this->fetchTable('ElectionsElectorates')
            ->find()
            ->where(['electorate_id' => $id])
            ->toArray();

        $candidates = $this->fetchTable('Candidates');
        $electionslist = $this->fetchTable('Elections');
        $parties = $this->fetchTable('Parties');

        // Initialize the $winners array
        $winners = [];

        // Populate $winners with election IDs as keys and winner IDs as values
        foreach ($elections_electorates as $election_electorate) {
            if ($election_electorate->winning_candidate !== null) {
                $winners[$election_electorate->election_id] = $election_electorate->winning_candidate;
            }
            else {
                $winners[$election_electorate->election_id] = "Multiple Members, see results";
            }
        }

        // Reorder $winners by descending election date
        $sortedWinners = [];

        // Iterate through $winners and fetch election dates
        foreach ($winners as $electionId => $winnerId) {
            // Fetch the election data using the election ID
            $election = $electionslist->get($electionId);
            
            // Populate the $sortedWinners array with the election date as the key
            $sortedWinners[] = [
                'election_id' => $electionId,
                'winner_id' => $winnerId,
                'election_date' => $election->date
            ];
        }

        // Sort the array by election date in descending order
        usort($sortedWinners, function ($a, $b) {
            return $b['election_date']->gt($a['election_date']) ? 1 : -1;
        });


        // Rebuild the $winners array with the sorted data
        $winners = [];
        foreach ($sortedWinners as $entry) {
            $winners[$entry['election_id']] = $entry['winner_id'];
        }


        $this->set(compact('electorate','candidates','electionslist','parties','elections_electorates','winners','contestId'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    /*public function add()
    {
        $electorate = $this->Electorates->newEmptyEntity();
        if ($this->request->is('post')) {
            $electorate = $this->Electorates->patchEntity($electorate, $this->request->getData());
            if ($this->Electorates->save($electorate)) {
                $this->Flash->success(__('The electorate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The electorate could not be saved. Please, try again.'));
        }
        $elections = $this->Electorates->Elections->find('list', ['limit' => 200])->all();
        $this->set(compact('electorate', 'elections'));
    }*/

    /**
     * Edit method
     *
     * @param string|null $id Electorate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* public function edit($id = null)
    {
        $electorate = $this->Electorates->get($id, [
            'contain' => ['Elections'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $electorate = $this->Electorates->patchEntity($electorate, $this->request->getData());
            if ($this->Electorates->save($electorate)) {
                $this->Flash->success(__('The electorate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The electorate could not be saved. Please, try again.'));
        }
        $elections = $this->Electorates->Elections->find('list', ['limit' => 200])->all();
        $this->set(compact('electorate', 'elections'));
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Electorate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $electorate = $this->Electorates->get($id);
        if ($this->Electorates->delete($electorate)) {
            $this->Flash->success(__('The electorate has been deleted.'));
        } else {
            $this->Flash->error(__('The electorate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
