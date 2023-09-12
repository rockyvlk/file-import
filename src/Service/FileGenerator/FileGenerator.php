<?php

declare(strict_types=1);

namespace App\Service\FileGenerator;

use Faker\Generator;

final readonly class FileGenerator implements FileGeneratorInterface
{
    private const HEADERS = ['id','eventName','ctime'];

    public function __construct(
        private string $storageDir,
        private Generator $faker,
    ) {
    }

    public function generate(string $filePath, int $rowsCount): void
    {
        $finalFilePath = sprintf('%s/%s', $this->storageDir, $filePath);
        $file = fopen($finalFilePath, 'w');

        fputcsv($file, self::HEADERS, ";");
        for ($i = 0; $i < $rowsCount; $i++) {
            $row = [
                $this->faker->uuid,
                $this->faker->word,
                $this->faker->dateTime->format('Y-m-d H:i:s')
            ];
            fputcsv($file, $row, ";");
        }

        fclose($file);
    }
}
