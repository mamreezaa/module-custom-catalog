<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Delete extends Generic
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->context->getRequestParam('id')) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to delete this product?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return  $data;
    }

    public function getDeleteUrl()
    {
        $id = $this->context->getRequestParam('id');
        return $this->getUrl('*/*/delete', ['id' => $id]);
    }
}
