<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CandidatesPartiesElections Controller
 *
 * @property \App\Model\Table\CandidatesPartiesElectionsTable $CandidatesPartiesElections
 * @method \App\Model\Entity\CandidatesPartiesElection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatesPartiesElectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Candidates', 'Parties', 'Elections'],
        ];
        $candidatesPartiesElections = $this->paginate($this->CandidatesPartiesElections);

        $this->set(compact('candidatesPartiesElections'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidates Parties Election id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidatesPartiesElection = $this->CandidatesPartiesElections->get($id, [
            'contain' => ['Candidates', 'Parties', 'Elections'],
        ]);

        $this->set(compact('candidatesPartiesElection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidatesPartiesElection = $this->CandidatesPartiesElections->newEmptyEntity();
        if ($this->request->is('post')) {
            $candidatesPartiesElection = $this->CandidatesPartiesElections->patchEntity($candidatesPartiesElection, $this->request->getData());
            if ($this->CandidatesPartiesElections->save($candidatesPartiesElection)) {
                $this->Flash->success(__('The candidates parties election has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidates parties election could not be saved. Please, try again.'));
        }
        $candidates = $this->CandidatesPartiesElections->Candidates->find('list', ['limit' => 200])->all();
        $parties = $this->CandidatesPartiesElections->Parties->find('list', ['limit' => 200])->all();
        $elections = $this->CandidatesPartiesElections->Elections->find('list', ['limit' => 200])->all();
        $this->set(compact('candidatesPartiesElection', 'candidates', 'parties', 'elections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidates Parties Election id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidatesPartiesElection = $this->CandidatesPartiesElections->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidatesPartiesElection = $this->CandidatesPartiesElections->patchEntity($candidatesPartiesElection, $this->request->getData());
            if ($this->CandidatesPartiesElections->save($candidatesPartiesElection)) {
                $this->Flash->success(__('The candidates parties election has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidates parties election could not be saved. Please, try again.'));
        }
        $candidates = $this->CandidatesPartiesElections->Candidates->find('list', ['limit' => 200])->all();
        $parties = $this->CandidatesPartiesElections->Parties->find('list', ['limit' => 200])->all();
        $elections = $this->CandidatesPartiesElections->Elections->find('list', ['limit' => 200])->all();
        $this->set(compact('candidatesPartiesElection', 'candidates', 'parties', 'elections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidates Parties Election id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidatesPartiesElection = $this->CandidatesPartiesElections->get($id);
        if ($this->CandidatesPartiesElections->delete($candidatesPartiesElection)) {
            $this->Flash->success(__('The candidates parties election has been deleted.'));
        } else {
            $this->Flash->error(__('The candidates parties election could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
