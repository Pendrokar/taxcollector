<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DebtsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class DebtsTableTest extends TestCase
{
    public $fixtures = ['app.debts'];

    public function setUp()
    {
        parent::setUp();
        $this->Debts = TableRegistry::get('Debts');
    }

    public function testFixture()
    {
        $query = $this->Debts->find();
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        // TODO extract only expected values
        foreach ($result as $key => $value) {
            unset(
                $result[$key]['date']
            );

        }

        $expected = [
            ['id' => 1, 'title' => 'Invoice number 1', 'value' => '1000'],
            ['id' => 2, 'title' => 'Invoice number 2', 'value' => '1500'],
            // , 'date' => '01.01.2018'
            // , 'date' => '01.02.2018'
        ];

        $this->assertEquals($expected, $result);
    }

    // public function tearDown()
    // {
    //     // parent::tearDown();
    //     // Clean up after we're done
    //     // unset($this->component, $this->controller);
    // }
}