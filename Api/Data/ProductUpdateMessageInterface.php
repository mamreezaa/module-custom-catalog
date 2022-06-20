<?php

namespace Ounass\CustomCatalog\Api\Data;

interface ProductUpdateMessageInterface
{

    const REQUEST_UUID = 'request_uuid';
    const BODY = 'body';

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
     * @return array
     */
    public function getBody();

    /**
     * Set message body
     *
     * @param array $body
     * @return $this
     */
    public function setBody(array $body);
}
