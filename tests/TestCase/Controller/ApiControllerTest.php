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
class PagesControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.debts'];

    public function setUp()
    {
        parent::setUp();
        $this->Debts = TableRegistry::get('Debts');
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
        $this->assertResponseContains('"-1 000"');
    }

    //
    // - show total balance on 16.1.2018
    // - show total balance on 16.2.2018
    // - show 1. debt row balance on 14.1.2018
    // - show 1. debt row balance on 16.1.2018
    // - show 2. debt row balance on 1.1.2018
}
