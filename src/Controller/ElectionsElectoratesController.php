<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ElectionsElectorates Controller
 *
 * @property \App\Model\Table\ElectionsElectoratesTable $ElectionsElectorates
 * @method \App\Model\Entity\ElectionsElectorate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElectionsElectoratesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Elections', 'Electorates'],
        ];
        $electionsElectorates = $this->paginate($this->ElectionsElectorates);

        $this->set(compact('electionsElectorates'));
    }

    /**
     * View method
     *
     * @param string|null $id Elections Electorate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $electionsElectorate = $this->ElectionsElectorates->get($id, [
            'contain' => ['Elections', 'Electorates', 'Candidates'],
        ]);

        $this->set(compact('electionsElectorate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $electionsElectorate = $this->ElectionsElectorates->newEmptyEntity();
        if ($this->request->is('post')) {
            $electionsElectorate = $this->ElectionsElectorates->patchEntity($electionsElectorate, $this->request->getData());
            if ($this->ElectionsElectorates->save($electionsElectorate)) {
                $this->Flash->success(__('The elections electorate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The elections electorate could not be saved. Please, try again.'));
        }
        $elections = $this->ElectionsElectorates->Elections->find('list', ['limit' => 200])->all();
        $electorates = $this->ElectionsElectorates->Electorates->find('list', ['limit' => 200])->all();
        $candidates = $this->ElectionsElectorates->Candidates->find('list', ['limit' => 200])->all();
        $this->set(compact('electionsElectorate', 'elections', 'electorates', 'candidates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Elections Electorate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $electionsElectorate = $this->ElectionsElectorates->get($id, [
            'contain' => ['Candidates'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $electionsElectorate = $this->ElectionsElectorates->patchEntity($electionsElectorate, $this->request->getData());
            if ($this->ElectionsElectorates->save($electionsElectorate)) {
                $this->Flash->success(__('The elections electorate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The elections electorate could not be saved. Please, try again.'));
        }
        $elections = $this->ElectionsElectorates->Elections->find('list', ['limit' => 200])->all();
        $electorates = $this->ElectionsElectorates->Electorates->find('list', ['limit' => 200])->all();
        $candidates = $this->ElectionsElectorates->Candidates->find('list', ['limit' => 200])->all();
        $this->set(compact('electionsElectorate', 'elections', 'electorates', 'candidates'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Elections Electorate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $electionsElectorate = $this->ElectionsElectorates->get($id);
        if ($this->ElectionsElectorates->delete($electionsElectorate)) {
            $this->Flash->success(__('The elections electorate has been deleted.'));
        } else {
            $this->Flash->error(__('The elections electorate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
