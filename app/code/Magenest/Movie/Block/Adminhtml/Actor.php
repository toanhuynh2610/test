<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 26/03/2019
 * Time: 15:25
 */
namespace Magenest\Movie\Block\Adminhtml;
class Actor extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_actor';
        parent::_construct();
    }

}