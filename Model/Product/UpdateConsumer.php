<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
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
            $product
                ->setCustomAttribute('vpn', $message->getProduct()->getVpn())
                ->setCustomAttribute('copy_write_info', $message->getProduct()->getCopyWriteInfo());
            $this->productRepository->save($product);
            $this->logger->info("Request {$message->getRequestUuid()} processed successfully");
        } catch (\Magento\Framework\Exception\NoSuchEntityException $noSuchEntityException) {
            throw $noSuchEntityException;
        } catch (\Exception $exception) {
            $this->logger->critical($exception);
            throw new LocalizedException("Could not process the request with the UUID {$message->getRequestUuid()}");
        }
    }
}
