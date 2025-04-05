<?php

declare(strict_types=1);

namespace Hibit;

final readonly class CriteriaSort
{
    public CriteriaSortField $field;
    public CriteriaSortDirection $direction;

    private function __construct(CriteriaSortField $field, CriteriaSortDirection $direction)
    {
        $this->field = $field;
        $this->direction = $direction;
    }

    public static function create(string $field, CriteriaSortDirection $direction): self
    {
        return new self(
            new CriteriaSortField($field),
            $direction,
        );
    }
}
