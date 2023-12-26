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


        $this->set(compact('party','candidates','electorates','elections'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
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
    }

    /**
     * Edit method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
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
    }

    /**
     * Delete method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $party = $this->Parties->get($id);
        if ($this->Parties->delete($party)) {
            $this->Flash->success(__('The party has been deleted.'));
        } else {
            $this->Flash->error(__('The party could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
