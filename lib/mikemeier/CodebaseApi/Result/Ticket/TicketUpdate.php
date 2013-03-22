<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketUpdate
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $oldValue;

    /**
     * @var string
     */
    protected $newValue;

    /**
     * @param string $field
     * @param string $oldValue
     * @param string $newValue
     */
    public function __construct($field, $oldValue, $newValue)
    {
        $this->field = $field;
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getNewValue()
    {
        return $this->newValue;
    }

    /**
     * @return string
     */
    public function getOldValue()
    {
        return $this->oldValue;
    }
}