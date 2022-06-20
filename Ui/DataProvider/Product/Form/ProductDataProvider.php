<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Ui\DataProvider\Product\Form;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ProductDataProvider extends AbstractDataProvider
{
    /**
     * Product collection
     *
     * @var Collection
     */
    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->addField(['entity_id', 'name', 'price', 'vpn', 'copy_write_info']);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        $data = parent::getData();
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->collection->getItems();
        foreach ($items as $product) {
            $data[$product->getId()] = ['product' => $product->getData()];
        }
        return $data;
    }
}
