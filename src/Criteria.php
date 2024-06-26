<?php

declare(strict_types=1);

namespace Hibit;

abstract class Criteria
{
    private ?CriteriaPagination $pagination;
    private ?CriteriaSort $sort;

    protected function __construct(?CriteriaPagination $pagination = null, ?CriteriaSort $sort = null)
    {
        $this->pagination = ($pagination?->limit()->value() > 0) ? $pagination : null;
        $this->sort = $sort;
    }

    public function paginateBy(CriteriaPagination $pagination): static
    {
        $this->pagination = ($pagination->limit()->value() > 0) ? $pagination : null;

        return $this;
    }

    public function sortBy(CriteriaSort $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function pagination(): ?CriteriaPagination
    {
        return $this->pagination;
    }

    public function sort(): ?CriteriaSort
    {
        return $this->sort;
    }
}
