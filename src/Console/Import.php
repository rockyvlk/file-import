<?php

declare(strict_types=1);

namespace App\Console;

use App\Domain\Repository\StorageType;
use App\Service\FileImport\FileImporterInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[
    AsCommand('import')
]
final class Import extends Command
{
    public function __construct(
        private readonly FileImporterInterface $fileImporter,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'filepath',
                InputArgument::REQUIRED,
                'Import file path',
            )
        ;
        $this
            ->addOption(
                'to',
                null,
                InputOption::VALUE_REQUIRED,
                'Import storage',
                'mysql'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('filepath');
        $to = $input->getOption('to');

        $this->fileImporter->import(
            $filePath,
            StorageType::from($to)
        );

        return 1;
    }
}
