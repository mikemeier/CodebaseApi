<?php

namespace mikemeier\CodebaseApi\Command;

use mikemeier\CodebaseApi\Console\Context;
use mikemeier\CodebaseApi\Request\Ticket\TicketOptions;

use Symfony\Component\Console\Output\OutputInterface;

use LogicException;

abstract class AbstractContextCommand extends AbstractCommand
{
    /**
     * @var Context
     */
    protected static $context;

    /**
     * @return Context
     * @throws LogicException
     */
    protected function getContext()
    {
        if(!self::$context){
            throw new LogicException("First call mikemeier:codebase:context");
        }
        return self::$context;
    }

    /**
     * @param Context $context
     * @return AbstractCommand
     */
    protected function setContext(Context $context = null)
    {
        self::$context = $context;
        return $this;
    }

    /**
     * @param TicketOptions $ticketOptions
     * @param OutputInterface $output
     */
    protected function displayTickets(TicketOptions $ticketOptions, OutputInterface $output)
    {
        $context = $this->getContext();

        $context->setTicketOptions($ticketOptions);
        $this->displayTicketOptions($output);

        $tickets = $context->getCodebaseApi()->getTicketBag($context->getTicketOptions())->getTickets();
        $context->setTickets($tickets);

        foreach($tickets as $ticket){
            $output->writeln('<info>Ticket #'. $ticket->getId().'</info> - <comment>'. $ticket->getSummary().'</comment> - ('. $ticket->getStatus() .')');
        }
    }

    /**
     * @param OutputInterface $output
     */
    protected function displayTicketOptions(OutputInterface $output)
    {
        $output->writeln('<info>TicketOptions</info>');
        $output->writeln('<comment>'. $this->getContext()->getTicketOptions() .'</comment>');
    }
}