<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 16:42
 */
namespace Magenest\Movie\Setup;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory ;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class UpgradeData implements UpgradeDataInterface {
    private $customerSetupFactory;
    private $attributeSetFactory;
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
 \Magento\Eav\Model\Entity\Attribute\SetFactory $attributeSetFactory)
    {
        $this->customerSetupFactory =$customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }
    public function upgrade(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context) {
        if (version_compare($context->getVersion(), '2.2.9') <
            0) {
                /** @var CustomerSetup $customerSetup */
                $attributeCode = 'avatar';

                $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
                $setup->startSetup();

                $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
                $attributeSetId = $customerEntity->getDefaultAttributeSetId();

                /** @var $attributeSet AttributeSet */
                $attributeSet = $this->attributeSetFactory->create();
                $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

            $customerSetup->addAttribute('customer',
                    'avatar', [
                        'label' => 'Avatar',
                        'type' => 'varchar',
                        'input'=>'text',
                        'backend' => 'Magenest\Movie\Model\Eav\Backend\AvatarCustomer',
                        'required' => false,
                        'visible' => true,
                        'system' => false,
                        'position' => 1,
                        'user_defined' => true,
                    ]);
                $customerSetup->addAttributeToSet(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
                null,
                $attributeCode);
                $avatarAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'avatar');
                $avatarAttribute->addData(
                    ['attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms'=>['adminhtml_customer','customer_account_edit','customer_account_create']]
        );
                $avatarAttribute->save();
                $setup->endSetup();

        }
    }
}