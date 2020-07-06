<?php

declare(strict_types=1);

namespace Tests\Employee\Model;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use App\Employee\Model\EmployeeCollectionModel;
use App\Employee\Model\EmployeeModel;
use ArrayIterator;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EmployeeCollectionModelTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testJsonSerialize()
    {
        $employee1 = $this->createMock(Employee::class);
        $employee2 = $this->createMock(Employee::class);

        $employees = new ArrayIterator(
            [
                $employee1,
                $employee2,
            ]
        );

        /** @var EmployeeCollection|MockObject $employeeCollection */
        $employeeCollection = $this->createMock(EmployeeCollection::class);

        $employeeCollection->expects($this->once())
            ->method('getIterator')
            ->willReturn($employees);

        $sut = new EmployeeCollectionModel($employeeCollection);

        $this->assertEquals(
            [
                new EmployeeModel($employee1),
                new EmployeeModel($employee2),
            ],
            $sut->jsonSerialize()
        );
    }
}
