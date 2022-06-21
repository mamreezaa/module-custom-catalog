<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model;

use Ounass\CustomCatalog\Api\Data\MessageInterface;
use Ounass\CustomCatalog\Api\Data\ProductInterface;

class Message implements MessageInterface
{
    private string $requestUuid;
    private \Ounass\CustomCatalog\Api\Data\ProductInterface $product;

    /**
     * Get Message request uuid
     *
     * @return string
     */
    public function getRequestUuid(): string
    {
        return  $this->requestUuid;
    }

    /**
     * Set Message request uuid
     *
     * @param string $uuid
     * @return $this
     */
    public function setRequestUuid(string $uuid)
    {
        $this->requestUuid = $uuid;
        return $this;
    }

    /**
     * Message body
     *
     * @return \Ounass\CustomCatalog\Api\Data\ProductInterface
     */
    public function getProduct()
    {
        return  $this->product;
    }

    /**
     * Set message body
     *
     * @param \Ounass\CustomCatalog\Api\Data\ProductInterface $product
     * @return $this
     */
    public function setProduct(\Ounass\CustomCatalog\Api\Data\ProductInterface $product)
    {
        $this->product = $product;
        return $this;
    }
}
