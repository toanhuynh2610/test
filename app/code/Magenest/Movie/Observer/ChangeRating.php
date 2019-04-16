<?php
namespace Magenest\Movie\Observer;
use Magento\Framework\Event\ObserverInterface;
class ChangeRating implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getMovie()->setRating(0)->save();

    }
}