<?php

namespace mikemeier\CodebaseApi\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MyTodosCommand extends AbstractContextCommand
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('mikemeier:codebase:mytodos')
            ->addArgument('projectName', InputArgument::REQUIRED, 'Name in URL from Codebase')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $context = $this->getContext();

        $codebaseApi = $context->getCodebaseApi();
        $ticketOptions = $codebaseApi->createTicketOptions($input->getArgument('projectName'));

        $ticketOptions
            ->setAssignee($ticketOptions::ASSIGNEE_ME)
            ->setResolution($ticketOptions::RESOLUTION_OPEN)
            ->setSort($ticketOptions::SORT_PRIORITY)
            ->setOrder($ticketOptions::ORDER_DESC)
        ;

        $this->displayTickets($ticketOptions, $output);
    }
}