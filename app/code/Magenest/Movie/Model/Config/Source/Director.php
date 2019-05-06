<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 29/03/2019
 * Time: 13:26
 */

namespace Magenest\Movie\Model\Config\Source;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Director implements \Magento\Framework\Option\ArrayInterface
{
    private $_directorCollectionFactory;
    public function __construct(\Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $directorCollectionFactory)
    {
        $this->_directorCollectionFactory = $directorCollectionFactory;
    }
    public function toOptionArray()
    {

        return $this->getDirector();
    }
    public function getDirector(){
        $collection = $this->_directorCollectionFactory->create();
        $arrayValue = array();
        foreach($collection as $director){
            $value =  [
                'value' => $director['director_id'],
                'label' => __($director['name'])
            ];
            array_push($arrayValue,$value);
        }
        return $arrayValue;
    }
}