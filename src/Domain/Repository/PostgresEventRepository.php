<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Event;
use Doctrine\DBAL\Connection;

final readonly class PostgresEventRepository implements EventRepositoryInterface
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    public function add(Event $event): void
    {
        $this->connection->insert(
            'events',
            [
                'id' => $event->id,
                'name' => $event->name,
                'date' => $event->date->format('Y-m-d H:i:s'),
            ]
        );
    }
}
