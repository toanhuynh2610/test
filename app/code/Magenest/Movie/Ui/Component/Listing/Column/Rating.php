<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

class Rating extends \Magento\Ui\Component\Listing\Columns\Column {

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ){
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                $str= '';
                for($i=1;$i<=$item['rating'];$i++)
                {
                    $str .= "<span class='fa fa-star checked'></span>";
                }
                for($i=1;$i<=(5-$item['rating']);$i++)
                {
                    $str.= "<span class='fa fa-star'></span>";
                }
                $item['rating'] = $str;

                    //Here you can do anything with actual dat


            }
        }


        return $dataSource;
    }
}