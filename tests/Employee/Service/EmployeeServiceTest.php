<?php

declare(strict_types=1);

namespace Tests\Employee\Service;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Input\EmployeeUpdateInput;
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
        $birthDate = '1985-02-04';
        $firstName = 'firstName';
        $lastName  = 'lastName';
        $gender    = 'gender';
        $hireDate  = '1998-01-17';

        /** @var EmployeeUpdateInput|MockObject $input */
        $input = $this->createMock(EmployeeUpdateInput::class);

        $input->expects($this->once())
            ->method('getBirthDate')
            ->willReturn($birthDate);

        $input->expects($this->once())
            ->method('getFirstName')
            ->willReturn($firstName);

        $input->expects($this->once())
            ->method('getLastName')
            ->willReturn($lastName);

        $input->expects($this->once())
            ->method('getGender')
            ->willReturn($gender);

        $input->expects($this->once())
            ->method('getHireDate')
            ->willReturn($hireDate);

        /** @var Employee|MockObject $employee */
        $employee = $this->createMock(Employee::class);

        $employee->expects($this->once())
            ->method('setBirthDate')
            ->with($birthDate);

        $employee->expects($this->once())
            ->method('setFirstName')
            ->with($firstName);

        $employee->expects($this->once())
            ->method('setLastName')
            ->with($lastName);

        $employee->expects($this->once())
            ->method('setGender')
            ->with($gender);

        $employee->expects($this->once())
            ->method('setHireDate')
            ->with($hireDate);

        /** @var EmployeeRepository|MockObject $repository */
        $repository = $this->createMock(EmployeeRepository::class);

        $repository->expects($this->once())
            ->method('update')
            ->with($employee);

        $sut = new EmployeeService($repository);

        $sut->update($employee, $input);
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
