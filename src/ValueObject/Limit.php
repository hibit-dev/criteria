<?php

declare(strict_types=1);

namespace Hibit\ValueObject;

final class Limit
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }

    public static function fromInteger(int $value): Limit
    {
        return new Limit($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
