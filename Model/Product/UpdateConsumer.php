<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Ounass\CustomCatalog\Api\Data\MessageInterface;
use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Psr\Log\LoggerInterface;
use Ounass\CustomCatalog\Model\ResourceModel\Product as CustomProductResourceModel;

class UpdateConsumer
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;
    /**
     * @var CustomProductResourceModel
     */
    protected $productResourceModel;

    public function __construct(
        LoggerInterface $logger,
        ProductRepositoryInterface $productRepository,
        CustomProductResourceModel $productResourceModel
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
        $this->productResourceModel = $productResourceModel;
    }

    /**
     * @param MessageInterface $message
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws LocalizedException
     */
    public function process(MessageInterface $message): void
    {
        try {
            $product = $this->productRepository->getById(
                $message->getProduct()->getEntityId(),
                storeId: $message->getStoreId()
            );
            $message = $this->productResourceModel->buildMessage($product, $message);
            $product
                ->setCustomAttribute(ProductInterface::VPN, $message->getProduct()->getVpn())
                ->setCustomAttribute(ProductInterface::COPY_WRITE_INFO, $message->getProduct()->getCopyWriteInfo());
            $this->productRepository->save($product);
            $this->logger->info("Request {$message->getRequestUuid()} processed successfully");
        } catch (\Magento\Framework\Exception\NoSuchEntityException|\Exception $exception) {
            $this->logger->error(
                "Request {$message->getRequestUuid()} can not be processed",
                $exception->getTrace()
            );
            throw new $exception;
        }
    }
}
