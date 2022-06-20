<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Save extends Generic
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'ounass_customcatalog_product_form.ounass_customcatalog_product_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'id' => $this->context->getRequestParam('id'),
                                        'store' => $this->context->getRequestParam('store'),
                                        'type' => $this->context->getRequestParam('type'),
                                        'set' => $this->context->getRequestParam('set'),
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'sort_order' => 30,
        ];
    }
}
