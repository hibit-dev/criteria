<?php

namespace Tests;

use Hibit\CriteriaSort;
use Hibit\CriteriaSortDirection;

use PHPUnit\Framework\TestCase;

final class CriteriaSortTest extends TestCase
{
    public function test_criteria_sorting_default(): void
    {
        $sort = CriteriaSort::create('created_at');

        $this->assertSame('created_at', $sort->field->value());
        $this->assertSame(CriteriaSortDirection::DESC->value(), $sort->direction->value());
    }

    public function test_criteria_sorting_asc(): void
    {
        $sort = CriteriaSort::create('created_at', CriteriaSortDirection::ASC);

        $this->assertSame('created_at', $sort->field->value());
        $this->assertSame(CriteriaSortDirection::ASC->value(), $sort->direction->value());
    }
}
