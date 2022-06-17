<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Add product attribute for custom catalog
 */
class AddCustomCatalogAttributes implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * AddCustomCatalogAttributes constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            'copy_write_info',
            [
                'type' => 'text',
                'label' => 'Copy Write Info',
                'input' => 'textarea',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'required' => false,
                'user_defined' => true,
                'searchable' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'is_used_in_grid' => true,
                'used_in_product_listing' => true,
                'comparable' => true,
                'visible_on_front' => true,
                'apply_to' => Type::TYPE_SIMPLE,
                'group' => 'General'
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'vpn',
            [
                'type' => 'varchar',
                'label' => 'Vendor Product Number',
                'input' => 'text',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'required' => false,
                'user_defined' => true,
                'searchable' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'is_used_in_grid' => true,
                'used_in_product_listing' => true,
                'comparable' => true,
                'visible_on_front' => true,
                'apply_to' => Type::TYPE_SIMPLE,
                'group' => 'General'
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}
