<?php

declare(strict_types=1);

namespace Hibit;

final class CriteriaSortField
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value();
    }

    public static function fromString(string $value): CriteriaSortField
    {
        return new CriteriaSortField($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function empty(): bool
    {
        return empty($this->value());
    }
}
