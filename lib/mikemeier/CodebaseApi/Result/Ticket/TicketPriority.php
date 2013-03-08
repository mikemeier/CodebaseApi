<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketPriority
{
    /**
     * @var integer
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
     * @var integer
     */
    protected $position;

    /**
     * @param integer $id
     * @param string $name
     * @param string $color
     * @param bool $default
     * @param integer $position
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
     * @return integer
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
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}