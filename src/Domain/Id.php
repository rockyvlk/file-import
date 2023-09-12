<?php

declare(strict_types=1);

namespace App\Domain;

use Webmozart\Assert\Assert;

final class Id
{
    private string $value;

    final public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = mb_strtolower($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
