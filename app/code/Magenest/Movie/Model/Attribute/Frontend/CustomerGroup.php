<?php
namespace Magenest\Movie\Model\Attribute\Frontend;
class CustomerGroup extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend {
    public function getValue(\Magento\Framework\DataObject $object)
    {
        return parent::getValue($object);
    }
}