<?php

namespace Tests;

use Hibit\CriteriaPagination;
use Hibit\CriteriaSort;
use Hibit\CriteriaSortField;
use Hibit\CriteriaSortDirection;

use Tests\Helpers\UserSearchCriteria;

use PHPUnit\Framework\TestCase;

final class CriteriaTest extends TestCase
{
    public function test_default_criteria(): void
    {
        $criteria = UserSearchCriteria::create(
            CriteriaPagination::create(), // Default pagination
            CriteriaSort::create('created_at')
        );

        $this->assertInstanceOf(UserSearchCriteria::class, $criteria);
        $this->assertInstanceOf(CriteriaSortField::class, $criteria->sort->field);
        $this->assertInstanceOf(CriteriaSortDirection::class, $criteria->sort->direction);

        $this->assertSame((string) $criteria->sort->field, 'created_at');
        $this->assertSame($criteria->sort->field->value(), 'created_at');
        $this->assertSame($criteria->sort->direction, CriteriaSortDirection::DESC);
        $this->assertSame($criteria->sort->direction->value(), CriteriaSortDirection::DESC->value());

        $this->assertSame($criteria->pagination->totalPages(0), 1);
        $this->assertSame($criteria->pagination->totalPages(9), 1);
        $this->assertSame($criteria->pagination->totalPages(10), 1);
        $this->assertSame($criteria->pagination->totalPages(11), 2);
    }

    public function test_criteria(): void
    {
        $criteria = UserSearchCriteria::create(
            CriteriaPagination::create(20, 25),
            CriteriaSort::create('created_at', CriteriaSortDirection::ASC),
            'John',
            'john@example.com',
        );

        $this->assertInstanceOf(UserSearchCriteria::class, $criteria);
        $this->assertInstanceOf(CriteriaSortField::class, $criteria->sort->field);
        $this->assertInstanceOf(CriteriaSortDirection::class, $criteria->sort->direction);

        $this->assertSame((string) $criteria->sort->field, 'created_at');
        $this->assertSame($criteria->sort->field->value(), 'created_at');
        $this->assertSame($criteria->sort->direction, CriteriaSortDirection::ASC);
        $this->assertSame($criteria->sort->direction->value(), CriteriaSortDirection::ASC->value());

        $this->assertSame($criteria->pagination->limit, 20);
        $this->assertSame($criteria->pagination->offset, 25);

        $this->assertSame($criteria->name, 'John');
        $this->assertSame($criteria->email, 'john@example.com');

        $this->assertSame($criteria->pagination->totalPages(0), 1);
        $this->assertSame($criteria->pagination->totalPages(19), 1);
        $this->assertSame($criteria->pagination->totalPages(20), 1);
        $this->assertSame($criteria->pagination->totalPages(21), 2);
    }
}
