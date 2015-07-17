<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractResult;

use DateTime;

class TicketBag extends AbstractResult implements \Countable
{
    /**
     * @var Ticket[]
     */
    protected $tickets = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $ticket){
            $ticket = $ticket['ticket'];

            $category = $ticket['category'];
            $priority = $ticket['priority'];
            $status = $ticket['status'];

            $this->tickets[] = new Ticket(
                $ticket['ticket_id'],
                $ticket['project_id'],
                $ticket['summary'],
                $ticket['ticket_type'],
                $ticket['assignee'],
                $ticket['reporter'],
                new TicketCategory(
                    (int)$category['id'],
                    $category['name']
                ),
                new TicketPriority(
                    (int)$priority['id'],
                    $priority['name'],
                    $priority['colour'],
                    $priority['default'] === "true",
                    (int)$priority['position']
                ),
                new TicketStatus(
                    (int)$status['id'],
                    $status['name'],
                    $status['colour'],
                    (int)$status['order'],
                    $status['treat-as-closed'] === "true"
                ),
                new DateTime($ticket['updated_at']),
                new DateTime($ticket['created_at'])
            );
        }
    }

    /**
     * @return Ticket[]
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @return Ticket|null
     */
    public function getFirstTicket()
    {
        return isset($this->tickets[0]) ? $this->tickets[0] : null;
    }

    /**
     * @param Ticket[] $tickets
     */
    public function setTickets(array $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getTickets());
    }
}