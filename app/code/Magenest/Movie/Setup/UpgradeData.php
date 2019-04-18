<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 16:42
 */
namespace Magenest\Movie\Setup;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class UpgradeData implements UpgradeDataInterface {
    private $customerSetupFactory;
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory =$customerSetupFactory;
    }
    public function upgrade(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context) {
        if (version_compare($context->getVersion(), '2.1.4') <
            0) {
                /** @var CustomerSetup $customerSetup */
                $attributeCode = 'avatar';

                $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
                $setup->startSetup();
                $customerSetup->addAttribute('customer',
                    'avatar', [
                        'label' => 'Avatar',
                        'type' => 'text',
                        'frontend_input' => 'image',
                        'required' => false,
                        'visible' => true,
                        'position' => 25,
                    ]);
                $customerSetup->addAttributeToSet(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
                null,
                $attributeCode);
                $avatarAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'avatar');
                $avatarAttribute->setData('used_in_forms',['adminhtml_customer']);
                $avatarAttribute->save();
                $setup->endSetup();
        }
    }
}