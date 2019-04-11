<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 25/03/2019
 * Time: 14:43
 */

namespace Magenest\Movie\Controller\Adminhtml\Actor;
// use class Context and PageFactory
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Movie::actor');
    }
}