<?php
namespace Magenest\Movie\Observer;
use Magento\Framework\Event\ObserverInterface;
class ChangeFirstName implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getCustomer()->setFirstName('Magenest');

    }
}