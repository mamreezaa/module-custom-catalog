<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Block\Adminhtml;

use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Catalog\Model\Product\TypeFactory;
use Magento\Catalog\Model\ProductFactory;

class Product extends Container
{
    /**
     * @var TypeFactory
     */
    protected TypeFactory $typeFactory;

    /**
     * @var ProductFactory
     */
    protected ProductFactory $productFactory;

    /**
     * @param Context $context
     * @param TypeFactory $typeFactory
     * @param ProductFactory $productFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        TypeFactory $typeFactory,
        ProductFactory $productFactory,
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        $this->typeFactory = $typeFactory;

        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->buttonList->add('add_new', [
            'label' => __('Add New Product'),
            'class' => 'add primary add-template',
            'onclick' => "setLocation('" . $this->getSimpleProductCreateUrl() . "')",
        ]);

        return parent::_prepareLayout();
    }

    /**
     * Retrieve product create url by specified product type
     *
     * @return string
     */
    protected function getSimpleProductCreateUrl(): string
    {
        return $this->getUrl(
            'ounass_customcatalog/*/new',
            ['set' => $this->productFactory->create()->getDefaultAttributeSetId(), 'type' => 'simple']
        );
    }
}
