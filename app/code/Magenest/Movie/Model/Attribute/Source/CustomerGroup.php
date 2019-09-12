<?php
namespace Magenest\Movie\Model\Attribute\Source;
use Magento\Customer\Model\Customer\Source\Group;
class CustomerGroup extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $customerGroup;
    public function __construct( Group $group)
    {
        $this->customerGroup = $group;
    }
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = $this->customerGroup->toOptionArray();
        }
        return $this->_options;
    }
}