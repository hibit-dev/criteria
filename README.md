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
 
final class UserSearchCriteria extends Criteria
{
    public const PER_PAGE = 10;
 
    private ?string $email = null;
    private ?string $name = null;
 
    public static function create(
        string $email = null,
        string $name = null
    ): UserSearchCriteria {
        $criteria = new self(CriteriaPagination::create(self::PER_PAGE));
 
        if (!empty($email)) {
            $criteria->email = $email;
        }
 
        if (!empty($name)) {
            $criteria->name = $name;
        }
 
        return $criteria;
    }
 
    public function email(): ?string
    {
        return $this->email;
    }
 
    public function name(): ?string
    {
        return $this->name;
    }
}
```

Assuming the user repository already exists, the criteria usage will look like as following

```php
use Hibit\CriteriaPagination;
use Hibit\CriteriaSort;
use Hibit\CriteriaSortDirection;
 
class CriteriaTestClass
{
    public function __invoke(UserRepository $userRepository): array
    {
        // Pagination criteria: limit=10 offset=0
        $pagination = CriteriaPagination::create(10, 0);
 
        // Sorting criteria: created_at ASC
        $sorting = CriteriaSort::create('created_at', CriteriaSortDirection::ASC);
 
        // Filter criteria: name=John
        $userSearchCriteria = UserSearchCriteria::create(null, 'John');
 
        $userSearchCriteria->paginateBy($pagination)->sortBy($sorting);
 
        return $userRepository->searchByCriteria($userSearchCriteria);
    }
}
```

At the end, the criteria object is passed to the repository and applied when building the query to retrieve data. Following methods will be accessible within the repository's search function, ensuring the accurate filtering of results.

```php
// Criteria filters
$userCriteria->email();
$userCriteria->name();
 
// Criteria pagination
$userCriteria->pagination()?->limit()->value();
$userCriteria->pagination()?->offset()->value();
 
// Criteria sorting
$userCriteria->sort()?->field()->value();
$userCriteria->sort()?->field()->value();
```

Note that all values can be nullable when constructing the query within the repository.

## Documentation
You'll find instructions and full documentation on [HiBit](https://www.hibit.dev/posts/124/criteria-php-package-for-managing-criteria-pattern). It includes detailed info on how to wire and use the module.

## Security
If you discover any security related issues, please email security@hibit.dev instead of using the issue tracker.

## About HiBit
[HiBit](https://www.hibit.dev) isn't just a blog; it's your go-to space for everything related to development, IT, and the wonders of electronics. Designed for developers, IT enthusiasts, and electronics hobby lovers, HiBit is a dynamic hub that keeps you in the loop with fresh and engaging content.  

Explore a collection of articles, tutorials, and insights, encouraging a lively community where reading, commenting, discussing, and sharing experiences is not just promoted but celebrated.

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.
