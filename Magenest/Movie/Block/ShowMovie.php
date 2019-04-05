<?php

/**
 * Created by PhpStorm.
 * User: toan
 * Date: 19/03/2019
 * Time: 16:35
 */

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;

class ShowMovie extends Template
{
    private $_movieCollectionFactory;
    private $_moacCollectionFactory;
    public function __construct(
        Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\Movie\
        CollectionFactory $movieCollectionFactory,
        \Magenest\Movie\Model\ResourceModel\MoAc\
        CollectionFactory $moacCollectionFactory,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_movieCollectionFactory = $movieCollectionFactory;
        $this->_moacCollectionFactory = $moacCollectionFactory;
    }
    public function getMovie()
    {
        $collection = $this->_movieCollectionFactory->create();
        $collection->getSelect()->join(
            ['magenest_director'=>$collection->getTable('magenest_director')],
            'main_table.director_id = magenest_director.director_id',
            ['dname'=>'magenest_director.name']);
        return $collection;

    }
    public function getActor($a){
        $int = (int)$a;
        $collection = $this->_moacCollectionFactory->create();
        $collection->AddFieldToFilter('movie_id',$int);
        $collection->getSelect()->join(
            ['magenest_actor'=>$collection->getTable('magenest_actor')],
            'main_table.actor_id = magenest_actor.actor_id',
            ['aname'=>'magenest_actor.name']);
        return $collection;
    }
}
