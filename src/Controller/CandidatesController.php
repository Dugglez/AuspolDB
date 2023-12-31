<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Candidates Controller
 *
 * @property \App\Model\Table\CandidatesTable $Candidates
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


        $query = $this->Candidates->find('all', [
            // other conditions or contain statements if needed
        ]);

        $searchString = $this->request->getQuery('search');

        if ($searchString !== null) {
            $query->where(['name LIKE' => '%' . $searchString . '%']);
        }

        $query->order(['SUBSTRING_INDEX(name, " ", -1)' => 'ASC']);

        $candidates = $this->paginate($query, ['limit' => 200]);




        $this->set(compact('candidates'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => ['ElectionsElectorates', 'ElectionsStates', 'CandidatesPartiesElections'],
        ]);



        $lowerHouseContests = $this->fetchTable('CandidatesElectionsElectorates')->find('all', [
            'conditions' => ['CandidatesElectionsElectorates.candidate_id' => $id],
        ])->toArray();

        $upperHouseContests = $this->fetchTable('CandidatesElectionsStates')->find('all', [
            'conditions' => ['CandidatesElectionsStates.candidate_id' => $id],
        ])->toArray();

        $elections = $this->fetchTable('Elections');
        $electorates = $this->fetchTable('Electorates');
        $parties = $this->fetchTable('Parties');

        $this->set(compact('candidate','lowerHouseContests', 'upperHouseContests','elections', 'electorates', 'parties'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
   /* public function add()
    {
        $candidate = $this->Candidates->newEmptyEntity();
        if ($this->request->is('post')) {
            $candidate = $this->Candidates->patchEntity($candidate, $this->request->getData());
            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('The candidate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidate could not be saved. Please, try again.'));
        }
        $electionsElectorates = $this->Candidates->ElectionsElectorates->find('list', ['limit' => 200])->all();
        $electionsStates = $this->Candidates->ElectionsStates->find('list', ['limit' => 200])->all();
        $this->set(compact('candidate', 'electionsElectorates', 'electionsStates'));
    }*/

    /**
     * Edit method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* public function edit($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => ['ElectionsElectorates', 'ElectionsStates'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidate = $this->Candidates->patchEntity($candidate, $this->request->getData());
            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('The candidate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidate could not be saved. Please, try again.'));
        }
        $electionsElectorates = $this->Candidates->ElectionsElectorates->find('list', ['limit' => 200])->all();
        $electionsStates = $this->Candidates->ElectionsStates->find('list', ['limit' => 200])->all();
        $this->set(compact('candidate', 'electionsElectorates', 'electionsStates'));
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /*  public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidate = $this->Candidates->get($id);
        if ($this->Candidates->delete($candidate)) {
            $this->Flash->success(__('The candidate has been deleted.'));
        } else {
            $this->Flash->error(__('The candidate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
