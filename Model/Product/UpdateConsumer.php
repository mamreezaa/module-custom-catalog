<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\Product;

use Ounass\CustomCatalog\Api\Data\MessageInterface;
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
     * @param MessageInterface $message
     * @return void
     */
    public function process(MessageInterface $message): void
    {
        $this->logger->info('apple');
        $this->logger->info($message->getRequestUuid());
    }
}
