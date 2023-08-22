<?php

declare(strict_types=1);

namespace Hibit;

final class CriteriaSort
{
    private CriteriaField $field;
    private CriteriaSortDirection $direction;

    public function __construct(CriteriaField $field, CriteriaSortDirection $direction)
    {
        $this->field = $field;
        $this->direction = $direction;
    }

    public function field(): CriteriaField
    {
        return $this->field;
    }

    public function direction(): CriteriaSortDirection
    {
        return $this->direction;
    }
}
