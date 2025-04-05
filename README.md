<p align="center"><img src="https://raw.githubusercontent.com/hibit-dev/criteria/master/images/preview.png" alt="A comprehensive package for managing criteria pattern in PHP projects, streamlining data filtering, sorting, and pagination with ease."></p>

# Criteria: PHP package for managing Criteria Pattern
Criteria is a framework-agnostic PHP package that allows managing criteria pattern, streamlining data filtering, sorting, and pagination with ease. By Integrating Criteria into your PHP applications developers will easily adapt to evolving filtering requirements without the need for extensive code modifications.

## Installation
Install Criteria using `composer require`:

```bash
composer require hibit-dev/criteria
```

## Usage
A specific criteria must be created for each use case. It will extend the shared domain logic contained in the abstract criteria implementation. As an illustrative example, we generated UserCriteria that will help us to filter based on name, email, both, or neither of them. Additionally, paginating and sorting the results.

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

The create() method of UserSearchCriteria takes a CriteriaPagination and CriteriaSort object as its first two parameters. These define how results should be paginated and sorted. The optional email and name parameters allow filtering results based on those fields.

Assuming the user repository already exists, the criteria usage will look like as following

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

CriteriaPagination manages pagination with a limit and offset. Use CriteriaPagination::create() to build it, specifying the limit and offset (defaults to 10 and 0). 

```php
// Pagination: limit=10 (default), offset=0
CriteriaPagination::create(),

// Pagination: limit=10 (default), offset=10
CriteriaPagination::create(null, 10),

// Pagination: limit=20, offset=0
CriteriaPagination::create(20),

// Pagination: limit=20, offset=20
CriteriaPagination::create(20, 20),
```

At the end, the criteria object is passed to the repository and applied when building the query to retrieve data. Following methods will be accessible within the repository's search function, ensuring the accurate filtering of results.

```php
// Criteria filters
$userCriteria->email;
$userCriteria->name;
 
// Criteria pagination
$userCriteria->pagination?->limit;
$userCriteria->pagination?->offset;
 
// Criteria sorting
$userCriteria->sort?->field->value();
$userCriteria->sort?->direction->value();
```

Note that all values can be nullable when constructing the query within the repository.

## Documentation
Discover a world of knowledge hosted on [HiBit website](https://www.hibit.dev). Serving as your informational hub, this resource offers clear instructions and valuable insights to explore a spectrum of articles, tutorials, stories, news, and beyond.  

You'll find detailed instructions and comprehensive documentation about this repository on:
- [Criteria: PHP package for managing Criteria Pattern](https://www.hibit.dev/posts/124/criteria-php-package-for-managing-criteria-pattern)

## Security
If you discover any security related issues, please email security@hibit.dev instead of using the issue tracker.

## About HiBit
[HiBit](https://www.hibit.dev) isn't just a blog; it's your go-to space for everything related to development, IT, and the wonders of electronics. Designed for developers, IT enthusiasts, and electronics hobby lovers, HiBit is a dynamic hub that keeps you in the loop with fresh and engaging content.  

Explore a collection of articles, tutorials, and insights, encouraging a lively community where reading, commenting, discussing, and sharing experiences is not just promoted but celebrated.

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.
