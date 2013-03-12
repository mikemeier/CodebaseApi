<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractResult;

class TicketStatusBag extends AbstractResult
{
    /**
     * @var TicketStatus[]
     */
    protected $status = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $status){
            $status = $status['ticketing_status'];

            $this->status[] = new TicketStatus(
                (int)$status['id'],
                $status['name'],
                $status['colour'],
                (int)$status['order'],
                $status['treat_as_closed'] === "true"
            );
        }
    }

    /**
     * @return TicketStatus[]
     */
    public function getStatus()
    {
        return $this->status;
    }
}