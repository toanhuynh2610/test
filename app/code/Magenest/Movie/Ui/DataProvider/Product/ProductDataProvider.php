<?php
namespace Magenest\Movie\Ui\DataProvider\Product;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ProductDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    protected $authSession;
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession,
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        $this->authSession = $authSession;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $collectionFactory, $addFieldStrategies, $addFilterStrategies, $meta, $data);
    }
    public function getData()
    {

        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->toArray();
        $user = $this->authSession->getUser();
        $temp = [];
        if(preg_match('/^[A-M].*/',$user->getFirstName(),$matches)){
            foreach($items as $key => $item){
                unset($item['varchar']);
                $temp[$key] = $item;
            }
            $items = $temp;
        }
        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items),
        ];
    }
}