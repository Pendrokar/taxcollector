<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Debts Controller
 *
 * @property \App\Model\Table\DebtsTable $Debts
 *
 * @method \App\Model\Entity\Debt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DebtsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $debts = $this->paginate($this->Debts);

        $this->set(compact('debts'));
    }

    /**
     * View method
     *
     * @param string|null $id Debt id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $debt = $this->Debts->get($id, [
            'contain' => []
        ]);

        $this->set('debt', $debt);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $debt = $this->Debts->newEntity();
        if ($this->request->is('post')) {
            $debt = $this->Debts->patchEntity($debt, $this->request->getData());
            if ($this->Debts->save($debt)) {
                $this->Flash->success(__('The debt has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The debt could not be saved. Please, try again.'));
        }
        $this->set(compact('debt'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Debt id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $debt = $this->Debts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $debt = $this->Debts->patchEntity($debt, $this->request->getData());
            if ($this->Debts->save($debt)) {
                $this->Flash->success(__('The debt has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The debt could not be saved. Please, try again.'));
        }
        $this->set(compact('debt'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Debt id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $debt = $this->Debts->get($id);
        if ($this->Debts->delete($debt)) {
            $this->Flash->success(__('The debt has been deleted.'));
        } else {
            $this->Flash->error(__('The debt could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
