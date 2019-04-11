<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 13:17
 */

namespace Magenest\Movie\Controller\Index;
class Add extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $director = $this->_objectManager->create('Magenest\Movie\Model\Director');
        $director->setName('Nguyen Quang Dung');
        $director->save();

        $actor = $this->_objectManager->create('Magenest\Movie\Model\Actor');
        $actor->setName('Thanh Hang');
        $actor->save();
        $actor1 = $this->_objectManager->create('Magenest\Movie\Model\Actor');
        $actor1->setName('Naomi');
        $actor1->save();

        $movie = $this->_objectManager->create('Magenest\Movie\Model\Movie');
        $movie->setName('The Face');
        $movie->setDescription('dramatically');
        $movie->setRating(5);
        $movie->setDirector_id(2);
        $movie->save();
        $moac = $this->_objectManager->create('Magenest\Movie\Model\MoAc');
        $moac->setMovie_id(1);
        $moac->setActor_id(1);
        $moac->save();
        $moac1 = $this->_objectManager->create('Magenest\Movie\Model\MoAc');
        $moac1->setMovie_id(1);
        $moac1->setActor_id(2);
        $moac1->save();
//        $moac->setMovie_id(2);
//        $moac->setActor_id(1);
//        $moac->setMovie_id(2);
//        $moac->setActor_id(3);




        $this->getResponse()->setBody('Added successfully');

    }
}
