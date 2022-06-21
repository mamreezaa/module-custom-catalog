<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\ResourceModel;

use Ounass\CustomCatalog\Api\Data\ProductInterface;

class Product
{
    public function customProductValidate(ProductInterface $product): bool|array
    {
        $errors = [];
        if (empty($product->getEntityId())) {
            $errors[] = "entity_id is required";
        }
        if (is_null($product->getVpn()) and is_null($product->getCopyWriteInfo())) {
            $errors[] = "At least one attribute(vpn or copy_write_info) is needed.";
        }

        if (!empty($errors)) {
            return  $errors;
        }
        return true;
    }
}
