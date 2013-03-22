<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketAttachment
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var int
     */
    protected $fileSize;

    /**
     * @var string
     */
    protected $url;

    /**
     * @param int $id
     * @param string $fileName
     * @param string $contentType
     * @param int $fileSize
     * @param string $url
     */
    public function __construct($id, $fileName, $contentType, $fileSize, $url)
    {
        $this->id = $id;
        $this->fileName = $fileName;
        $this->contentType = $contentType;
        $this->fileSize = $fileSize;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return int
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}