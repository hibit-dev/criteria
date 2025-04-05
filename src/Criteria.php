<?php

declare(strict_types=1);

namespace Hibit;

abstract readonly class Criteria
{
    public ?CriteriaPagination $pagination;
    public ?CriteriaSort $sort;

    protected function __construct(?CriteriaPagination $pagination = null, ?CriteriaSort $sort = null)
    {
        $this->pagination = ($pagination?->limit > 0) ? $pagination : null;
        $this->sort = $sort;
    }
}
