<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 下午12:14
 */
namespace Dy\Console\Commands\Db;

use Dy\Database\DB;
use Dy\Migration\Database as MigrateDB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Create extends Command
{
    protected function configure()
    {
        $this->setName('db:create')
            ->setDescription('create the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // create the database
        $app = $this->getApplication();
        $config = $app->readConfig('database');
        $dbName = $config['database'];
        DB::enableCreateMode();
        DB::reconnect($config);
        $database = new MigrateDB();
        if ($database->create($dbName)) {
            $output->writeln('db created!');
        } else {
            $output->writeln('fail to create db');
        }
    }
}