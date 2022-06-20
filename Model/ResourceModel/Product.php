<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\ResourceModel;

class Product extends \Magento\Catalog\Model\ResourceModel\Product
{
    public function customProductValidate($object): bool|array
    {
        $errors = [];
        if (!isset($object['entity_id'])) {
            $errors[] = "entity_id is required";
        }
        if (!isset($object['vpn']) and !isset($object['copy_write_info'])) {
            $errors[] = "At least one attribute(vpn or copy_write_info) is needed.";
        }

        if (!empty($errors)) {
            return  $errors;
        }
        return true;
    }
}
