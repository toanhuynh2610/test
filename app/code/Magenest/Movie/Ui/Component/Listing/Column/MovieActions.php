<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
class MovieActions extends \Magento\Ui\Component\Listing\Columns\Column {

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ){
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl('movie/movie/newaction', ['id' => $item['movie_id']]),
                    'label' => __('Edit'),
                    'hidden' => false
                ];
                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl('movie/movie/delete', ['id' => $item['movie_id']]),
                    'label' => __('Delete'),
                    'hidden' => false
                ];
            }
        }


        return $dataSource;
    }
}