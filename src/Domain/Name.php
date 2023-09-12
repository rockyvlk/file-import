<?php

declare(strict_types=1);

namespace App\Domain;

use Webmozart\Assert\Assert;

final readonly class Name
{
    public function __construct(public string $value)
    {
        Assert::notEmpty($this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
