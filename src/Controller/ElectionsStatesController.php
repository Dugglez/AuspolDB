<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ElectionsStates Controller
 *
 * @property \App\Model\Table\ElectionsStatesTable $ElectionsStates
 * @method \App\Model\Entity\ElectionsState[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElectionsStatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $electionsStates = $this->paginate($this->ElectionsStates);

        $this->set(compact('electionsStates'));
    }

    /**
     * View method
     *
     * @param string|null $id Elections State id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $electionsState = $this->ElectionsStates->get($id, [
            'contain' => ['Candidates'],
        ]);

        $this->set(compact('electionsState'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $electionsState = $this->ElectionsStates->newEmptyEntity();
        if ($this->request->is('post')) {
            $electionsState = $this->ElectionsStates->patchEntity($electionsState, $this->request->getData());
            if ($this->ElectionsStates->save($electionsState)) {
                $this->Flash->success(__('The elections state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The elections state could not be saved. Please, try again.'));
        }
        $candidates = $this->ElectionsStates->Candidates->find('list', ['limit' => 200])->all();
        $this->set(compact('electionsState', 'candidates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Elections State id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $electionsState = $this->ElectionsStates->get($id, [
            'contain' => ['Candidates'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $electionsState = $this->ElectionsStates->patchEntity($electionsState, $this->request->getData());
            if ($this->ElectionsStates->save($electionsState)) {
                $this->Flash->success(__('The elections state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The elections state could not be saved. Please, try again.'));
        }
        $candidates = $this->ElectionsStates->Candidates->find('list', ['limit' => 200])->all();
        $this->set(compact('electionsState', 'candidates'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Elections State id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $electionsState = $this->ElectionsStates->get($id);
        if ($this->ElectionsStates->delete($electionsState)) {
            $this->Flash->success(__('The elections state has been deleted.'));
        } else {
            $this->Flash->error(__('The elections state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
