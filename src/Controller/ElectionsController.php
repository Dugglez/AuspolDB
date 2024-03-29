<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Elections Controller
 *
 * @property \App\Model\Table\ElectionsTable $Elections
 * @method \App\Model\Entity\Election[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $conditions = [];
        $jurisdiction = $this->request->getQuery('jurisdiction');

        if ($jurisdiction) {
            $conditions['jurisdiction'] = $jurisdiction;
        }

        $elections = $this->paginate(
            $this->Elections->find('all', [
                'conditions' => $conditions,
                'order' => ['date' => 'DESC'], // Order by date in descending order
            ]),
            ['limit' => 200]
        );


        $parties = $this->fetchTable('Parties');

        $this->set(compact('elections', 'parties'));
    }


    /**
     * View method
     *
     * @param string|null $id Election id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $searchQuery = $this->request->getQuery('search');

        $options = [
            'contain' => ['Electorates', 'CandidatesElectionsElectorates', 'CandidatesElectionsStates', 'CandidatesPartiesElections'],
        ];

        $election = $this->Elections->get($id, $options);

        $electionType = 'Reps';

// Fetch Electorates with the necessary filtering
        $electorateIds = $this->fetchTable('ElectionsElectorates')
            ->find('list', [
                'conditions' => [
                    'election_id' => $id,
                ],
                'valueField' => 'electorate_id',
            ])->toArray();
        $electorates = null;
        if($electorateIds){
        $electorates = $this->fetchTable('Electorates')
            ->find('all', [
                'conditions' => [
                    'id IN' => $electorateIds,
                    'name LIKE' => '%' . $searchQuery . '%',
                ],
                'order' => ['name' => 'ASC'], // Order by name in ascending order
            ]);
            }

        if (isset($electorates) and count($electorates->toArray()) > 0 ) {
            // If there are rows, set $electorates to the result
            $election->electorates = $electorates;
        } else {
            // If no rows, set $electorates to an empty array
            $electionType = 'Senate';
        }



        $senateQueryString = $this->request->getQuery('senate');

        $queryConditions = ['CandidatesElectionsStates.election_id' => $id];
        $composition = '';
        if ($senateQueryString !== null) {
            $queryConditions['CandidatesElectionsStates.state'] = $senateQueryString;
            $electionsStatesTable = $this->fetchTable('ElectionsStates');

            $query = $electionsStatesTable->find()
                ->select(['composition'])
                ->where([
                    'election_id' => $id,
                    'state' => $senateQueryString
                ]);

            $composition = $query->first()->composition;
        }

        $upperHouseContests = $this->fetchTable('CandidatesElectionsStates')->find('all', [
            'conditions' => $queryConditions,
            'limit' => ($senateQueryString === null) ? 200 : null,
        ])->toArray();

        $candidatesElectionsStatesTable = $this->fetchTable('CandidatesElectionsStates');

        // Get unique jurisdictions for the given election_id
        $query = $candidatesElectionsStatesTable->find()
            ->select(['state'])
            ->distinct(['state'])
            ->where(['election_id' => $id]);

        // Execute the query and convert the result to an array
        $jurisdictions = $query->toArray();

        // Pass the $jurisdictions to the view
        $this->set('jurisdictions', $jurisdictions);


        $electionElectoratesTable = $this->fetchTable('ElectionsElectorates');
        $candidatesElectionsElectoratesTable = $this->fetchTable('CandidatesElectionsElectorates');

// Step 1
        $partyCounts = $electionElectoratesTable
            ->find()
            ->select(['winning_party'])
            ->where([
                'election_id' => $id,
                'winning_party IS NOT NULL'
            ])
            ->toArray();

// Step 2
        $nullWinningPartyEntries = $electionElectoratesTable
            ->find()
            ->select(['electorate_id'])
            ->where([
                'election_id' => $id,
                'winning_party IS NULL'
            ])
            ->toArray();

// Step 3 and Step 4
        $houseComposition = [];

        foreach ($nullWinningPartyEntries as $entry) {
            $electorateId = $entry->electorate_id;

            $winnerPartyIds = $candidatesElectionsElectoratesTable
                ->find()
                ->select(['party_id'])
                ->where([
                    'election_id' => $id,
                    'electorate_id' => $electorateId,
                    'winner' => 1
                ])
                ->toArray();

            foreach ($winnerPartyIds as $winnerPartyId) {
                $partyId = $winnerPartyId->party_id;

                if (isset($houseComposition[$partyId])) {
                    $houseComposition[$partyId]++;
                } else {
                    $houseComposition[$partyId] = 1;
                }
            }
        }

// Incorporate results from Step 1
        foreach ($partyCounts as $result) {
            $winningParty = $result->winning_party;

            if (isset($houseComposition[$winningParty])) {
                $houseComposition[$winningParty]++;
            } else {
                $houseComposition[$winningParty] = 1;
            }
        }

// $houseComposition now contains the counts of each party in the house





        $candidates = $this->fetchTable('Candidates');
        $electorates = $this->fetchTable('Electorates');
        $parties = $this->fetchTable('Parties');

        $this->set(compact('election', 'parties', 'candidates', 'electorates', 'searchQuery',
            'upperHouseContests','electorateIds','electionType','senateQueryString','composition', 'houseComposition'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
   /* public function add()
    {
        $election = $this->Elections->newEmptyEntity();
        if ($this->request->is('post')) {
            $election = $this->Elections->patchEntity($election, $this->request->getData());
            if ($this->Elections->save($election)) {
                $this->Flash->success(__('The election has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The election could not be saved. Please, try again.'));
        }
        $electorates = $this->Elections->Electorates->find('list', ['limit' => 200])->all();
        $this->set(compact('election', 'electorates'));
    }*/

    /**
     * Edit method
     *
     * @param string|null $id Election id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /* public function edit($id = null)
    {
        $election = $this->Elections->get($id, [
            'contain' => ['Electorates'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $election = $this->Elections->patchEntity($election, $this->request->getData());
            if ($this->Elections->save($election)) {
                $this->Flash->success(__('The election has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The election could not be saved. Please, try again.'));
        }
        $electorates = $this->Elections->Electorates->find('list', ['limit' => 200])->all();
        $this->set(compact('election', 'electorates'));
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Election id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $election = $this->Elections->get($id);
        if ($this->Elections->delete($election)) {
            $this->Flash->success(__('The election has been deleted.'));
        } else {
            $this->Flash->error(__('The election could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
