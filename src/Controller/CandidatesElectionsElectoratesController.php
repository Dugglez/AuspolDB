<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CandidatesElectionsElectorates Controller
 *
 * @property \App\Model\Table\CandidatesElectionsElectoratesTable $CandidatesElectionsElectorates
 * @method \App\Model\Entity\CandidatesElectionsElectorate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatesElectionsElectoratesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Candidates', 'Elections', 'Electorates', 'Parties'],
        ];
        $candidatesElectionsElectorates = $this->paginate($this->CandidatesElectionsElectorates);

        $this->set(compact('candidatesElectionsElectorates'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidates Elections Electorate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidatesElectionsElectorate = $this->CandidatesElectionsElectorates->get($id, [
            'contain' => ['Candidates', 'Elections', 'Electorates', 'Parties'],
        ]);

        $this->set(compact('candidatesElectionsElectorate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidatesElectionsElectorate = $this->CandidatesElectionsElectorates->newEmptyEntity();
        if ($this->request->is('post')) {
            $candidatesElectionsElectorate = $this->CandidatesElectionsElectorates->patchEntity($candidatesElectionsElectorate, $this->request->getData());
            if ($this->CandidatesElectionsElectorates->save($candidatesElectionsElectorate)) {
                $this->Flash->success(__('The candidates elections electorate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidates elections electorate could not be saved. Please, try again.'));
        }
        $candidates = $this->CandidatesElectionsElectorates->Candidates->find('list', ['limit' => 200])->all();
        $elections = $this->CandidatesElectionsElectorates->Elections->find('list', ['limit' => 200])->all();
        $electorates = $this->CandidatesElectionsElectorates->Electorates->find('list', ['limit' => 200])->all();
        $parties = $this->CandidatesElectionsElectorates->Parties->find('list', ['limit' => 200])->all();
        $this->set(compact('candidatesElectionsElectorate', 'candidates', 'elections', 'electorates', 'parties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidates Elections Electorate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidatesElectionsElectorate = $this->CandidatesElectionsElectorates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidatesElectionsElectorate = $this->CandidatesElectionsElectorates->patchEntity($candidatesElectionsElectorate, $this->request->getData());
            if ($this->CandidatesElectionsElectorates->save($candidatesElectionsElectorate)) {
                $this->Flash->success(__('The candidates elections electorate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidates elections electorate could not be saved. Please, try again.'));
        }
        $candidates = $this->CandidatesElectionsElectorates->Candidates->find('list', ['limit' => 200])->all();
        $elections = $this->CandidatesElectionsElectorates->Elections->find('list', ['limit' => 200])->all();
        $electorates = $this->CandidatesElectionsElectorates->Electorates->find('list', ['limit' => 200])->all();
        $parties = $this->CandidatesElectionsElectorates->Parties->find('list', ['limit' => 200])->all();
        $this->set(compact('candidatesElectionsElectorate', 'candidates', 'elections', 'electorates', 'parties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidates Elections Electorate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidatesElectionsElectorate = $this->CandidatesElectionsElectorates->get($id);
        if ($this->CandidatesElectionsElectorates->delete($candidatesElectionsElectorate)) {
            $this->Flash->success(__('The candidates elections electorate has been deleted.'));
        } else {
            $this->Flash->error(__('The candidates elections electorate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
