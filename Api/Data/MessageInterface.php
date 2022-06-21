<?php

namespace Ounass\CustomCatalog\Api\Data;

interface MessageInterface
{

    const REQUEST_UUID = 'request_uuid';
    const PRODUCT = 'product';

    /**
     * Store ID
     *
     * @return integer
     */
    public function getStoreId();

    /**
     * Set Store ID
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id);

    /**
     * Get Message request uuid
     *
     * @return string
     */
    public function getRequestUuid();

    /**
     * Set Message request uuid
     *
     * @param string $uuid
     * @return $this
     */
    public function setRequestUuid(string $uuid);

    /**
     * Message body
     *
     * @return \Ounass\CustomCatalog\Api\Data\ProductInterface
     */
    public function getProduct();

    /**
     * Set message body
     *
     * @param \Ounass\CustomCatalog\Api\Data\ProductInterface $product
     * @return $this
     */
    public function setProduct(\Ounass\CustomCatalog\Api\Data\ProductInterface $product);
}
