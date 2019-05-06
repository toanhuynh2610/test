<?php
namespace Magenest\Movie\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
class CountNumber extends Template
{
    protected $objectManager;
    protected $fullModuleList;
    protected $productCollection;
    protected $customerCollection;
    protected $orderCollection;
    protected $invoiceCollection;
    protected $creditmemoCollection;

    public function __construct(\Magento\Framework\Module\FullModuleList $fullModuleList,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection,
                                \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollection,
                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollection,
                                \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollection,
                                \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $creditmemoCollection,
                                Template\Context $context,
                                array $data = []){
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->fullModuleList = $fullModuleList;
        $this->productCollection = $productCollection;
        $this->customerCollection = $customerCollection;
        $this->orderCollection = $orderCollection;
        $this->invoiceCollection = $invoiceCollection;
        $this->creditmemoCollection = $creditmemoCollection;
        parent::__construct($context, $data);

    }
    public function getNumberOfProducts(){

        $count =$this->productCollection->create()->count('*');
        return $count;
    }
    public function getNumberOfCustomers(){
        $count =$this->customerCollection->create()->count('*');
        return $count;
    }
    public function getNumberOfOrders(){
        $count =$this->orderCollection->create()->count('*');
        return $count;
    }
    public function getNumberOfInvoices(){
        $count =$this->invoiceCollection->create()->count('*');
        return $count;
    }
    public function getNumberOfCreditmemos(){
        $count =$this->creditmemoCollection->create()->count('*');
        return $count;
    }
    public function getNumberOfModules(){
        $allModules = $this->fullModuleList->getNames();
        $count = sizeof($allModules);
        return $count;
    }
    public function getNumberOfModulesNotMagento(){
        $allModules = $this->fullModuleList->getNames();
        $filteredArray = array_filter($allModules, function ($value)
        {
            return strpos($value, 'Magento') === FALSE;
        });
        $count = sizeof($filteredArray);
        return $count;
    }
}