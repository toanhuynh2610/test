<?php
namespace Magenest\Movie\Model\Config\Frontend;
use Magento\Framework\Data\Form\Element\AbstractElement;
class Color extends \Magento\Config\Block\System\Config\Form\Field
{
//    protected function _getElementHtml(AbstractElement $element) {
//
//        $html = "<label>";
//        $html .= "<span>Yes_No_</span>"."<span style='color:red'><b>abcd</b></span>";
//        $html .="</lable>";
//        $html .= $element->getElementHtml();
//        return $html;
//    }
    protected function _getElementHtml(AbstractElement $element) {

        $html = $element->getData('default_html');
        if ($html === null) {
            $html = $element->getNoSpan() === true ? '' : '<div class="admin__field">' . "\n";
            $html .= $element->getLabelHtml()."<span style='color:red'><b>abcd</b></span>";
            $html .= $element->getElementHtml();
            $html .= $element->getNoSpan() === true ? '' : '</div>' . "\n";
        }
        return $html;
    }
//   protected function _getElementHtml(AbstractElement $element) {
//       $element->getLabelHtml();
//        return parent::_getElementHtml($element);
//    }
//    public function getLabelHtml($idSuffix = '', $scopeLabel = '')
//    {
//       $scopeLabel = $scopeLabel ? ' data-config-scope="' . $scopeLabel . '"' : '';
//        if ($this->getLabel() !== null) {
//            $html = '<label class="label admin__field-label" for="' .
//                $this->getHtmlId() . $idSuffix . '"' . $this->_getUiId(
//                  'label'
//                ) . '><span style=\'color:red\'' . $scopeLabel . '>' . $this->_escape(
//                    $this->getLabel()
//                ) . '</span></label>' . "\n";
//        } else {
//            $html = '';
//       }
//        return $html;
//   }
}