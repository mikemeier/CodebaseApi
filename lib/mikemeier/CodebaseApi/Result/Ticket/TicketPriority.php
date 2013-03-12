<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketPriority
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var bool
     */
    protected $default;

    /**
     * @var int
     */
    protected $position;

    /**
     * @param int $id
     * @param string $name
     * @param string $color
     * @param bool $default
     * @param int $position
     */
    public function __construct($id, $name, $color, $default, $position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->default = $default;
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getName();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
}