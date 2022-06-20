<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model;

use Ounass\CustomCatalog\Api\Data\ProductInterface as OunassCustomProductInterface;

class Product extends \Magento\Catalog\Model\Product implements OunassCustomProductInterface
{
    /**
     * Retrieve vpn through type instance
     *
     * @return string
     */
    public function getVpn()
    {
        return $this->getData('vpn');
    }

    /**
     * Set product vpn
     *
     * @param string $vpn
     * @return \Magento\Catalog\Model\Product
     */
    public function setVpn($vpn)
    {
        return $this->setData(self::VPN, $vpn);
    }

    /**
     * Product copy write info
     *
     * @return string
     */
    public function getCopyWriteInfo()
    {
        return $this->getData(self::COPY_WRITE_INFO);
    }

    /**
     * Set product copy write info
     *
     * @param string $copy_write_info
     * @return $this
     */
    public function setCopyWriteInfo($copy_write_info)
    {
        return $this->setData(self::COPY_WRITE_INFO, $copy_write_info);
    }
}
