<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CandidatesElectionsStates Controller
 *
 * @property \App\Model\Table\CandidatesElectionsStatesTable $CandidatesElectionsStates
 * @method \App\Model\Entity\CandidatesElectionsState[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatesElectionsStatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Candidates', 'Elections'],
        ];
        $candidatesElectionsStates = $this->paginate($this->CandidatesElectionsStates);

        $this->set(compact('candidatesElectionsStates'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidates Elections State id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidatesElectionsState = $this->CandidatesElectionsStates->get($id, [
            'contain' => ['Candidates', 'Elections'],
        ]);

        $this->set(compact('candidatesElectionsState'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidatesElectionsState = $this->CandidatesElectionsStates->newEmptyEntity();
        if ($this->request->is('post')) {
            $candidatesElectionsState = $this->CandidatesElectionsStates->patchEntity($candidatesElectionsState, $this->request->getData());
            if ($this->CandidatesElectionsStates->save($candidatesElectionsState)) {
                $this->Flash->success(__('The candidates elections state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidates elections state could not be saved. Please, try again.'));
        }
        $candidates = $this->CandidatesElectionsStates->Candidates->find('list', ['limit' => 200])->all();
        $elections = $this->CandidatesElectionsStates->Elections->find('list', ['limit' => 200])->all();
        $this->set(compact('candidatesElectionsState', 'candidates', 'elections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidates Elections State id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidatesElectionsState = $this->CandidatesElectionsStates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidatesElectionsState = $this->CandidatesElectionsStates->patchEntity($candidatesElectionsState, $this->request->getData());
            if ($this->CandidatesElectionsStates->save($candidatesElectionsState)) {
                $this->Flash->success(__('The candidates elections state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidates elections state could not be saved. Please, try again.'));
        }
        $candidates = $this->CandidatesElectionsStates->Candidates->find('list', ['limit' => 200])->all();
        $elections = $this->CandidatesElectionsStates->Elections->find('list', ['limit' => 200])->all();
        $this->set(compact('candidatesElectionsState', 'candidates', 'elections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidates Elections State id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidatesElectionsState = $this->CandidatesElectionsStates->get($id);
        if ($this->CandidatesElectionsStates->delete($candidatesElectionsState)) {
            $this->Flash->success(__('The candidates elections state has been deleted.'));
        } else {
            $this->Flash->error(__('The candidates elections state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
