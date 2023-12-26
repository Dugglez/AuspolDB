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

        $elections = $this->paginate($this->Elections->find('all', ['conditions' => $conditions]), ['limit' => 200]);

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

        // Fetch Electorates with the necessary filtering
        $electorates = $this->fetchTable('Electorates')
            ->find('all', [
                'conditions' => [
                    'name LIKE' => '%' . $searchQuery . '%',
                ],
                'order' => ['name' => 'ASC'], // Order by name in ascending order
            ]);




        // Add the filtered Electorates to the $election object
        $election->electorates = $electorates;

        $candidates = $this->fetchTable('Candidates');
        $electorates = $this->fetchTable('Electorates');
        $parties = $this->fetchTable('Parties');

        $this->set(compact('election', 'parties', 'candidates', 'electorates', 'searchQuery'));
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
