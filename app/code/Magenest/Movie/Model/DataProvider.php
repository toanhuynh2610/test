<?php
//
//namespace Magenest\Movie\Model;
//
//use Magento\Store\Model\StoreManagerInterface;
//
//class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
//{
//
//
//    public function getData()
//    {
//
//        $items = $this->collection->getItems();
//
//        //Replace icon with fileuploader field name
//        foreach ($items as $model) {
//            $this->loadedData[$model->getId()] = $model->getData();
//            if ($model->getAvatar()) {
//                $m['avatar'][0]['name'] = $model->getAvatar();
//                $m['avatar'][0]['url'] = $this->getMediaUrl().$model->getAvatar();
//                $fullData = $this->loadedData;
//                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
//            }
//        }
//
//
//        return $this->loadedData;
//    }
//
//    public function getMediaUrl()
//    {
//        $mediaUrl = $this->storeManager->getStore()
//                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'movie/tmp/avatar/';
//        return $mediaUrl;
//    }
//}