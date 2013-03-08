<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketStatus
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
     * @var integer
     */
    protected $order;

    /**
     * @var bool
     */
    protected $treatAsClosed;

    /**
     * @param integer $id
     * @param string $name
     * @param string $color
     * @param integer $order
     * @param bool $treatAsClosed
     */
    public function __construct($id, $name, $color, $order, $treatAsClosed)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->order = $order;
        $this->treatAsClosed = $treatAsClosed;
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
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return boolean
     */
    public function isTreatAsClosed()
    {
        return $this->treatAsClosed;
    }
}