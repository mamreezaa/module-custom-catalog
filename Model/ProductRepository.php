<?php

namespace Ounass\CustomCatalog\Model;

use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Ounass\CustomCatalog\Api\ProductRepositoryInterface;
use Ounass\CustomCatalog\Model\ResourceModel\Product as CustomProductResourceModel;

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

    protected CustomProductResourceModel $resourceModel;

    public function __construct(
        CollectionFactory      $collectionFactory,
        CustomProductResourceModel $resourceModel
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel = $resourceModel;
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

    /**
     * @inheritdoc
     * @throws \Exception
     */
    public function enqueueProduct(ProductInterface $product): ProductInterface
    {
        $validationResult = $this->resourceModel->customProductValidate($product);
        if (true !== $validationResult) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __('Invalid product data: %1', implode(',', $validationResult))
            );
        }
        //publish $product
        return $product;
    }
}
