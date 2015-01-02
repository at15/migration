<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 下午10:24
 */

namespace Dy\Console\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate extends Command
{
    protected function configure()
    {
        $this->setName('db:migrate')
            ->setDescription('do the migration');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('i want to migrate!');
    }
}