<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 11:56
 */
namespace Magenest\Movie\Model;
class Rule extends \Magento\Framework\Model\AbstractModel {
    const STATUS_PENDING =  'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';

    public function _construct() {
        $this->_init
        ('Magenest\Movie\Model\ResourceModel\Rule');
    }
}