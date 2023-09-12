<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Event;
use App\Domain\Id;

interface EventRepositoryInterface
{
    public function add(Event $event): void;
}
