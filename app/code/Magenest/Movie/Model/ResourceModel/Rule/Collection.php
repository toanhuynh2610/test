<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 13:11
 */
namespace Magenest\Movie\Model\ResourceModel\Rule;
/**
 * Subscription Collection
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Rule',
            'Magenest\Movie\Model\ResourceModel\Rule');
    }

    protected function _initSelect()
    {
        $this->addFieldToFilter('status', ['eq' => 'pending']);
        return parent::_initSelect();
    }
}