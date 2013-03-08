<?php

namespace mikemeier\CodebaseApi\Result;

use mikemeier\CodebaseApi\Exception\ContentException;

use SimpleXMLElement;

abstract class AbstractXmlResult extends AbstractResult
{
    /**
     * @var string
     */
    protected $expectedContentType = 'application/xml';

    protected function data()
    {
        if(!$data = @simplexml_load_string($this->getResponse()->getContent())){
            throw new ContentException("Content is not readable for simplexml");
        }
        $this->process($data);
    }

    abstract protected function process(SimpleXMLElement $data);
}