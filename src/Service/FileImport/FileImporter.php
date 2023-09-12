<?php

declare(strict_types=1);

namespace App\Service\FileImport;

use App\Domain\Repository\EventRepositoryFactory;
use App\Domain\Repository\StorageType;
use App\Domain\Event;
use App\Domain\Id;
use App\Domain\Name;
use DateTimeImmutable;

final readonly class FileImporter implements FileImporterInterface
{
    public function __construct(
        public EventRepositoryFactory $eventRepositoryFactory,
        public FileReader $fileReader,
    ) {

    }

    public function import(string $filePath, StorageType $storageType): void
    {
        $repository = $this->eventRepositoryFactory->factory($storageType);

        foreach ($this->fileReader->getRow($filePath) as $row) {
                $event = new Event(
                    new Id($row['id']),
                    new Name($row['eventName']),
                    new DateTimeImmutable($row['ctime'])
                );

                $repository->add($event);
        }
    }
}
