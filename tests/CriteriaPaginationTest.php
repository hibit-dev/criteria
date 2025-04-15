<?php

namespace Tests;

use Hibit\CriteriaPagination;

use PHPUnit\Framework\TestCase;

final class CriteriaPaginationTest extends TestCase
{
    public function test_criteria_default_pagination(): void
    {
        $pagination = CriteriaPagination::create(); // Default pagination

        $this->assertSame($pagination->limit, 10);
        $this->assertSame($pagination->offset, 0);

        $this->assertSame($pagination->totalPages(0), 1);
        $this->assertSame($pagination->totalPages(9), 1);
        $this->assertSame($pagination->totalPages(10), 1);
        $this->assertSame($pagination->totalPages(11), 2);
    }

    public function test_criteria_custom_pagination(): void
    {
        $pagination = CriteriaPagination::create(20, 25); // Custom pagination

        $this->assertSame($pagination->limit, 20);
        $this->assertSame($pagination->offset, 25);

        $this->assertSame($pagination->totalPages(0), 1);
        $this->assertSame($pagination->totalPages(19), 1);
        $this->assertSame($pagination->totalPages(20), 1);
        $this->assertSame($pagination->totalPages(21), 2);
    }
}
