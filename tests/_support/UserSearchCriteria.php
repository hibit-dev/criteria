<?php

declare(strict_types=1);

namespace Tests\Helpers;

use Hibit\Criteria;
use Hibit\CriteriaPagination;
use Hibit\CriteriaSort;

final readonly class UserSearchCriteria extends Criteria
{
    public ?string $name;
    public ?string $email;

    public static function create(
        CriteriaPagination $pagination,
        CriteriaSort $sort,
        ?string $name = null,
        ?string $email = null,
    ): UserSearchCriteria {
        $criteria = new self($pagination, $sort);

        $criteria->name = $name;
        $criteria->email = $email;

        return $criteria;
    }
}