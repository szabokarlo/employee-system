<?php

declare(strict_types=1);

namespace App\Employee\Input;

use Webmozart\Assert\Assert;

class EmployeeGetListInput
{
    public const PAGE             = 'page';
    public const RECORDS_PER_PAGE = 'records_per_page';
    public const FILTERS          = 'filters';
    public const ORDER_BY         = 'order_by';

    private const FILTER_COLUMN        = 'column';
    private const FILTER_VALUE         = 'value';

    public const COLUMN_EMPLOYEE_NAME   = 'employee_name';
    public const COLUMN_DEPARTMENT_NAME = 'department_name';
    public const COLUMN_POSITION_NAME   = 'position_name';

    private const MIN_PAGE             = 1;
    private const MIN_RECORDS_PER_PAGE = 1;
    private const MAX_RECORDS_PER_PAGE = 20;

    private const ORDER_BY_COLUMN    = 'column';
    private const ORDER_BY_DIRECTION = 'direction';

    private const ORDER_BY_DIRECTION_ASC  = 'asc';
    private const ORDER_BY_DIRECTION_DESC = 'desc';

    private static array $availableFilterColumns = [
        self::COLUMN_EMPLOYEE_NAME,
        self::COLUMN_DEPARTMENT_NAME,
        self::COLUMN_POSITION_NAME,
    ];

    private static array $availableOrderByColumns = [
        self::COLUMN_EMPLOYEE_NAME,
        self::COLUMN_DEPARTMENT_NAME,
        self::COLUMN_POSITION_NAME,
    ];

    private static array $availableOrderByDirections = [
        self::ORDER_BY_DIRECTION_ASC,
        self::ORDER_BY_DIRECTION_DESC,
    ];

    private int $page;
    private int $recordsPerPage;
    private EmployeeGetListFilterCollectionInput $filters;
    private ?EmployeeGetListOrderByInput $orderBy;

    public function __construct(
        string $page,
        string $recordsPerPage,
        array $filters,
        array $orderBy
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

        $this->orderBy = null;

        if (!empty($orderBy)) {
            Assert::keyExists($orderBy, self::ORDER_BY_COLUMN, 'The order by should define the column field.');
            Assert::keyExists($orderBy, self::ORDER_BY_DIRECTION, 'The order by should define the direction field.');

            Assert::inArray($orderBy[self::ORDER_BY_COLUMN], self::$availableOrderByColumns, 'Not supported order column. Got %s');
            Assert::inArray($orderBy[self::ORDER_BY_DIRECTION], self::$availableOrderByDirections, 'Not supported order direction. Got %s');

            $this->orderBy = new EmployeeGetListOrderByInput(
                $orderBy[self::ORDER_BY_COLUMN],
                $orderBy[self::ORDER_BY_DIRECTION]
            );
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

    public function getOrderBy(): ?EmployeeGetListOrderByInput
    {
        return $this->orderBy;
    }
}
