<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractResult;

class TicketWatcherBag extends AbstractResult
{
    /**
     * @var TicketWatcher[]
     */
    protected $ticketWatchers = array();

    /**
     * @param array $json
     * @throws \Exception
     */
    protected function process(array $json)
    {
        throw new \Exception("Not implemented yet");
    }

    /**
     * @return TicketWatcher[]
     */
    public function getTicketWatchers()
    {
        return $this->ticketWatchers;
    }
}