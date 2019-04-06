<?php
namespace Magenest\Movie\Model\Config\Frontend;
use Magento\Framework\Data\Form\Element\AbstractElement;
class Disable extends \Magento\Config\Block\System\Config\Form\Field{
    protected function _getElementHtml(AbstractElement $element) {
            $element->setDisabled('disabled');
        return parent::_getElementHtml($element);
    }
}