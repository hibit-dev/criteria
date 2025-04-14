<p align="center"><img src="https://raw.githubusercontent.com/hibit-dev/criteria/master/images/preview.png" alt="A comprehensive package for managing criteria pattern in PHP projects, streamlining data filtering, sorting, and pagination with ease."></p>

# Clean query building using Criteria
Criteria is a framework-agnostic PHP package that simplifies the use of the criteria pattern for filtering, sorting, and paginating data. It helps separate query logic from repositories, making the codebase easier to maintain and extend over time. By using Criteria, developers can handle complex querying needs without spreading filter logic across different parts of the application.

## Installation
Install Criteria using `composer require`:

```bash
composer require hibit-dev/criteria
```

## Generating criteria
A specific criteria must be created for each use case. It extends the shared domain logic found in the abstract Criteria implementation, which standardizes how filtering, sorting, and pagination are applied. This ensures that each query follows a consistent pattern while allowing flexibility for different filtering needs.

In this example, UserSearchCriteria is designed to handle filtering by name and email, while accepting CriteriaPagination and CriteriaSort to manage pagination and sorting. The static create() method builds a fully constructed criteria object.

```php
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
```

Marking the class as readonly ensures that the criteria object cannot be modified after creation, maintaining consistency and preventing unwanted changes during processing.

### Pagination
The CriteriaPagination class is responsible for managing pagination. The create() method is used to easily construct a pagination object, where you can specify the limit and offset values (defaulting to 10 and 0 if not specified).

```php
// Default Pagination: limit=10, offset=0
CriteriaPagination::create()

// Pagination: limit=10 (default), offset=10
CriteriaPagination::create(null, 10)

// Pagination: limit=20, offset=0 (default)
CriteriaPagination::create(20)

// Pagination: limit=20, offset=20
CriteriaPagination::create(20, 20)
```

The first value represents the limit (items per page), and the second value represents the offset (the starting point for the results). This approach ensures flexibility and ease of use when handling pagination in queries.

### Sorting
The CriteriaSort class manages the sorting of query results. It works with the create() method to specify the field by which to sort the results, as well as the sorting direction (ascending or descending).

```php
// Sorting: created_at DESC (default)
CriteriaSort::create('created_at')

// Sorting: created_at ASC
CriteriaSort::create('created_at', CriteriaSortDirection::ASC)
 
// Sorting: name DESC
CriteriaSort::create('name', CriteriaSortDirection::DESC)
```

This class helps maintain a consistent sorting approach throughout the application.

## Integrating Criteria
Once a custom criteria class is defined, it can be passed into the repository to filter, sort, and paginate the data accordingly. The repository is where the actual query-building happens, using the criteria object to structure the database query. This keeps the filtering, sorting, and pagination logic separate from the rest of the application, making the code cleaner and easier to maintain.

```php
use Hibit\CriteriaPagination;
use Hibit\CriteriaSort;
use Hibit\CriteriaSortDirection;
 
class UserRepository
{
    public function searchByCriteria(UserSearchCriteria $criteria): array
    {
        // Start query builder to apply filtering
 
        if ($criteria->name !== null) {
            // Apply name filter: $criteria->name
        }
 
        if ($criteria->email !== null) {
            // Apply email filter: $criteria->email
        }
 
        if ($criteria->pagination !== null) {
            // Apply limit: $criteria->pagination->limit
            // Apply offset: $criteria->pagination->offset
        }
 
        if ($criteria->sort) {
            // Apply sorting field: $criteria->sort->field->value()
            // Apply sorting direction: $criteria->sort->direction->value()
        }
 
        // Execute the query and return the results
    }
}
```

Note that all values can be nullable when constructing the query within the repository.

## Using Criteria
To use the criteria in your repository, create an instance of the criteria class with the necessary filters, pagination, and sorting. Then, pass the criteria object to the repository method, which will apply it to the query.

```php
use Hibit\CriteriaPagination;
use Hibit\CriteriaSort;
use Hibit\CriteriaSortDirection;
 
class CriteriaTestClass
{
    public function __invoke(UserRepository $userRepository): array
    {
        return $userRepository->searchByCriteria(
            UserSearchCriteria::create(
                CriteriaPagination::create(), // Default pagination
                CriteriaSort::create('created_at', CriteriaSortDirection::DESC),
                'John'
            )
        );
    }
}
```

This approach ensures that filtering, sorting, and pagination are easily maintained and reused throughout the application.

## Documentation
Discover a world of knowledge hosted on [HiBit website](https://www.hibit.dev). Serving as your informational hub, this resource offers clear instructions and valuable insights to explore a spectrum of articles, tutorials, stories, news, and beyond.  

You'll find detailed instructions and comprehensive documentation about this repository on:
- [Clean query building using Criteria](https://www.hibit.dev/posts/238/clean-query-building-using-criteria)
- [Criteria: PHP package for managing Criteria Pattern](https://www.hibit.dev/posts/124/criteria-php-package-for-managing-criteria-pattern)
- [The Repository Pattern](https://www.hibit.dev/posts/123/the-repository-pattern)

## Security
If you discover any security related issues, please email security@hibit.dev instead of using the issue tracker.

## About HiBit
[HiBit](https://www.hibit.dev) isn't just a blog; it's your go-to space for everything related to development, IT, and the wonders of electronics. Designed for developers, IT enthusiasts, and electronics hobby lovers, HiBit is a dynamic hub that keeps you in the loop with fresh and engaging content.  

Explore a collection of articles, tutorials, and insights, encouraging a lively community where reading, commenting, discussing, and sharing experiences is not just promoted but celebrated.

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.
