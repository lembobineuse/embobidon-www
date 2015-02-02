<?php

namespace Embobidon\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use \FilesystemIterator as FsIt;


/**
 * Class ClearCacheCommand
 * @author ju1ius
 */
class ClearCacheCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('clear:cache')
            ->setDescription('Clears the application cache')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getSilexApplication();
        
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $app['cache_dir'],
                FsIt::KEY_AS_PATHNAME | FsIt::CURRENT_AS_FILEINFO | FsIt::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach($it as $file) {
            if ($file->getFilename() === '.gitignore') {
                continue;
            }
            if ($file->isDir()) {
                if (true !== @rmdir($file->getRealPath())) {
                    $output->writeln(sprintf(
                        '<error>%s:</error> %s',
                        'Could not delete directory',
                        $file->getPathname()
                    ));
                }
            } else {
                if (true !== @unlink($file->getRealPath())) {
                    $output->writeln(sprintf(
                        '<error>%s:</error> %s',
                        'Could not delete file',
                        $file->getPathname()
                    ));
                }
            }
        }
    }
}

