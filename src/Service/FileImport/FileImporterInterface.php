<?php

declare(strict_types=1);

namespace App\Service\FileImport;

use App\Domain\Repository\StorageType;

interface FileImporterInterface
{
    public function import(string $filePath, StorageType $storageType): void;
}
