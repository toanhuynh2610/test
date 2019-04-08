<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 13:11
 */
namespace Magenest\Movie\Model\ResourceModel\Movie;
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
        $this->_init('Magenest\Movie\Model\Movie',
            'Magenest\Movie\Model\ResourceModel\Movie');
    }
}
