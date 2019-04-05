<?php

/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 13:11
 */

namespace Magenest\Movie\Model\ResourceModel\MoAC;
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
        $this->_init('Magenest\Movie\Model\MoAc',
            'Magenest\Movie\Model\ResourceModel\MoAc');
    }
}