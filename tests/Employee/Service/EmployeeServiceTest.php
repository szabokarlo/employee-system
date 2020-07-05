<?php

declare(strict_types=1);

namespace Tests\Employee\Service;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Repository\EmployeeRepository;
use App\Employee\Service\EmployeeService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EmployeeServiceTest extends TestCase
{
    public function testGetList()
    {
        /** @var EmployeeGetListInput|MockObject $input */
        $input = $this->getMockBuilder(EmployeeGetListInput::class)
            ->disableOriginalConstructor()
            ->getMock();

        $employeeCollection = $this->getMockBuilder(EmployeeCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var EmployeeRepository|MockObject $repository */
        $repository = $this->getMockBuilder(EmployeeRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('getList')
            ->with($input)
            ->willReturn($employeeCollection);

        $sut = new EmployeeService($repository);

        $this->assertSame($employeeCollection, $sut->getList($input));
    }

    public function testGet()
    {
        $employeeId = 10;

        $employee = $this->getMockBuilder(Employee::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var EmployeeRepository|MockObject $repository */
        $repository = $this->getMockBuilder(EmployeeRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('get')
            ->with($employeeId)
            ->willReturn($employee);

        $sut = new EmployeeService($repository);

        $this->assertSame($employee, $sut->get($employeeId));
    }

    public function testUpdate()
    {
        /** @var Employee|MockObject $employee */
        $employee = $this->getMockBuilder(Employee::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var EmployeeRepository|MockObject $repository */
        $repository = $this->getMockBuilder(EmployeeRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('update')
            ->with($employee);

        $sut = new EmployeeService($repository);

        $sut->update($employee);
    }

    public function testDelete()
    {
        $employeeId = 232;

        /** @var EmployeeRepository|MockObject $repository */
        $repository = $this->getMockBuilder(EmployeeRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('delete')
            ->with($employeeId);

        $sut = new EmployeeService($repository);

        $sut->delete($employeeId);
    }
}
