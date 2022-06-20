<?php

namespace Ounass\CustomCatalog\Model;

use Exception;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Model\Attribute\ScopeOverriddenValue;
use Magento\Catalog\Model\Product\Gallery\MimeTypeExtensionMap;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Api\Data\ImageContentInterfaceFactory;
use Magento\Framework\Api\ImageContentValidatorInterface;
use Magento\Framework\Api\ImageProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\EntityManager\Operation\Read\ReadExtensions;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\MessageQueue\Publisher;
use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Ounass\CustomCatalog\Api\ProductRepositoryInterface;
use Ounass\CustomCatalog\Model\ResourceModel\Product as CustomProductResourceModel;
use Ramsey\Uuid\Uuid;

/**
 *
 */
class ProductRepository extends \Magento\Catalog\Model\ProductRepository implements ProductRepositoryInterface
{
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
    public function enqueueProduct(ProductInterface $product): ProductUpdateMessage
    {
        $existingProduct = $this->getById($product->getId());
        if (!$existingProduct->getId()) {
            throw new NoSuchEntityException;
        }
        $uuid = Uuid::uuid4()->toString();
        $publisher = ObjectManager::getInstance()->get(Publisher::class);
        $message = ObjectManager::getInstance()->get(ProductUpdateMessage::class);
        $message->setRequestUuid($uuid)->setBody([$product->getData()]);
        $publisher->publish('customcatalog.product.update', $message);
        return $message;
    }
}
