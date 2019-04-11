<?php

namespace Magenest\Movie\Model\Config\Backend;
use \Magento\Framework\App\Config\ScopeConfigInterface;
class Textfield extends \Magento\Framework\App\Config\Value
{

    public function beforeSave()
    {
        $text = $this->getValue();
        $this->_eventManager->dispatch(
            'change_ping_to_pong',
            ['text'=>$text]
        );

        parent::beforeSave();
    }
}