<?php
namespace Magenest\Movie\Block\System\Config;
class Button extends \Magento\Config\Block\System\Config\Form\Field
{
<<<<<<< HEAD
=======


>>>>>>> 42eb8115f477a184a19a3c230f15d7e1ff27e6cf
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
