<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 下午10:00
 */

namespace Dy\Console\Commands;

use Dy\Database\DB;
use Dy\Migration\Database as MigrateDB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Drop extends Command
{
    protected function configure()
    {
        $this->setName('db:drop')
            ->setDescription('drop the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // drop the database
        $app = $this->getApplication();
        $config = $app->readConfig('database');
        $dbName = $config['database'];
        DB::setConfig($config);
        $database = new MigrateDB();
        if ($database->drop($dbName)) {
            $output->writeln('db dropped!');
        } else {
            $output->writeln('fail to drop db');
        }
    }
}