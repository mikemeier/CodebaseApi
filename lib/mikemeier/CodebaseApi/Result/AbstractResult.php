<?php

namespace mikemeier\CodebaseApi\Result;

use Payment\HttpClient\ResponseInterface;

use mikemeier\CodebaseApi\Exception\ContentTypeException;

abstract class AbstractResult
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var string
     */
    protected $expectedContentType;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->reponse = $response;
        $this->checkContentType();
        $this->setData();
    }

    /**
     * @return ResponseInterface
     */
    protected function getResponse()
    {
        return $this->reponse;
    }

    /**
     * @throws ContentTypeException
     */
    protected function checkContentType()
    {
        $expected = $this->getExpectedContentType();
        $received = $this->getResponse()->getContentType();
        if($expected !== $received) {
            throw new ContentTypeException("Expected Content-Type $expected but received $received");
        }
    }

    /**
     * @return string
     */
    protected function getExpectedContentType()
    {
        return $this->expectedContentType;
    }

    abstract protected function setData();
}