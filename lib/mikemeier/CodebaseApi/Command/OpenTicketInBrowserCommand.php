<?php

namespace mikemeier\CodebaseApi\Command;

use Symfony\Component\Console\Input\InputArgument;

class OpenTicketInBrowserCommand extends AbstractContextCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('mikemeier:codebase:openticketinbrowser')
            ->addArgument('projectName', InputArgument::OPTIONAL, 'Name in URL from codebase')
            ->addArgument('ticketId', InputArgument::OPTIONAL, 'TicketId from codebase')
        ;
    }
}