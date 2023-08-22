<?php

declare(strict_types=1);

namespace Hibit\ValueObject;

final class Offset
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

    public static function fromInteger(int $value): Offset
    {
        return new Offset($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
