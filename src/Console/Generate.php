<?php

declare(strict_types=1);

namespace App\Console;

use App\Domain\Repository\StorageType;
use App\Service\FileGenerator\FileGeneratorInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[
    AsCommand('generate')
]
final class Generate extends Command
{
    public function __construct(
        private readonly FileGeneratorInterface $fileGenerator,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'filepath',
                InputOption::VALUE_REQUIRED,
                'Import file path',
                'test.csv'
            )
        ;
        $this
            ->addOption(
                'rows',
                null,
                InputOption::VALUE_REQUIRED,
                'Import storage',
                30
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('filepath');
        $rowsCount = $input->getOption('rows');

        try {
            $this->fileGenerator->generate($filePath, $rowsCount);
        } catch (\Throwable $e) {
            return 0;
        }

        return 1;
    }
}
