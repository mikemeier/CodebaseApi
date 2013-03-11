<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use DateTime;

class Ticket
{
    /**
     * @var int
     */
    protected $id;

    /*
     * @var int
     */
    protected $projectId;

    /**
     * @var string
     */
    protected $summary;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $assignee;

    /**
     * @var string
     */
    protected $reporter;

    /**
     * @var TicketCategory
     */
    protected $category;

    /**
     * @var TicketPriority
     */
    protected $priority;

    /**
     * @var TicketStatus
     */
    protected $status;

    /**
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @param int $id
     * @param int $projectId
     * @param string $summary
     * @param string $type
     * @param string $assignee
     * @param string $reporter
     * @param TicketCategory $category
     * @param TicketPriority $priority
     * @param TicketStatus $status
     * @param DateTime $updatedAt
     * @param DateTime $createdAt
     */
    public function __construct(
        $id,
        $projectId,
        $summary,
        $type,
        $assignee,
        $reporter,
        TicketCategory $category,
        TicketPriority $priority,
        TicketStatus $status,
        DateTime $updatedAt,
        DateTime $createdAt
    ){
        $this->id = $id;
        $this->projectId = $projectId;
        $this->summary = $summary;
        $this->type = $type;
        $this->assignee = $assignee;
        $this->reporter = $reporter;
        $this->category = $category;
        $this->priority = $priority;
        $this->status = $status;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
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
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @return string
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @return TicketCategoryObject
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return TicketPriorityObject
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return TicketStatusObject
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}