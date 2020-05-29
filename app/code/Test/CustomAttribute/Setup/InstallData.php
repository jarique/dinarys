<?php

namespace Test\CustomAttribute\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var \Magento\Eav\Model\Entity\Attribute\SetFactory
     */
    private $attributeSetFactory;

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
        \Magento\Eav\Model\Entity\Attribute\SetFactory $attributeSetFactory,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory  = $attributeSetFactory;
        $this->eavSetupFactory      = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // Product Attribute
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'test_product_attribute', [
            'group' => 'General',
            'type' => 'int',
            'label' => 'Test product attribute',
            'input' => 'select',
            'source' => 'Test\CustomAttribute\Model\Attribute\Source\YesNo',
            'frontend' => '',
            'backend' => '',
            'visible' => true,
            'required' => true,
            'sort_order' => 50,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'is_html_allowed_on_front' => false,
            'visible_on_front' => false
        ]);

        // Customer Attribute
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'test_customer_attribute', [
            'type' => 'varchar',
            'label' => 'Test Customer Attribute',
            'input' => 'text',
            'required' => false,
            'visible' => true,
            'source' => '',
            'backend' => '',
            'user_defined' => false,
            'is_user_defined' => false,
            'sort_order' => 1000,
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'is_searchable_in_grid' => false,
            'position' => 1000,
            'default' => null,
            'system' => 0
        ]);

        $attribute = $customerSetup->getEavConfig()
            ->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'test_customer_attribute')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer']
            ]);
        $attribute->save();

        // Category Attribute
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'test_category_attribute', [
            'type'         => 'varchar',
            'label'        => 'Test Category Attribute',
            'input'        => 'text',
            'sort_order'   => 100,
            'source'       => '',
            'global'       => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'visible'      => true,
            'required'     => false,
            'user_defined' => false,
            'default'      => null,
            'group'        => 'Display Settings',
            'backend'      => ''
        ]);
    }
}
