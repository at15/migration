<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 下午12:14
 */
namespace Dy\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Create extends Command
{
    protected function configure()
    {
        $this->setName('db:create')
            ->setDescription('create a database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('la la i want to create the database lalalala');
    }
}