<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Api;

use Ounass\CustomCatalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\StateException;

interface ProductRepositoryInterface
{
    /**
     * Create product
     *
     * @param ProductInterface $product
     * @return ProductInterface
     * @throws InputException
     * @throws StateException
     * @throws CouldNotSaveException
     */
    public function enqueueProduct(ProductInterface $product): ProductInterface;
    /**
     * Get product list by vpn
     * @param string $vpn
     * @return ProductInterface[]
     */
    public function getListByVpn(string $vpn): array;
}
