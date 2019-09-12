<?php
namespace Magenest\Movie\Model\Attribute\Backend;

class Varchar extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend{
    /**
     * Before save method
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeSave($object)
    {
        if(!preg_match ('/\+ varchar.*/', $object->getData($this->getAttribute()->getAttributeCode()), $matches)){
            $object->setData($this->getAttribute()->getAttributeCode(), $object->getData($this->getAttribute()->getAttributeCode()).'+ varchar('.strlen($object->getData($this->getAttribute()->getAttributeCode())).')');
        }
        return parent::beforeSave($object);
    }
    public function afterLoad($object)
    {
        $object->setData($this->getAttribute()->getAttributeCode(),preg_replace('/\+ varchar.*/', '', $object->getData($this->getAttribute()->getAttributeCode())));
        return parent::afterLoad($object);
    }
}