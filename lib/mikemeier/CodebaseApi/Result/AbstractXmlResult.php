<?php

namespace mikemeier\CodebaseApi\Result;

use mikemeier\CodebaseApi\Exception\ContentException;

use SimpleXMLElement;

abstract class AbstractXmlResult extends AbstractResult
{
    /**
     * @var SimpleXMLElement
     */
    protected $data;

    /**
     * @var string
     */
    protected $expectedContentType = 'application/xml';

    protected function setData()
    {
        if(!$this->data = @simplexml_load_string($this->getResponse()->getContent())){
            throw new ContentException("Content is not readable for simplexml");
        }
        $this->process();
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getData()
    {
        return $this->data;
    }

    abstract protected function process();
}