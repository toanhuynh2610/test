<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;

class ChangeFirstNameFE implements ObserverInterface
{
    /** @var CustomerRepositoryInterface */
    protected $customerRepository;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Manages redirect
     */
    public function execute(Observer $observer)
    {
        $customer = $observer->getCustomer();
        $customer->setFirstName('Magenest');
        $this->customerRepository->save($customer);
    }
}
