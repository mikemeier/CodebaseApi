<?php

namespace mikemeier\CodebaseApi\Result;

use Payment\HttpClient\ResponseInterface;
use mikemeier\CodebaseApi\Exception\ContentTypeException;

abstract class AbstractResult
{
    /**
     * @param ResponseInterface $response
     * @throws ContentTypeException
     */
    public function __construct(ResponseInterface $response)
    {
        if($response->getContentType() !== "application/json"){
            throw new ContentTypeException("No JSON received");
        }
        $json = json_decode($response->getContent(), true);
        $this->process($json);
    }

    abstract protected function process(array $json);
}