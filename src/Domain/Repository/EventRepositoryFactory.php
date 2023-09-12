<?php

declare(strict_types=1);

namespace App\Domain\Repository;

final readonly class EventRepositoryFactory
{
    public function __construct(
        private MysqlEventRepository $mysqlEventRepository,
        private PostgresEventRepository $postgresEventRepository,
        private RedisEventRepository $redisEventRepository,
    )
    {
    }

    public function factory(StorageType $storageType): EventRepositoryInterface
    {
        return match ($storageType) {
            StorageType::Mysql => $this->mysqlEventRepository,
            StorageType::Postgres => $this->postgresEventRepository,
            StorageType::Redis => $this->redisEventRepository,
            default => throw new \InvalidArgumentException('Incorrect storage type')
        };
    }
}
