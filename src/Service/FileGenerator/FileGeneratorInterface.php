<?php

declare(strict_types=1);

namespace App\Service\FileGenerator;

interface FileGeneratorInterface
{
    public function generate(string $filePath, int $rowsCount): void;
}
