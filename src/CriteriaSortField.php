<?php

declare(strict_types=1);

namespace Hibit;

final readonly class CriteriaSortField
{
    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }
}
