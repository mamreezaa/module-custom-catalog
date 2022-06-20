<?php

namespace Ounass\CustomCatalog\Model;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Ounass\CustomCatalog\Api\ProductRepositoryInterface;

/**
 *
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * ProductRepository constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory      $collectionFactory,
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function getListByVpn(string $vpn): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect(['name', 'vpn', 'copy_write_info']);
        $collection->addAttributeToFilter('vpn', $vpn);
        $collection->load();
        return $collection->getItems();
    }
}
