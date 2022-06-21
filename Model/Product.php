<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model;

use Ounass\CustomCatalog\Api\Data\ProductInterface;

class Product implements ProductInterface
{
    protected string $entity_id;
    protected string $vpn;
    protected string $copy_write_info;

    /**
     * Retrieve vpn through type instance
     *
     * @return string
     */
    public function getVpn()
    {
        return $this->vpn;
    }

    /**
     * Set product vpn
     *
     * @param string $vpn
     * @return $this
     */
    public function setVpn($vpn)
    {
        $this->vpn = $vpn;
        return $this;
    }

    /**
     * Product copy write info
     *
     * @return string
     */
    public function getCopyWriteInfo()
    {
        return $this->copy_write_info;
    }

    /**
     * Set product copy write info
     *
     * @param string $copy_write_info
     * @return $this
     */
    public function setCopyWriteInfo($copy_write_info)
    {
        $this->copy_write_info = $copy_write_info;
        return $this;
    }

    /**
     * Product ID
     *
     * @return string
     */
    public function getEntityId()
    {
        return $this->entity_id;
    }

    /**
     * Set product ID
     *
     * @param string $entity_id
     * @return $this
     */
    public function setEntityId($entity_id)
    {
        $this->entity_id = $entity_id;
        return $this;
    }
}
