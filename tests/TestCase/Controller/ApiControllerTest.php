<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ApiController;
use App\Model\Table\DebtsTable;
use Cake\Core\App;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\View\Exception\MissingTemplateException;

/**
 * ApiControllerTest class
 */
class ApiControllerTest extends IntegrationTestCase
{
	public $fixtures = [
		'app.debts',
		'app.payments'
	];

	public function setUp()
	{
		parent::setUp();
	}
	/**
	 * - show total balance on 14.1.2018, expect "-1 000"
	 *
	 * @return void
	 */
	public function testBalanceBeforePayment()
	{
		$this->get('/api/balance/14.1.2018');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": "-1 000"');
	}

	/**
	 * - show total balance on 16.1.2018, expect "0"
	 *
	 * @return void
	 */
	public function testBalanceAfterFirstPayment()
	{
		$this->get('/api/balance/16.1.2018');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": "0"');
	}

	/**
	 * - show total balance on 16.2.2018, expect "0"
	 *
	 * @return void
	 */
	public function testBalanceAfterSecondPayment()
	{
		$this->get('/api/balance/16.2.2018');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": "0"');
	}

	/**
	 * - show 1. debt row balance on 14.1.2018, expect "1 000"
	 *
	 * @return void
	 */
	public function testFirstDebtBalanceBeforePayment()
	{
		$this->get('/api/balance/row/1/14.1.2018');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": "1 000"');
	}

	/**
	 * - show 1. debt row balance on 16.1.2018, expect "0"
	 *
	 * @return void
	 */
	public function testFirstDebtBalanceAfterPayment()
	{
		$this->get('/api/balance/row/1/16.1.2018');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": "0"');
	}

	/**
	 * - show 2. debt row balance on 1.1.2018, expect 0???
	 *
	 * @return void
	 */
	public function testSecondDebtBalanceBeforePayment()
	{
		$this->get('/api/balance/row/2/1.1.2018');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": 0');
	}

	/**
	 * - show 3. debt row overpaid balance, expect "0"
	 *
	 * @return void
	 */
	public function testOverpaid()
	{
		$this->get('/api/balance/row/3');
		$this->assertResponseOk();
		$this->assertResponseContains('"balance": "0"');
	}
}
