<?php

namespace Magenest\Movie\Model\Config\Backend;
use \Magento\Framework\App\Config\ScopeConfigInterface;
class Movierow extends \Magento\Framework\App\Config\Value
{
    private $_movieCollectionFactory;
    public function __construct(\Magento\Framework\Model\Context $context,
                                \Magento\Framework\Registry $registry,
                                ScopeConfigInterface $config,
                                \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
                                \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
                                \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
                                \Magenest\Movie\Model\ResourceModel\Movie\
                                CollectionFactory $movieCollectionFactory,
                                array $data = [])
    {
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
        $this->_movieCollectionFactory = $movieCollectionFactory;
    }

    public function afterLoad()
    {
        $collection = $this->_movieCollectionFactory->create();

        $this->setValue($collection->count('*'));

        parent::beforeSave();
    }
}