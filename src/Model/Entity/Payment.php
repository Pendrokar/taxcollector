<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property int $value
 * @property int $debt_id
 *
 * @property \App\Model\Entity\Debt $debt
 */
class Payment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'date' => true,
        'value' => true,
        'debt_id' => true,
        'debt' => true
    ];

    protected function _getFormattedValue()
    {
        return number_format($this->_properties['value']/100, 2, '.', ' ');
    }

    protected function _getFormattedDate()
    {
        return $this->_properties['date']->format('d.m.Y');
    }
}
