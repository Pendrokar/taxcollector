<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DebtsFixture
 *
 */
class DebtsFixture extends TestFixture
{

    public $import = ['model' => 'Debts'];
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    // public $fields = [
    //     'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
    //     'title' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
    //     'value' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
    //     'date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
    //     '_constraints' => [
    //         'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
    //     ],
    //     '_options' => [
    //         'engine' => 'InnoDB',
    //         'collation' => 'latin1_swedish_ci'
    //     ],
    // ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {

        $this->records = [
            [
                'title' => 'Invoice number 1',
                'value' => 1000,
                'date' => '2018-01-01',
                // 'created' => '2018-01-01 10:39:23',
                // 'modified' => '2018-01-01 10:41:31'
            ],
            [
                'title' => 'Invoice number 2',
                'value' => 1500,
                'date' => '2018-02-01',
                // 'created' => '2018-02-01 10:39:23',
                // 'modified' => '2018-02-01 10:41:31'
            ],
        ];
        parent::init();
    }
}
