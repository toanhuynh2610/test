<?php

namespace Magenest\Movie\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    protected $dataPersistor;
    protected $_customerFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Customer\Model\CustomerFactory $customerFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->_customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        var_dump($data);
        exit();

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {


            if (isset($data['avatar'][0]['name']) && isset($data['avatar'][0]['tmp_name'])) {
                $data['image'] = $data['avatar'][0]['name'];
                $this->imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get(
                    'Magenest\Movie\Model\ImageUploader'
                );
                $this->imageUploader->moveFileFromTmp($data['image']);
            } elseif (isset($data['avatar'][0]['image']) && !isset($data['avatar'][0]['tmp_name'])) {
                $data['image'] = $data['avatar'][0]['image'];
            } else {
                $data['image'] = null;
            }
            $customer = $this->_customerFactory->create();
            $customerData = $customer->getDataModel();
            $customerData->setCustomAttribute('my_attr_code', $data['image']);
            $customer->updateData($customerData);
            $customer->save();

            return $resultRedirect->setPath('*/*/');

        }
    }
}
