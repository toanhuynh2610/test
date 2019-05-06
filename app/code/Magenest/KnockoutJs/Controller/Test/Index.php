<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 26/04/2019
 * Time: 14:34
 */

namespace Magenest\KnockoutJs\Controller\Test;
class Index extends \Magento\Framework\App\Action\Action
{

    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory
        $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
