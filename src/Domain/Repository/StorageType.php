<?php

declare(strict_types=1);

namespace App\Domain\Repository;

enum StorageType:string
{
    case Mysql = 'mysql';
    case Postgres = 'postgres';
    case Redis = 'redis';
}
