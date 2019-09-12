<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Framework\App\Action\Context;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $movieFacory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Movie\Model\MovieFactory $movieFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->movieFactory = $movieFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $movie = $this->movieFactory->create()->load($id);

        if(!$movie)
        {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }

        try{
            $movie->delete();
            $this->messageManager->addSuccess(__('Your contact has been deleted !'));
        }
        catch(\Exception $e)
        {
            $this->messageManager->addError(__('Error while trying to delete contact'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}