<?php

namespace Ounass\CustomCatalog\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\MessageQueue\Publisher;
use Magento\Store\Model\StoreManagerInterface;
use Ounass\CustomCatalog\Api\Data\MessageInterface;
use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Ounass\CustomCatalog\Model\ResourceModel\Product as CustomProductResourceModel;
use Ramsey\Uuid\Uuid;
use Magento\Backend\App\Action\Context;
/**
 *
 */
class ProductRepository implements \Ounass\CustomCatalog\Api\ProductRepositoryInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var Publisher
     */
    protected $publisher;

    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * @var CustomProductResourceModel
     */
    protected $productResourceModel;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param CollectionFactory $collectionFactory
     * @param ProductRepositoryInterface $productRepository
     * @param Publisher $publisher
     * @param MessageInterface $message
     * @param CustomProductResourceModel $productResourceModel
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        ProductRepositoryInterface $productRepository,
        Publisher $publisher,
        MessageInterface $message,
        CustomProductResourceModel $productResourceModel,
        StoreManagerInterface $storeManager
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->productRepository = $productRepository;
        $this->publisher = $publisher;
        $this->message = $message;
        $this->productResourceModel = $productResourceModel;
        $this->storeManager = $storeManager;
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
     */
    public function enqueueProduct(ProductInterface $product): MessageInterface
    {
        $validationResult = $this->productResourceModel->customProductValidate($product);
        if (true !== $validationResult) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __('Invalid product data: %1', implode(',', $validationResult))
            );
        }
        $existingProduct = $this->productRepository->getById($product->getEntityId());
        if (!$existingProduct->getId()) {
            throw new NoSuchEntityException;
        }
        $uuid = Uuid::uuid4()->toString();
        $this->message
            ->setStoreId($this->storeManager->getStore()->getId())
            ->setRequestUuid($uuid)
            ->setProduct($product);
        $this->publisher->publish('customcatalog.product.update', $this->message);
        return $this->message;
    }
}
