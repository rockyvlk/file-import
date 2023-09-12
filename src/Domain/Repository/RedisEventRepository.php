<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Event;

final readonly class RedisEventRepository implements EventRepositoryInterface
{
    public function __construct(
        private \Redis $connection,
    ) {
    }

    public function add(Event $event): void
    {
        $this->connection->hSet(
            'events',
            $event->id,
            json_encode([
                'name' => $event->name->value,
                'date' => $event->date->format('Y-m-d/m/y H:i'),
            ])
        );
    }
}
