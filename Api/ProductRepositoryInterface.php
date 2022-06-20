<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Api;

use Magento\Catalog\Api\Data\ProductInterface;

interface ProductRepositoryInterface
{
    /**
     * Get product list by vpn
     * @param string $vpn
     * @return ProductInterface[]
     */
    public function getListByVpn(string $vpn): array;
}
