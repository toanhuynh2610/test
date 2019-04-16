<?php
namespace Magenest\Movie\Block\System\Config;
class Button extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $this->setElement($element);
        $url = $this->getUrl('admin/system_config/edit/section/movie/'); //

        $html = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setType('button')
            ->setClass('scalable')
            ->setLabel('Reload !')
            ->setOnClick("setLocation('$url')")
            ->toHtml();
        return $html;

    }

}
