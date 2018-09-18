<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * API Controller
 *
 */
class ApiController extends AppController
{
	/**
	 * Get Balance method  API URL  /api/balance method: POST
	 * @return json response
	 * @author Yanis Lukes
	 **/
	public function balance(String $targetDate = '')
	{
		$balance = 0;
		if ($targetDate)
		{
			$date = \DateTime::createFromFormat('d.m.Y', $targetDate);
		}

		// Collect debts
		$query = TableRegistry::get('Debts')
			->find();

		if ($targetDate)
		{
			$query = $query->where(['date <=' => $date]);
		}

		$debts = $query->all();

		if($debts)
		{
			foreach ($debts as $debt)
			{
				$balance -= $debt->value;
			}
		}

		// Collect payments
		$query = TableRegistry::get('Payments')
			->find();

		if ($targetDate)
		{
			$query = $query->where(['date <=' => $date]);
		}

		$payments = $query->all();

		if($payments)
		{
			foreach ($payments as $payment)
			{
				$balance += $payment->value;
			}
		}

		// From cents to unit
		$balance = $balance/100;
		$balance = number_format($balance, 0, '.', ' ');
		$this->set('balance', $balance);
		$this->set('_serialize', ['balance']);
	}
}