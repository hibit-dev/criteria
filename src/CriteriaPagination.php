<?php

declare(strict_types=1);

namespace Hibit;

use Hibit\ValueObject\Limit;
use Hibit\ValueObject\Offset;

final class CriteriaPagination
{
    private Limit $limit;
    private Offset $offset;

    private function __construct(Limit $limit, Offset $offset)
    {
        $this->limit  = $limit;
        $this->offset = $offset;
    }

    public static function create(?int $limit = 0, ?int $offset = null): self
    {
        return new self(
            Limit::fromInteger(!empty($limit) ? max($limit, 1) : 0),
            Offset::fromInteger(max(($offset ?? 0), 0)),
        );
    }

    public function totalPages(int $totalItems): int
    {
        if (0 === $totalItems) {
            return 1;
        }

        return (int) ceil($totalItems / $this->limit->value());
    }

    public function page(): int
    {
        if (0 === $this->offset->value()) {
            return 1;
        }

        return (int) ceil($this->offset->value() / $this->limit->value());
    }

    public function limit(): Limit
    {
        return $this->limit;
    }

    public function offset(): Offset
    {
        return $this->offset;
    }
}
