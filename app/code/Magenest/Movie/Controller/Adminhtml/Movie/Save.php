<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;
use Magenest\Movie\Model\Movie ;

class Save extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
//        var_dump($data);
//        exit();

        if ($data) {
            try{
                $movie = $this->_objectManager->create('Magenest\Movie\Model\Movie');
                $movie->setName($data["movie_name"]);
                $movie->setDescription($data["movie_description"]);
                $movie->setRating($data["movie_rating"]);
                $movie->setDirector_id($data["movie_diector"]);
                $movie->save();
<<<<<<< HEAD

                $this->_eventManager->dispatch(
                    'save_movie',
                    ['movie' => $movie]
                );

=======
>>>>>>> 42eb8115f477a184a19a3c230f15d7e1ff27e6cf
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magenest\Movie\Model\Movie')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magenest\Movie\Model\Movie')->setFormData($data);
                return $resultRedirect->setPath('*/*/new');
            }
        }
        return $resultRedirect->setPath('*/*/');
}
}