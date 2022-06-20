<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Ounass\CustomCatalog\Model\ProductUpdateMessage;

interface ProductRepositoryInterface extends \Magento\Catalog\Api\ProductRepositoryInterface
{
    /**
     * Create product
     *
     * @param ProductInterface $product
     * @return ProductUpdateMessage
     * @throws NoSuchEntityException
     */
    public function enqueueProduct(ProductInterface $product): ProductUpdateMessage;
    /**
     * Get product list by vpn
     * @param string $vpn
     * @return ProductInterface[]
     */
    public function getListByVpn(string $vpn): array;
}
