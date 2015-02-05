<?php

namespace Embobidon\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use \FilesystemIterator as FsIt;


/**
 * Class ClearLogsCommand
 * @author ju1ius
 */
class ClearLogsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('clear:logs')
            ->setDescription('Clears the application logs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getSilexApplication();
        
        $it = new \FilesystemIterator($app['log_dir']);

        foreach($it as $file) {
            if ($file->getFilename() === '.gitignore') {
                continue;
            }
            unlink($file->getRealPath());
        }
    }
}

