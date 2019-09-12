<?php

namespace Magenest\Sample2\Model;

class Product extends \Magento\Catalog\Model\Product
{
    public function getName()
    {
        $changeNamebyPreference = $this->getData('name').' modified by Preference 2';
        return $changeNamebyPreference;
    }
}