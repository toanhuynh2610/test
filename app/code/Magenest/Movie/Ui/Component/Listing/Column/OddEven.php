<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

class OddEven extends \Magento\Ui\Component\Listing\Columns\Column {

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
                if($item['entity_id']%2==0)
                {
//                    $this->getData('name') is to get name of column
                    $item[$this->getData('name')] = "<span class='grid-severity-notice'><span>Even</span></span>";
                }
                else
                {
                    $item[$this->getData('name')] = "<span class='grid-severity-critical'><span>Odd</span></span>";
                }
                //Here you can do anything with actual dat


            }
        }


        return $dataSource;
    }
}