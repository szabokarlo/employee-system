<?php

declare(strict_types=1);

namespace Tests\Employee\Input;

use App\Employee\Input\EmployeeGetListFilterCollectionInput;
use App\Employee\Input\EmployeeGetListFilterInput;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Input\EmployeeGetListOrderByInput;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmployeeGetListInputTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testIfInvalidArgumentExceptionHasThrown(
        string $page,
        string $recordsPerPage,
        array $filters,
        array $orderBy
    ) {
        $this->expectException(InvalidArgumentException::class);

        new EmployeeGetListInput($page, $recordsPerPage, $filters, $orderBy);
    }

    public function dataProvider(): array
    {
        return [
            [
                'invalid',
                '10',
                [],
                [],
            ],
            [
                '0',
                '10',
                [],
                [],
            ],
            [
                '1',
                'invalid',
                [],
                [],
            ],
            [
                '1',
                '0',
                [],
                [],
            ],
            [
                '1',
                '21',
                [],
                [],
            ],
            [
                '1',
                '10',
                [
                    [
                        'invalid'
                    ]
                ],
                [],
            ],
            [
                '1',
                '10',
                [
                    [
                        'column' => 'invalid'
                    ]
                ],
                [],
            ],
            [
                '1',
                '10',
                [
                    [
                        'column' => 'invalid',
                        'value'  => 'value',
                    ]
                ],
                [],
            ],
            [
                '1',
                '10',
                [
                    [
                        'column' => EmployeeGetListInput::COLUMN_EMPLOYEE_NAME,
                        'value'  => 'value',
                    ]
                ],
                [
                    'invalid'
                ],
            ],
            [
                '1',
                '10',
                [
                    [
                        'column' => EmployeeGetListInput::COLUMN_EMPLOYEE_NAME,
                        'value'  => 'value',
                    ]
                ],
                [
                    'column' => 'invalid'
                ],
            ],
            [
                '1',
                '10',
                [
                    [
                        'column' => EmployeeGetListInput::COLUMN_EMPLOYEE_NAME,
                        'value'  => 'value',
                    ]
                ],
                [
                    'column'    => 'invalid',
                    'direction' => 'invalid',
                ],
            ],
            [
                '1',
                '10',
                [
                    [
                        'column' => EmployeeGetListInput::COLUMN_EMPLOYEE_NAME,
                        'value'  => 'value',
                    ]
                ],
                [
                    'column'    => EmployeeGetListInput::COLUMN_EMPLOYEE_NAME,
                    'direction' => 'invalid',
                ],
            ],
        ];
    }

    public function testGetters()
    {
        $page             = '1';
        $recordsPerPage   = '10';
        $filterColumn     = EmployeeGetListInput::COLUMN_EMPLOYEE_NAME;
        $filterValue      = 'value';
        $filters          = [
            [
                'column' => $filterColumn,
                'value'  => $filterValue,
            ]
        ];
        $orderByColumn    = EmployeeGetListInput::COLUMN_POSITION_NAME;
        $orderByDirection = 'asc';
        $orderBy          = [
            'column'    => $orderByColumn,
            'direction' => $orderByDirection,
        ];

        $filter = new EmployeeGetListFilterInput($filterColumn, $filterValue);

        $filterCollection = new EmployeeGetListFilterCollectionInput();
        $filterCollection->add($filter);

        $orderByInput = new EmployeeGetListOrderByInput($orderByColumn, $orderByDirection);

        $sut = new EmployeeGetListInput($page, $recordsPerPage, $filters, $orderBy);

        $this->assertEquals($page, $sut->getPage());
        $this->assertEquals($recordsPerPage, $sut->getRecordsPerPage());
        $this->assertEquals($filterCollection, $sut->getFilters());
        $this->assertEquals($orderByInput, $sut->getOrderBy());
    }
}
