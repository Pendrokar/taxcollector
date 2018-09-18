<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * Debt Entity
 *
 * @property int $id
 * @property string $title
 * @property int $value
 * @property \Cake\I18n\FrozenDate $date
 */
class Debt extends Entity
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
        'title' => true,
        'value' => true,
        'date' => true
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
