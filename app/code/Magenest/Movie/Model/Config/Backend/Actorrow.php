<?php

namespace Magenest\Movie\Model\Config\Backend;
use \Magento\Framework\App\Config\ScopeConfigInterface;
class Actorrow extends \Magento\Framework\App\Config\Value
{
    private $_actorCollectionFactory;
    public function __construct(\Magento\Framework\Model\Context $context,
                                \Magento\Framework\Registry $registry,
                                ScopeConfigInterface $config,
                                \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
                                \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
                                \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
                                \Magenest\Movie\Model\ResourceModel\Actor\
                                CollectionFactory $actorCollectionFactory,
                                array $data = [])
    {
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
        $this->_actorCollectionFactory = $actorCollectionFactory;
    }

    public function afterLoad()
    {
        $collection = $this->_actorCollectionFactory->create();

        $this->setValue($collection->count('*'));

        parent::beforeSave();
    }
}