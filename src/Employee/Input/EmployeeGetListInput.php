<?php

declare(strict_types=1);

namespace App\Employee\Input;

use Webmozart\Assert\Assert;

class EmployeeGetListInput
{
    public const PAGE             = 'page';
    public const RECORDS_PER_PAGE = 'records_per_page';
    public const FILTERS          = 'filters';

    public const FILTER_COLUMN_EMPLOYEE_NAME   = 'employee_name';
    public const FILTER_COLUMN_DEPARTMENT_NAME = 'department_name';
    public const FILTER_COLUMN_POSITION_NAME   = 'position_name';

    private const MIN_PAGE             = 1;
    private const MIN_RECORDS_PER_PAGE = 1;
    private const MAX_RECORDS_PER_PAGE = 20;

    private const FILTER_COLUMN        = 'column';
    private const FILTER_VALUE         = 'value';

    private static array $availableFilterColumns = [
        self::FILTER_COLUMN_EMPLOYEE_NAME,
        self::FILTER_COLUMN_DEPARTMENT_NAME,
        self::FILTER_COLUMN_POSITION_NAME,
    ];

    private int $page;
    private int $recordsPerPage;
    private EmployeeGetListFilterCollectionInput $filters;

    public function __construct(
        string $page,
        string $recordsPerPage,
        array $filters
    ) {
        Assert::integerish($page, 'The page value should be integer. Got: %s');

        $page = (int) $page;
        Assert::greaterThanEq($page, self::MIN_PAGE, 'The page value should be greater than or equal with %2$s. Got: %s');

        Assert::integerish($recordsPerPage, 'The records_per_page value should be integer. Got: %s');

        $recordsPerPage = (int) $recordsPerPage;
        Assert::greaterThanEq($recordsPerPage, self::MIN_RECORDS_PER_PAGE, 'The records_per_page value should be greater than or equal with %2$s. Got: %s');
        Assert::lessThanEq($recordsPerPage, self::MAX_RECORDS_PER_PAGE, 'The records_per_page value should be less than or equal with %2$s. Got: %s');

        $filterCollection = new EmployeeGetListFilterCollectionInput();

        foreach ($filters as $filter) {
            Assert::keyExists($filter, self::FILTER_COLUMN, 'The filter should define the column field.');
            Assert::keyExists($filter, self::FILTER_VALUE, 'The filter should define the value field.');

            Assert::inArray($filter[self::FILTER_COLUMN], self::$availableFilterColumns, 'Not supported filter. Got %s');
            $filterCollection->add(new EmployeeGetListFilterInput($filter[self::FILTER_COLUMN], $filter[self::FILTER_VALUE]));
        }

        $this->page           = (int)$page;
        $this->recordsPerPage = (int)$recordsPerPage;
        $this->filters        = $filterCollection;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getRecordsPerPage(): int
    {
        return $this->recordsPerPage;
    }

    public function getFilters(): EmployeeGetListFilterCollectionInput
    {
        return $this->filters;
    }
}
