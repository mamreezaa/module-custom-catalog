<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use Ounass\CustomCatalog\Api\Data\MessageInterface;
use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Ounass\CustomCatalog\Model\Message;

interface ProductRepositoryInterface
{
    /**
     * Create product
     *
     * @param \Ounass\CustomCatalog\Api\Data\ProductInterface $product
     * @return Message
     * @throws NoSuchEntityException
     */
    public function enqueueProduct(\Ounass\CustomCatalog\Api\Data\ProductInterface $product): MessageInterface;
    /**
     * Get product list by vpn
     * @param string $vpn
     * @return \Ounass\CustomCatalog\Api\Data\ProductInterface[]
     */
    public function getListByVpn(string $vpn): array;
}
