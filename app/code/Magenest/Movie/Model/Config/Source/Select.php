<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 29/03/2019
 * Time: 13:26
 */

namespace Magenest\Movie\Model\Config\Source;
class Select implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [

            [
                'value' => '1',
                'label' => __('show')
            ],
            [
                'value' => '2',
                'label' => __('not show')
            ],
        ];
    }
}