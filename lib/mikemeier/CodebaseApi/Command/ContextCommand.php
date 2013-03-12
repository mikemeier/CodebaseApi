<?php

namespace mikemeier\CodebaseApi\Command;

use mikemeier\CodebaseApi\CodebaseApi;
use mikemeier\CodebaseApi\Console\Context;

use Payment\HttpClient\BuzzClient;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ContextCommand extends AbstractContextCommand
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('mikemeier:codebase:context')
            ->addArgument('username', InputArgument::REQUIRED, 'Username for codebase API')
            ->addArgument('key', InputArgument::REQUIRED, 'Key for codebase API')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $context = new Context();
        $context->setCodebaseApi(
            new CodebaseApi(
                $input->getArgument('username'),
                $input->getArgument('key'),
                new BuzzClient()
            )
        );
        $this->setContext($context);
        $output->writeln('<info>Context saved</info>');
    }
}