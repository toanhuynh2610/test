<?php
namespace Magenest\Movie\Observer;
use Magento\Framework\Event\ObserverInterface;
class ChangePingToPong implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        if($observer->getText()->getValue()== 'ping'){
            $observer->getText()->setValue('pong');
        }
    }
}