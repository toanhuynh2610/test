<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 11:26
 */
namespace Magenest\Movie\Model\ResourceModel;
class Rule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct() {
        $this->_init('magenest_rules',
            'id');
    }
}
