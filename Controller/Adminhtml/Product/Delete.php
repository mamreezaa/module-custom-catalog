<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Controller\Adminhtml\Product;
use Magento\Catalog\Controller\Adminhtml\Product\Builder;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Backend\App\Action;

class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ounass_CustomCatalog::customcatalog_products';

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param Context $context
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context                    $context,
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }


    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $productId = (int) $this->getRequest()->getParam('id');
        try {
            $product = $this->productRepository->getById($productId);
            $this->productRepository->delete($product);
            $this->messageManager->addSuccessMessage(
                __('Product with the ID %1 has been deleted.', $productId)
            );
        } catch (LocalizedException $exception) {
            $this->logger->error($exception->getLogMessage());
            $this->messageManager->addErrorMessage(
                __(
                    "Product with the ID %1 has\'t been deleted",
                    $productId
                )
            );
        }
        return $this->resultFactory
            ->create(ResultFactory::TYPE_REDIRECT)
            ->setPath('ounass_customcatalog/*/index');
    }
}
