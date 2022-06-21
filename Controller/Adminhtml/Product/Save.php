<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\TypeTransitionManager;
use Ounass\CustomCatalog\Controller\Adminhtml\Product;
use Magento\Catalog\Controller\Adminhtml\Product\Builder;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper as InitializationHelper;

class Save extends Product
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var InitializationHelper
     */
    private InitializationHelper $initializationHelper;

    /**
     * @var TypeTransitionManager
     */
    private TypeTransitionManager $productTypeManager;


    private ProductRepositoryInterface $productRepository;

    /**
     * @param Context $context
     * @param Builder $productBuilder
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     * @param InitializationHelper $initializationHelper
     * @param TypeTransitionManager $productTypeManager
     * @param StoreManagerInterface|null $storeManager
     */
    public function __construct(
        Context                    $context,
        Builder                    $productBuilder,
        ProductRepositoryInterface $productRepository,
        LoggerInterface            $logger,
        InitializationHelper       $initializationHelper,
        TypeTransitionManager $productTypeManager,
        StoreManagerInterface      $storeManager = null
    ) {
        parent::__construct($context, $productBuilder);
        $this->initializationHelper = $initializationHelper;
        $this->productRepository = $productRepository;
        $this->productTypeManager = $productTypeManager;
        $this->logger = $logger;
        $this->storeManager = $storeManager ?: ObjectManager::getInstance()
            ->get(StoreManagerInterface::class);
    }


    public function execute(): ResultInterface
    {
        $storeId = $this->getRequest()->getParam('store', 0);
        $store = $this->storeManager->getStore($storeId);
        $this->storeManager->setCurrentStore($store->getCode());
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                $product = $this->initializationHelper->initialize(
                    $this->productBuilder->build($this->getRequest())
                );
                $product = $this->productRepository->save($product);
                $this->messageManager->addSuccessMessage(__('You saved the product.'));
                $resultRedirect->setPath('*/*/edit', ['id' => $product->getId(), 'store' => $storeId]);
            } catch (LocalizedException|\Exception $e) {
                $resultRedirect->setPath('*/*/');
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        } else {
            $resultRedirect->setPath('*/*/');
            $this->messageManager->addErrorMessage('No data to save');
        }

        return $resultRedirect;
    }
}
