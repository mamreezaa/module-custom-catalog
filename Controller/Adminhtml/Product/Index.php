<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Backend\Model\View\Result\Page;
use Magento\Catalog\Controller\Adminhtml\Product;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Catalog\Controller\Adminhtml\Product\Builder;

class Index extends Product implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ounass_CustomCatalog::customcatalog_products';

    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
     * @param Context $context
     * @param Builder $productBuilder
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Builder $productBuilder,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $productBuilder);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Custom Catalog Product list page
     *
     * @return Page
     */
    public function execute(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ounass_CustomCatalog::customcatalog_products');
        $resultPage->getConfig()->getTitle()->prepend(__('Products'));
        return $resultPage;
    }
}
