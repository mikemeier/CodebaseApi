<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractResult;

class TicketPriorityBag extends AbstractResult
{
    /**
     * @var TicketPriority[]
     */
    protected $priorities = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $priority){
            $priority = $priority['ticketing_priority'];

            $this->priorities[] = new TicketPriority(
                (int)$priority['id'],
                $priority['name'],
                $priority['colour'],
                $priority['default'] === "true",
                (int)$priority['position']
            );
        }
    }

    /**
     * @return TicketPriority[]
     */
    public function getPriorities()
    {
        return $this->priorities;
    }
}