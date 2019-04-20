<?php
namespace Magenest\Movie\Plugin\Avatar;

class AvatarCustomer {

    protected  $loadedData;


    public function aftergetData (\Magento\Customer\Model\Customer\DataProvider $subject, $result)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        if($result!= null){
            foreach ($result as $key=>$value){
                $customer_data = $value;
            }
            $customerId = isset($customer_data['customer']['entity_id']) ? $customer_data['customer']['entity_id'] : null;
            $customerObj = $objectManager->create('\Magento\Customer\Model\Customer')->load($customerId);
            $customerData = $customerObj->getData();
            if (isset($customerData['avatar'])){
                unset($result[$customerId]['customer']['avatar']);
                $result[$customerId]['customer']['avatar'][0]['name'] = $customerData['avatar'];
                $result[$customerId]['customer']['avatar'][0]['url'] = $customerObj->getAvatarUrl();
            }
            return $result;
        }

    }
}