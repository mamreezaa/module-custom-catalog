<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Ounass\CustomCatalog\Api\Data\MessageInterface;
use Psr\Log\LoggerInterface;

class UpdateConsumer
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    private ProductRepositoryInterface $productRepository;


    public function __construct(
        LoggerInterface $logger,
        ProductRepositoryInterface $productRepository
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
    }

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function process(MessageInterface $message): void
    {
        $product = $this->productRepository->getById(
            $message->getProduct()->getEntityId(),
            storeId: $message->getStoreId()
        );
        $product
            ->setCustomAttribute('vpn', $message->getProduct()->getVpn())
            ->setCustomAttribute('copy_write_info', $message->getProduct()->getCopyWriteInfo());
        $this->productRepository->save($product);
        $this->logger->info('Request UUID with ' . $message->getRequestUuid() . 'processed successfully');
    }
}
