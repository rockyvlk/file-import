<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;

final readonly class Event
{
    public function __construct(
        public Id $id,
        public Name $name,
        public DateTimeImmutable $date
    ) {

    }
}
