<?php

namespace Ounass\CustomCatalog\Api\Data;

interface ProductInterface
{

    const ENTITY_ID = 'entity_id';
    const VPN = 'vpn';
    const COPY_WRITE_INFO = 'copy_write_info';

    /**
     * Product ID
     *
     * @return string
     */
    public function getEntityId();

    /**
     * Set product ID
     *
     * @param string $entity_id
     * @return $this
     */
    public function setEntityId($entity_id);

    /**
     * Product vpn
     *
     * @return string
     */
    public function getVpn();

    /**
     * Set product vpn
     *
     * @param string $vpn
     * @return $this
     */
    public function setVpn($vpn);

    /**
     * Product copy write info
     *
     * @return string
     */
    public function getCopyWriteInfo();

    /**
     * Set product copy write info
     *
     * @param string $copy_write_info
     * @return $this
     */
    public function setCopyWriteInfo($copy_write_info);
}
