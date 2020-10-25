<?php


namespace Elementary\Console\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HappyDashainCommand extends Command
{
    /**
     * HappyDashainCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setName('happy-dashain');
        $this->setDescription('Outputs happy dashain messages.');
        $this->addUsage('Outputs happy dashain messages.');
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Happy Dashain!!</info>', OutputInterface::OUTPUT_PLAIN);
        return 0;
    }

}