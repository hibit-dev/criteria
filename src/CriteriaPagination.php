<?php

declare(strict_types=1);

namespace Hibit;

final readonly class CriteriaPagination
{
    public int $limit;
    public int $offset;
    public int $page;

    private const int DEFAULT_LIMIT = 10;

    private function __construct(int $limit, int $offset)
    {
        $this->limit  = $limit;
        $this->offset = $offset;
        $this->page = (0 === $offset) ? 1: intval(ceil($offset / $limit));
    }

    public static function create(?int $limit = self::DEFAULT_LIMIT, ?int $offset = null): self
    {
        return new self(
            !empty($limit) ? max($limit, self::DEFAULT_LIMIT) : 0,
            max(($offset ?? 0), 0),
        );
    }

    public function totalPages(int $totalItems): int
    {
        if (0 === $totalItems) {
            return 1;
        }

        return (int) ceil($totalItems / $this->limit);
    }
}
