<?php

namespace mikemeier\CodebaseApi\Result;

use mikemeier\CodebaseApi\Exception\ContentTypeException;
use Payment\HttpClient\ResponseInterface;

abstract class AbstractResult
{
    /**
     * @param ResponseInterface $response
     * @throws ContentTypeException
     */
    public function __construct(ResponseInterface $response = null)
    {
        if ($response && false !== strpos($response->getContentType(), 'application/json')) {
            $json = json_decode($response->getContent(), true);
            $this->process($json);
        }
    }

    abstract protected function process(array $json);
}