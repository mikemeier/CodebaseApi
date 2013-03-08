<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractXmlResult;

use DateTime;
use SimpleXMLElement;

class TicketBag extends AbstractXmlResult
{
    /**
     * @var Ticket[]
     */
    protected $tickets = array();

    /**
     * @param SimpleXMLElement $data
     */
    protected function process(SimpleXMLElement $data)
    {
        foreach($data as $ticket){
            $ticket = (array)$ticket;

            $category = (array)$ticket['category'];
            $priority = (array)$ticket['priority'];
            $status = (array)$ticket['status'];

            $this->tickets[] = new Ticket(
                $ticket['ticket-id'],
                $ticket['project-id'],
                $ticket['summary'],
                $ticket['ticket-type'],
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
                new DateTime($ticket['updated-at']),
                new DateTime($ticket['created-at'])
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
}