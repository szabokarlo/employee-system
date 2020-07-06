<?php

declare(strict_types=1);

namespace Tests\Employee\Repository;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListFilterCollectionInput;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Mapper\EmployeeMapper;
use App\Employee\Repository\EmployeeRepository;
use Exception;
use PDO;
use PDOStatement;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EmployeeRepositoryTest extends TestCase
{
    public function testGetList()
    {
        $page           = 1;
        $recordsPerPage = 20;
        $employeesData  = ['data'];

        $statement = $this->createMock(PDOStatement::class);

        $statement->expects($this->once())
            ->method('execute')
            ->with([]);

        $statement->expects($this->once())
            ->method('fetchAll')
            ->willReturn($employeesData);

        /** @var PDO|MockObject $pdo */
        $pdo = $this->createMock(PDO::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($statement);

        /** @var EmployeeCollection|MockObject $employeeCollection */
        $employeeCollection = $this->createMock(EmployeeCollection::class);

        /** @var EmployeeMapper|MockObject $mapper */
        $mapper = $this->createMock(EmployeeMapper::class);

        $mapper->expects($this->once())
            ->method('toCollection')
            ->with($employeesData)
            ->willReturn($employeeCollection);

        /** @var EmployeeGetListInput|MockObject $input */
        $input = $this->createMock(EmployeeGetListInput::class);

        $input->expects($this->once())
            ->method('getPage')
            ->willReturn($page);

        $input->expects($this->once())
            ->method('getRecordsPerPage')
            ->willReturn($recordsPerPage);

        $filters = new EmployeeGetListFilterCollectionInput();

        $input->expects($this->once())
            ->method('getFilters')
            ->willReturn($filters);

        $input->expects($this->once())
            ->method('getOrderBy')
            ->willReturn(null);

        $sut = new EmployeeRepository($pdo, $mapper);

        $sut->getList($input);
    }

    public function testGet()
    {
        $employeeId   = 10;
        $employeeData = ['data'];

        $statement = $this->createMock(PDOStatement::class);

        $statement->expects($this->once())
            ->method('execute')
            ->with([$employeeId]);

        $statement->expects($this->once())
            ->method('fetch')
            ->willReturn($employeeData);

        /** @var PDO|MockObject $pdo */
        $pdo = $this->createMock(PDO::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($statement);

        $employee = $this->createMock(Employee::class);

        /** @var EmployeeMapper|MockObject $mapper */
        $mapper = $this->createMock(EmployeeMapper::class);

        $mapper->expects($this->once())
            ->method('toDomain')
            ->with($employeeData)
            ->willReturn($employee);

        $sut = new EmployeeRepository($pdo, $mapper);

        $this->assertSame($employee, $sut->get($employeeId));
    }

    public function testIfGetThrowsExceptionWhenTheUserIsNotFound()
    {
        $employeeId = 10;

        $statement = $this->createMock(PDOStatement::class);

        $statement->expects($this->once())
            ->method('execute')
            ->with([$employeeId]);

        $statement->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        /** @var PDO|MockObject $pdo */
        $pdo = $this->createMock(PDO::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($statement);

        /** @var EmployeeMapper|MockObject $mapper */
        $mapper = $this->createMock(EmployeeMapper::class);


        $sut = new EmployeeRepository($pdo, $mapper);

        $this->expectException(Exception::class);

        $sut->get($employeeId);
    }

    public function testUpdate()
    {
        $birthDate = '1978-10-12';
        $firstName = 'firstName';
        $lastName  = 'lastName';
        $gender    = 'gender';
        $hireDate  = '1996-10-03';
        $id        = 312;

        $employee = $this->createMock(Employee::class);

        $employee->expects($this->once())
            ->method('getBirthDate')
            ->willReturn($birthDate);

        $employee->expects($this->once())
            ->method('getFirstName')
            ->willReturn($firstName);

        $employee->expects($this->once())
            ->method('getLastName')
            ->willReturn($lastName);

        $employee->expects($this->once())
            ->method('getGender')
            ->willReturn($gender);

        $employee->expects($this->once())
            ->method('getHireDate')
            ->willReturn($hireDate);

        $employee->expects($this->once())
            ->method('getId')
            ->willReturn($id);

        $statement = $this->createMock(PDOStatement::class);

        $statement->expects($this->once())
            ->method('execute')
            ->with(
                [
                    $birthDate,
                    $firstName,
                    $lastName,
                    $gender,
                    $hireDate,
                    $id
                ]
            );

        /** @var PDO|MockObject $pdo */
        $pdo = $this->createMock(PDO::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($statement);

        /** @var EmployeeMapper|MockObject $mapper */
        $mapper = $this->createMock(EmployeeMapper::class);

        $sut = new EmployeeRepository($pdo, $mapper);

        $sut->update($employee);
    }

    public function testDelete()
    {
        $id = 312;

        $statement = $this->createMock(PDOStatement::class);

        $statement->expects($this->once())
            ->method('execute')
            ->with([$id]);

        /** @var PDO|MockObject $pdo */
        $pdo = $this->createMock(PDO::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($statement);

        /** @var EmployeeMapper|MockObject $mapper */
        $mapper = $this->createMock(EmployeeMapper::class);

        $sut = new EmployeeRepository($pdo, $mapper);

        $sut->delete($id);
    }
}
