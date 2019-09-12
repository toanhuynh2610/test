<?php

namespace Magenest\Sample\Model;

class Product extends \Magento\Catalog\Model\Product
{
    public function getName()
    {
        $changeNamebyPreference = $this->getData('name').' modified by Preference';
        return $changeNamebyPreference;
    }
}