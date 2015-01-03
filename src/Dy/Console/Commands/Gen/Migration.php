<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-3
 * Time: 下午3:56
 */
namespace Dy\Console\Commands\Gen;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class Migration extends Command
{
    protected function configure()
    {
        $this->setName('gen:migration')
            ->setDescription('generate a migration file')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'the name for the migration file'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // TODO:get the name from commandline
        // create a migration file using time stamp
        $currentTimestamp = date('YmdHis');
        $currentTime = date('Y-m-d H:i');

        $migrationName = $input->getArgument('name');

        if (stristr($migrationName, ' ')) {
            $output->writeln('<error>white space is not allowed in migration file name</error>');
            return;
        }

        // TODO:detect the name and generate the content

        $migrationFileName = $currentTimestamp . '_' . rtrim($migrationName, '.php') . '.php';

        $app = $this->getApplication();
        $config = $app->readConfig('migration');
        $migrationFilePath = $config['folder'] . '/' . $migrationFileName;
        $migrationFileContent = <<< EOT
<?php
/*
* Created at {$currentTime} by doubi generator
*/
use Dy\Migration\Migration;

class {$migrationName} extends Migration{

    public function up(){

    }

    public function down(){

    }
}
EOT;
        if (false === file_put_contents($migrationFilePath, $migrationFileContent)) {
            $output->writeln("<error>cant create migration file {$migrationFilePath}</error>");
        }else{
            $output->writeln("<info>migration file {$migrationFilePath} created</info>");
        }

    }
}