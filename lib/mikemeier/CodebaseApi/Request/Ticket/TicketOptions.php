<?php

namespace mikemeier\CodebaseApi\Request\Ticket;

use mikemeier\CodebaseApi\Exception\MethodNotFoundException;

use DateTime;

class TicketOptions
{
    /**
     * Current assignee of the ticket
     */
    const OPTION_ASSIGNEE = 'assignee';

    /**
     * Resolution of the ticket
     */
    const OPTION_RESOLUTION = 'resolution';

    /**
     * Status of the ticket
     */
    const OPTION_STATUS = 'status';

    /**
     * Milestone of the ticket
     */
    const OPTION_MILESTONE = 'milestone';

    /**
     * Category of the ticket
     */
    const OPTION_CATEGORY = 'category';

    /**
     *  Ticket id
     */
    const OPTION_ID = 'id';

    /**
     * DateTime (day) of the last update
     */
    const OPTION_UPDATE = 'update';

    /**
     * Sorting row
     */
    const OPTION_SORT = 'sort';

    /**
     * Sorting order (asc/desc)
     */
    const OPTION_ORDER = 'order';

    /**
     * Priority of the ticket
     */
    const OPTION_PRIORITY = 'priority';

    const
        ASSIGNEE_ME = 'me';

    const
        RESOLUTION_OPEN = 'open',
        RESOLUTION_CLOSED = 'closed';

    const
        SORT_PRIORITY = 'priority',
        SORT_UPDATED_AT = 'updated_at';

    const
        ORDER_DESC = 'desc',
        ORDER_ASC = 'asc';

    const
        PRIORITY_LOW = 'low',
        PRIORITY_NORMAL = 'normal',
        PRIORITY_HIGH = 'high',
        PRIORITY_CRITICAL = 'critical';

    const
        QUERY_OPTIONS_SEPARATOR = '%20';

    /**
     * @var string
     */
    protected $projectName;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @param string $projectName
     * @param array $options
     * @throws MethodNotFoundException
     */
    public function __construct($projectName, array $options = array())
    {
        $this->projectName = $projectName;

        foreach($options as $key => $value){
            $method = 'set'. ucfirst($key);
            if(!method_exists($this, $method)){
                throw new MethodNotFoundException("Method $method not allowed in TicketOptions");
            }
            $this->$method($value);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getQuery("|");
    }

    /**
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @param $assignee
     * @return TicketOptions
     */
    public function setAssignee($assignee)
    {
        $this->options[self::OPTION_ASSIGNEE] = $this->getNormalizedAssignee($assignee);
        return $this;
    }

    /**
     * @param $assignee
     * @return string
     */
    public function getNormalizedAssignee($assignee)
    {
        return str_replace(" ", "", $assignee);
    }

    /**
     * @return TicketOptions
     */
    public function removeAssignee()
    {
        unset($this->options[self::OPTION_ASSIGNEE]);
        return $this;
    }

    /**
     * @param string $milestone
     * @return TicketOptions
     */
    public function setMilestone($milestone)
    {
        $this->options[self::OPTION_MILESTONE] = $milestone;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeMilestone()
    {
        unset($this->options[self::OPTION_MILESTONE]);
        return $this;
    }

    /**
     * @param string $category
     * @return TicketOptions
     */
    public function setCategory($category)
    {
        $this->options[self::OPTION_CATEGORY] = $category;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeCategory()
    {
        unset($this->options[self::OPTION_CATEGORY]);
        return $this;
    }

    /**
     * @param string $resultion
     * @return TicketOptions
     */
    public function setResolution($resultion)
    {
        $this->options[self::OPTION_RESOLUTION] = $resultion;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeResolution()
    {
        unset($this->options[self::OPTION_RESOLUTION]);
        return $this;
    }

    /**
     * @param string $status
     * @return TicketOptions
     */
    public function setStatus($status)
    {
        $this->options[self::OPTION_STATUS] = $status;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeStatus()
    {
        unset($this->options[self::OPTION_STATUS]);
        return $this;
    }

    /**
     * @param int $id
     * @return TicketOptions
     */
    public function setId($id)
    {
        $this->options[self::OPTION_ID] = $id;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeId()
    {
        unset($this->options[self::OPTION_ID]);
        return $this;
    }

    /**
     * @param DateTime $date
     * @return TicketOptions
     */
    public function setUpdate(DateTime $date)
    {
        $this->options[self::OPTION_UPDATE] = $date->format('Y-m-d');
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeUpdate()
    {
        unset($this->options[self::OPTION_UPDATE]);
        return $this;
    }

    /**
     * @param string $sort
     * @return TicketOptions
     */
    public function setSort($sort)
    {
        $this->options[self::OPTION_SORT] = $sort;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeSort()
    {
        unset($this->options[self::OPTION_SORT]);
        return $this;
    }

    /**
     * @param string $order
     * @return TicketOptions
     */
    public function setOrder($order)
    {
        $this->options[self::OPTION_ORDER] = $order;
        return $this;
    }

    /**
     * @param $priority
     * @return TicketOptions
     */
    public function setPriority($priority)
    {
        $this->options[self::OPTION_PRIORITY] = $priority;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removePriority()
    {
        unset($this->options[self::OPTION_PRIORITY]);
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeOrder()
    {
        unset($this->options[self::OPTION_ORDER]);
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function removeAll()
    {
        $this->options = array();
        return $this;
    }

    /**
     * @return array
     */
    public static function getPriorities()
    {
        return array(
            self::PRIORITY_LOW,
            self::PRIORITY_NORMAL,
            self::PRIORITY_HIGH,
            self::PRIORITY_CRITICAL
        );
    }

    /**
     * @param string $separator
     * @return string
     */
    public function getQuery($separator = self::QUERY_OPTIONS_SEPARATOR)
    {
        $queryPieces = array();
        foreach($this->options as $key => $value){
            $queryPieces[] = $key.':"'. $value .'"';
        }
        return implode($separator, $queryPieces);
    }
}