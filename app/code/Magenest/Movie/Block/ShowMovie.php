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
    private $_actorCollectionFactory;

    public function __construct(
        Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\Movie\
        CollectionFactory $movieCollectionFactory,
        \Magenest\Movie\Model\ResourceModel\Actor\
        CollectionFactory $actorCollectionFactory,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_movieCollectionFactory = $movieCollectionFactory;
        $this->_actorCollectionFactory = $actorCollectionFactory;
    }

    public function getMovie()
    {
        $collection = $this->_movieCollectionFactory->create();
        $collection->getSelect()->join(
            ['magenest_director' => $collection->getTable('magenest_director')],
            'main_table.director_id = magenest_director.director_id',
            ['dname' => 'magenest_director.name']);
        return $collection;

    }

    public function getActor($a)
    {
        $int = (int)$a;
        $collection = $this->_actorCollectionFactory->create();
        $collection->getSelect()->join(
            ['magenest_movie_actor' => $collection->getTable('magenest_movie_actor')],
            'main_table.actor_id = magenest_movie_actor.actor_id',
            ['aname' => 'main_table.name'])
            ->join(
                ['magenest_movie' => $collection->getTable('magenest_movie')],
                'magenest_movie_actor.movie_id = magenest_movie.movie_id',
                ['aname' => 'main_table.name']);;
        $collection->AddFieldToFilter('magenest_movie.movie_id', $int);
        return $collection;
    }
}
