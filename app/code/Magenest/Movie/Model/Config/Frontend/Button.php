<?php
namespace Magenest\Movie\Model\Config\Frontend;
use Magento\Framework\Data\Form\Element\AbstractElement;
class Button extends \Magento\Config\Block\System\Config\Form\Field{

    protected function _getElementHtml(AbstractElement $element) {
        $element->setReadonly('true');
        return parent::_getElementHtml($element);
    }
}