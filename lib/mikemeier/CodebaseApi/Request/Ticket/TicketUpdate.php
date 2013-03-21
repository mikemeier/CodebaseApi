<?php

namespace mikemeier\CodebaseApi\Request\Ticket;

use mikemeier\CodebaseApi\Request\Schema;

class TicketUpdate
{
    /**
     * @var string
     */
    protected $projectName;

    /**
     * @var int
     */
    protected $ticketId;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $timeAdded;

    /**
     * @var int
     */
    protected $statusId;

    /**
     * @var int
     */
    protected $priorityId;

    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var int
     */
    protected $assigneeId;

    /**
     * @var int
     */
    protected $milestoneId;

    /**
     * @var string
     */
    protected $summary;

    /**
     * @var Schema
     */
    protected $schema;

    /**
     * @param string $projectName
     * @param int $ticketId
     * @param Schema $schema
     */
    public function __construct($projectName, $ticketId, Schema $schema = null)
    {
        $this->projectName = $projectName;
        $this->ticketId = $ticketId;
        $this->schema = $schema;
    }

    /**
     * @return int
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @param string $summary
     * @return TicketUpdate
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @param int $milestoneId
     * @return TicketUpdate
     */
    public function setMilestoneId($milestoneId)
    {
        $this->milestoneId = $milestoneId;
        return $this;
    }

    /**
     * @param int $assigneeId
     * @return TicketUpdate
     */
    public function setAssigneeId($assigneeId)
    {
        $this->assigneeId = $assigneeId;
        return $this;
    }

    /**
     * @param int $categoryId
     * @return TicketUpdate
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @param int $priorityId
     * @return TicketUpdate
     */
    public function setPriorityId($priorityId)
    {
        $this->priorityId = $priorityId;
        return $this;
    }

    /**
     * @param int $statusId
     * @return TicketUpdate
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
        return $this;
    }

    /**
     * @param int $timeAdded in minutes
     * @return TicketUpdate
     */
    public function setTimeAdded($timeAdded)
    {
        $this->timeAdded = $timeAdded;
        return $this;
    }

    /**
     * @param string $content
     * @return TicketUpdate
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getXML()
    {
        return $this->getSchema()->render(array(
            'content' => $this->content,
            'time added' => $this->timeAdded,
            'status id' => $this->statusId,
            'priority id' => $this->priorityId,
            'category id' => $this->categoryId,
            'assignee id' => $this->assigneeId,
            'milestone id' => $this->milestoneId,
            'summary' => $this->summary
        ));
    }

    /**
     * @return Schema
     */
    protected function getSchema()
    {
        return $this->schema = $this->schema ?: new Schema(__DIR__.'/Schema/TicketUpdate.xml');
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return int
     */
    public function getMilestoneId()
    {
        return $this->milestoneId;
    }

    /**
     * @return int
     */
    public function getAssigneeId()
    {
        return $this->assigneeId;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getTimeAdded()
    {
        return $this->timeAdded;
    }
}