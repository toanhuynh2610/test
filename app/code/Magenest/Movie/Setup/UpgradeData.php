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
use Magento\Eav\Setup\EavSetupFactory;
class UpgradeData implements UpgradeDataInterface {
    private $customerSetupFactory;
    private $attributeSetFactory;
    /**
     * @var \Magento\Framework\DB\FieldDataConverterFactory
     */
    private $fieldDataConverterFactory;

    /**
     * @var \Magento\Framework\DB\Select\QueryModifierFactory
     */
    private $queryModifierFactory;

    /**
     * @var \Magento\Framework\DB\Query\Generator
     */
    private $queryGenerator;
    private $manager;
    private $productMetaData;
    private $eavSetupFactory;
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
 \Magento\Eav\Model\Entity\Attribute\SetFactory $attributeSetFactory,
                                \Magento\Framework\DB\FieldDataConverterFactory $fieldDataConverterFactory,
                                \Magento\Framework\DB\Select\QueryModifierFactory $queryModifierFactory,
                                \Magento\Framework\DB\Query\Generator $queryGenerator,
                                \Magento\Framework\Module\Manager $manager,
                                \Magento\Framework\App\ProductMetadataInterface $productMetadata,
                                EavSetupFactory $eavSetupFactory)
    {
        $this->customerSetupFactory =$customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->fieldDataConverterFactory = $fieldDataConverterFactory;
        $this->queryModifierFactory = $queryModifierFactory;
        $this->queryGenerator = $queryGenerator;
        $this->manager = $manager;
        $this->productMetaData = $productMetadata;
        $this->eavSetupFactory = $eavSetupFactory;
    }
    public function upgrade(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context) {
        if (version_compare($context->getVersion(), '2.0.9') <
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
        if(version_compare($context->getVersion(), '2.1.7') <
            0){
            $this->convertConditionSerialized($setup);
        }
        if(version_compare($context->getVersion(), '2.1.9') <
            0){
            $this->addSelectAttribute($setup);
        }
        if(version_compare($context->getVersion(), '2.2.0') <
            0){
            $this->addVarcharAttribute($setup);
        }
        if (version_compare($context->getVersion(), '2.2.1', '<')) {
            $eavSetup = $this->eavSetupFactory->create();

            $fieldList = [
                'price',
                'special_price',
                'special_from_date',
                'special_to_date',
                'minimal_price',
                'cost',
                'tier_price',
            ];

            // make these attributes applicable to downloadable products
            foreach ($fieldList as $field) {
                $applyTo = explode(
                    ',',
                    $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $field, 'apply_to')
                );
                if (!in_array('mito', $applyTo)) {
                    $applyTo[] = 'mito';
                    $eavSetup->updateAttribute(
                        \Magento\Catalog\Model\Product::ENTITY,
                        $field,
                        'apply_to',
                        implode(',', $applyTo)
                    );
                }
            }
        }
    }
    public function convertConditionSerialized($setup){
        if ($this->manager->isEnabled('Magenest_Movie')) {
            if($this->productMetaData->getVersion() > '2.1.0'){
                $fieldDataConverter = $this->fieldDataConverterFactory->create(\Magento\Framework\DB\DataConverter\SerializedToJson::class);
//                $fieldDataConverter = $this->fieldDataConverterFactory->create(\Magento\Framework\DB\DataConverter\SerializedToJson::class);
            }
            else{
                $fieldDataConverter = $this->fieldDataConverterFactory->create(\Magento\Framework\DB\DataConverter\SerializedToJson::class);
            }

//            \Magento\Framework\DB\DataConverter\SerializedToJson::class
//            \Magenest\Movie\Helper\JsonToSerialized::class

            $fieldDataConverter->convert(
                $setup->getConnection(),
                $setup->getTable('magenest_rules'),
                'id',
                'condition_serialized'
            );
        }
    }
    public function addSelectAttribute($setup){
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'customer_group',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Customer Group',
                'input' => 'select',
                'source' => 'Magenest\Movie\Model\Attribute\Source\CustomerGroup',
                'frontend' => 'Magenest\Movie\Model\Attribute\Frontend\CustomerGroup',
                'backend' => 'Magenest\Movie\Model\Attribute\Backend\CustomerGroup',
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
    }
    public function addVarcharAttribute($setup){
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'varchar',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Varchar',
                'input' => 'input',
                'frontend' => 'Magenest\Movie\Model\Attribute\Frontend\Varchar',
                'backend' => 'Magenest\Movie\Model\Attribute\Backend\Varchar',
                'required' => false,
                'sort_order' => 55,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
    }
}