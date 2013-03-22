<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketNote
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var TicketUpdate[]
     */
    protected $updates;

    /**
     * @var TicketAttachment[]
     */
    protected $attachments;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @param int $id
     * @param int $userId
     * @param string $content
     * @param array $updates
     * @param array $attachments
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct($id, $userId, $content, array $updates, array $attachments, \DateTime $createdAt, \DateTime $updatedAt){
        $this->id = $id;
        $this->userId = $userId;
        $this->content = $content;
        $this->updates = $updates;
        $this->attachments = $attachments;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getContent();
    }

    /**
     * @return TicketAttachment[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return TicketUpdate[]
     */
    public function getUpdates()
    {
        return $this->updates;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
}