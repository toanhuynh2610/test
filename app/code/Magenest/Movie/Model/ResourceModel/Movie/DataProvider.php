<?php
namespace Magenest\Movie\Model\ResourceModel\Movie;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    protected $dataPersistor;
    protected $loadedData;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $movieCollectionFactory,
        DataPersistorInterface $dataPersistor,

        array $meta = [],
        array $data = []
    ) {
        $this->collection = $movieCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $movie) {
            $this->loadedData[$movie->getId()] = $movie->getData();
        }
        return $this->loadedData;
    }

}