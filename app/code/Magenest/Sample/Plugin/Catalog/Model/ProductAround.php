<?php

namespace Magenest\Sample\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;

class ProductAround
{
    public function afterGetName(Product $subject, $result)
    {
        return $result. ' modified by After Plugin';

    }
}