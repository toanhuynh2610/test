<?php

namespace Magenest\Movie\Model;

use Magento\Customer\Model\FileProcessorFactory;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magento\Eav\Model\Config;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\FilterPool;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\EavValidationRules;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName);
    }
    public function getData()
    {

        $items = $this->collection->getItems();

        //Replace icon with fileuploader field name
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            if ($model->getAvatar()) {
                $m['avatar'][0]['name'] = $model->getAvatar();
                $m['avatar'][0]['url'] = $this->getMediaUrl().$model->getAvatar();
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
            }
        }


        return $this->loadedData;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'movie/tmp/avatar/';
        return $mediaUrl;
    }
}