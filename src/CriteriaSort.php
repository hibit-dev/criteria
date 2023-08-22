<?php

declare(strict_types=1);

namespace Hibit;

final class CriteriaSort
{
    private CriteriaSortField $field;
    private CriteriaSortDirection $direction;

    public function __construct(
        CriteriaSortField $field,
        CriteriaSortDirection $direction
    ) {
        $this->field = $field;
        $this->direction = $direction;
    }

    public function field(): CriteriaSortField
    {
        return $this->field;
    }

    public function direction(): CriteriaSortDirection
    {
        return $this->direction;
    }
}
