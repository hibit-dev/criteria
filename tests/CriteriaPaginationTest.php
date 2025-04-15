<?php

namespace Tests;

use Hibit\CriteriaPagination;

use PHPUnit\Framework\TestCase;

final class CriteriaPaginationTest extends TestCase
{
    public function test_criteria_default_pagination(): void
    {
        $pagination = CriteriaPagination::create(); // Default pagination

        $this->assertSame(10, $pagination->limit);
        $this->assertSame(0, $pagination->offset);

        $this->assertSame(1, $pagination->totalPages(0));
        $this->assertSame(1, $pagination->totalPages(9));
        $this->assertSame(1, $pagination->totalPages(10));
        $this->assertSame(2, $pagination->totalPages(11));
    }

    public function test_criteria_custom_pagination(): void
    {
        $pagination = CriteriaPagination::create(20, 25); // Custom pagination

        $this->assertSame(20, $pagination->limit);
        $this->assertSame(25, $pagination->offset);

        $this->assertSame(1, $pagination->totalPages(0));
        $this->assertSame(1, $pagination->totalPages(19));
        $this->assertSame(1, $pagination->totalPages(20));
        $this->assertSame(2, $pagination->totalPages(21));
    }
}
