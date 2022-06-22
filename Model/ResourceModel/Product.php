<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\ResourceModel;

use Ounass\CustomCatalog\Api\Data\MessageInterface;
use Ounass\CustomCatalog\Api\Data\ProductInterface as CustomProductInterface;
use Magento\Catalog\Api\Data\ProductInterface;

class Product
{
    public function customProductValidate(CustomProductInterface $product): bool|array
    {
        $errors = [];
        if (empty($product->getEntityId())) {
            $errors[] = "entity_id is required";
        }
//        if (is_null($product->getVpn()) and is_null($product->getCopyWriteInfo())) {
//            $errors[] = "At least one attribute(vpn or copy_write_info) is needed.";
//        }

        if (!empty($errors)) {
            return  $errors;
        }
        return true;
    }

    /**
     * @param ProductInterface $product
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function buildMessage(ProductInterface $product, MessageInterface $message): MessageInterface
    {
        $productData = $message->getProduct();
        if (is_null($productData->getVpn())) {
            $message->getProduct()->setVpn($product->getData(CustomProductInterface::VPN));
        }
        if (is_null($productData->getCopyWriteInfo())) {
            $message->getProduct()->setCopyWriteInfo($product->getData(CustomProductInterface::COPY_WRITE_INFO));
        }
        return $message;
    }
}
