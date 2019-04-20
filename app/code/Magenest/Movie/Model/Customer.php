<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 11:56
 */
namespace Magenest\Movie\Model;
class Customer extends \Magento\Customer\Model\Backend\Customer
{
    public function getAvatarUrl()
    {
        $url = false;
        $avatar = $this->getAvatar();
        if($avatar)
        {
            if(is_string($avatar))
            {
                $url=$this->_storeManager->getStore()->getBaseUrl().'pub/media/movie/avatar/'.$avatar;
            }
            else
            {
                throw new \Magento\Framework\Exception\LocalizedException(__('Something went wrong!!'));

            }

        }
        return $url;
    }
}