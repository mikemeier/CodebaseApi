<?php

namespace mikemeier\CodebaseApi\Console;

use mikemeier\CodebaseApi\CodebaseApi;
use mikemeier\CodebaseApi\Result\Ticket\Ticket;
use mikemeier\CodebaseApi\Request\Ticket\TicketOptions;

class Context
{
    /**
     * @var CodebaseApi
     */
    protected $codebaseApi;

    /**
     * @var TicketOptions
     */
    protected $ticketOptions;

    /**
     * @var Ticket[]
     */
    protected $tickets;

    /**
     * @return CodebaseApi
     */
    public function getCodebaseApi()
    {
        return $this->codebaseApi;
    }

    /**
     * @param CodebaseApi $codebaseApi
     * @return Context
     */
    public function setCodebaseApi(CodebaseApi $codebaseApi = null)
    {
        $this->codebaseApi = $codebaseApi;
        return $this;
    }

    /**
     * @return TicketOptions
     */
    public function getTicketOptions()
    {
        return $this->ticketOptions;
    }

    /**
     * @param TicketOptions $ticketOptions
     * @return Context
     */
    public function setTicketOptions($ticketOptions)
    {
        $this->ticketOptions = $ticketOptions;
        return $this;
    }

    /**
     * @return Ticket[]
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param Ticket[] $tickets
     * @return Context
     */
    public function setTickets(array $tickets)
    {
        $this->tickets = $tickets;
        return $this;
    }
}