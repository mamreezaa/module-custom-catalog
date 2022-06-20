<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\Product;

use Psr\Log\LoggerInterface;

class UpdateConsumer
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param $message
     * @return void
     */
    public function process($message)
    {
        $this->logger->info($message);
    }
}
