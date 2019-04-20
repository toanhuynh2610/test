<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 19/03/2019
 * Time: 16:35
 */

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Helper\Session\CurrentCustomer;

class AvatarCustomer extends Template
{
    protected $_currentCustomer;
    public  function __construct(CurrentCustomer $currentCustomer, Template\Context $context,array $data = [])
    {
       $this->_currentCustomer = $currentCustomer;
        parent::__construct($context, $data);
    }

    public function getImage(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /*** @var \Magento\Customer\Model\Customer $customer ***/
        $customer = $objectManager->get('Magento\Customer\Model\Customer')->load($this->_currentCustomer->getCustomerId());
        $customerData = $customer->getData();
        if(isset($customerData['avatar'])){
            $store = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
            $result = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'movie/avatar/' . $customerData['avatar'];
            return $result;
        }
//        else{
//            $result = '';
//        }

    }
}