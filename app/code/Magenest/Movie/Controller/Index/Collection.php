<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 14:22
 */
namespace Magenest\Movie\Controller\Index;
class Collection extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $productCollection = $this->_objectManager
            ->create('Magenest\Movie\Model\ResourceModel\Movie\Collection')
           // ->addAttributeToSelect('*')
//          ->addAttributeToFilter('name', array('like' => '%G%'))
            ->setPageSize(10,1);
        $output = '';
        //$output = $productCollection->getSelect()->__toString();
        foreach ($productCollection as $product) {
            $output .= \Zend_Debug::dump($product["name"], null,
                false);
        }
        $this->getResponse()->setBody($output);
    }
}