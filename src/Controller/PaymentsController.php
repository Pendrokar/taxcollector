<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Debts']
        ];
        $payments = $this->paginate($this->Payments);

        $this->set(compact('payments'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Debts']
        ]);

        $this->set('payment', $payment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $debts = $this->Payments->Debts->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'debts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $debts = $this->Payments->Debts->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'debts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Get Balance method  API URL  /api/balance method: GET
     * @return json response
     */
    public function frontend()
    {
        // TODO: get GET the CakePHP way
        $start = (int)$_GET['start'];
        $length = (int)$_GET['length'];
        $sort = (int)$_GET['order'][0]['column'];
        $dir = (string)$_GET['order'][0]['dir'];
        switch ($sort) {
            case 1:
                $order = ['value' => $dir];
                break;
            case 2:
                $order = ['date' => $dir];
                break;
            default:
                $order = ['id' => 'ASC'];
                break;
        }

        $query = $this
            ->Payments
            ->find();
        $recordsTotal = $query->select(['count' => $query->func()->count('*')])
            ->first();
        // TODO: Merge into one call
        $payments = $this
            ->Payments
            ->find()
            ->offset($start)
            ->limit($length)
            ->all();

        $formattedPayments = [];
        foreach ($payments as $payment) {
            $formattedPayments[] = [
                'id' => $payment->id,
                'value' => $payment->formattedValue,
                'date' => $payment->formattedDate
            ];
        }

        $this->set('recordsFiltered', $recordsTotal['count']);
        $this->set('recordsTotal', $recordsTotal['count']);
        $this->set('data', $formattedPayments);
        $this->set('_serialize', ['data', 'recordsFiltered', 'recordsTotal']);
    }
}
