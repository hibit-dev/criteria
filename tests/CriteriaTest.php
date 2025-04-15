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
    public function test_criteria_init(): void
    {
        $criteria = UserSearchCriteria::create(
            CriteriaPagination::create(20, 25),
            CriteriaSort::create('created_at', CriteriaSortDirection::ASC),
            'John',
            'john@example.com',
        );

        $this->assertInstanceOf(UserSearchCriteria::class, $criteria);
        $this->assertInstanceOf(CriteriaPagination::class, $criteria->pagination);
        $this->assertInstanceOf(CriteriaSort::class, $criteria->sort);
        $this->assertInstanceOf(CriteriaSortField::class, $criteria->sort->field);
        $this->assertInstanceOf(CriteriaSortDirection::class, $criteria->sort->direction);

        $this->assertSame($criteria->name, 'John');
        $this->assertSame($criteria->email, 'john@example.com');
    }
}
