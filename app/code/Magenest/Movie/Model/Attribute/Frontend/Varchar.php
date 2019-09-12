<?php
namespace Magenest\Movie\Model\Attribute\Frontend;
class Varchar extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend {
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = preg_replace('/\+ varchar.*/', '', $object->getData($this->getAttribute()->getAttributeCode()));
        return $value;
    }
}