<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 *
 */
class PaymentsFixture extends TestFixture
{

    public $import = ['model' => 'Payments'];

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'date' => '2018-01-15',
                'value' => 100000,
                'debt_id' => 1
            ],
            [
                'id' => 2,
                'date' => '2018-02-15',
                'value' => 150000,
                'debt_id' => 2
            ],
            [
                'id' => 3,
                'date' => '2018-03-02',
                'value' => 50000,
                'debt_id' => 3
            ],
        ];
        parent::init();
    }
}
