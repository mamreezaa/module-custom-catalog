<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model;

use Ounass\CustomCatalog\Api\Data\ProductUpdateMessageInterface;

class ProductUpdateMessage implements ProductUpdateMessageInterface
{
    private string $requestUuid;
    private array $body;

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
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * Set message body
     *
     * @param array $body
     * @return $this
     */
    public function setBody(array $body)
    {
        $this->body = $body;
        return $this;
    }
}
