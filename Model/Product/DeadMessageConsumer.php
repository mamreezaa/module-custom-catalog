<?php
/*
 * Copyright (c) Ounass, All rights reserved.
 */

namespace Ounass\CustomCatalog\Model\Product;

use Psr\Log\LoggerInterface;
use Ounass\CustomCatalog\Api\Data\MessageInterface;

class DeadMessageConsumer
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;


    public function __construct(
        LoggerInterface $logger,
    ) {
        $this->logger = $logger;
    }

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function process(MessageInterface $message): void
    {
        try {
            $this->logger->critical("Dead message. UUID {$message->getRequestUuid()}", (array)$message->getProduct());
        } catch (\Exception $exception) {
            $this->logger->critical($exception);
        }
    }
}
