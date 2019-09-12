<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 14:22
 */
namespace Magenest\Movie\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magenest\Movie\Model\ResourceModel\Rule\CollectionFactory;
class Collection extends \Magento\Framework\App\Action\Action {
    private $ruleFactory;
    public function __construct(Context $context,CollectionFactory $ruleFactory)
    {
        $this->ruleFactory = $ruleFactory;
        parent::__construct($context);
    }

    public function execute() {

//        $productCollection = $this->_objectManager
//            ->create('Magento\Customer\Model\ResourceModel\Customer\Collection')
//            ->addAttributeToSelect('*')
////          ->addAttributeToFilter('entity_id', 2)
//            ->setPageSize(10,1);
               $output = '';
////        $output = $productCollection->count('*');
        $productCollection = $this->ruleFactory->create()->getItems();
        foreach ($productCollection as $product) {
            $output .= \Zend_Debug::dump($product->debug(), null,
                false);
        }

        $this->getResponse()->setBody($output);
    }
}