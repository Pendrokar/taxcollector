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
     * Init method
     *
     * @return void
     */
    public function init()
    {

        $this->records = [
            [
                'title' => 'Invoice number 1',
                'value' => 100000,
                'date' => '2018-01-01',
            ],
            [
                'title' => 'Invoice number 2',
                'value' => 150000,
                'date' => '2018-02-01',
            ],
            [
                'title' => 'Overpaid invoice',
                'value' => 10000,
                'date' => '2018-03-01',
            ],
        ];
        parent::init();
    }
}
