<?php

declare(strict_types=1);

namespace App\Service\FileImport;

use Generator;

final class FileReader
{
    public function __construct(
        public string $storageDir,
    ) {
    }

    public function getRow(string $filePath): Generator
    {
        $path = $this->storageDir . '/' . $filePath;

        $file = fopen($path, 'r');
        if(!$file) {
            throw new \Exception(sprintf('File %s not opened', $filePath));
        }

        $headers = [];
        $row = 0;
        while (($items = fgetcsv($file, 0, ';')) !== false) {

            if (0 == $row) {
                $headers = $items;
            } else {
                yield array_combine($headers, $items);
            }

            $row++;
        }

        fclose($file);
    }
}
