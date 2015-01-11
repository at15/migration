<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 下午10:24
 */

namespace Dy\Console\Commands\Db;

use Dy\Database\DB;
use Dy\Migration\Database as MigrateDB;
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
        // loop the folder and fond migration file
        $app = $this->getApplication();
        $config = $app->readConfig('migration');
        $migrationFolder = rtrim($config['folder'], '/');
        $config = $app->readConfig('database');

        DB::setConfig($config);
        $database = new MigrateDB();
        $files = $database->getMigrationFiles($migrationFolder);
        var_dump($files);

        $database->getMigrated();
        $output->writeln('<info>i want to migrate!</info>');
    }
}