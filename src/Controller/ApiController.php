<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;

/**
 * API Controller
 *
 */
class ApiController extends AppController
{
	/**
	 * Get Balance method  API URL  /api/balance method: GET
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


	/**
	 * Get Debt Row Balance method  API URL  /api/debtrow method: GET
	 * @return json response
	 * @author Yanis Lukes
	 **/
	public function debtRowBalance(Int $debtRow, String $targetDate = '')
	{
		$balance = 0;
		if ($targetDate)
		{
			$date = \DateTime::createFromFormat('d.m.Y', $targetDate);
		}

		// Retrieve debt row
		$debt = TableRegistry::get('Debts')->get($debtRow);
		$balance = $debt->value;
		if (
			$targetDate
			&& ((int)$date->format('U') < (int)$debt->date->format('U'))
		)
		{
			$this->set('balance', 0);
			$this->set('_serialize', ['balance']);
			return;
		}

		// Collect payments
		$query = TableRegistry::get('Payments')
			->find()
			->where(['debt_id' => $debtRow]);

		if ($targetDate)
		{
			$query = $query->where(['date <=' => $date]);
		}

		$payments = $query->all();

		if ($payments)
		{
			foreach ($payments as $payment)
			{
				$balance -= $payment->value;
			}
		}

		// Absolute
		if ($balance < 0)
		{
			$balance = 0;
		}
		// From cents to unit
		$balance = $balance/100;
		$balance = number_format($balance, 0, '.', ' ');
		$this->set('balance', $balance);
		$this->set('_serialize', ['balance']);
	}
}