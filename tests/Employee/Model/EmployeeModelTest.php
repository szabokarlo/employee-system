<?php

declare(strict_types=1);

namespace Tests\Employee\Model;

use App\Employee\Domain\Employee;
use App\Employee\Model\EmployeeModel;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EmployeeModelTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testJsonSerialize()
    {
        $id          = 10;
        $firstName   = 'firstName';
        $lastName    = 'lastName';
        $gender      = 'M';
        $birthDate   = '2010-01-01';
        $hireDate    = '2011-02-14';
        $department  = 'Development';
        $position    = 'Developer';
        $salary      = 134341;

        /** @var Employee|MockObject $employee */
        $employee = $this->createMock(Employee::class);

        $employee->expects($this->once())
            ->method('getId')
            ->willReturn($id);

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
            ->method('getBirthDate')
            ->willReturn($birthDate);

        $employee->expects($this->once())
            ->method('getHireDate')
            ->willReturn($hireDate);

        $employee->expects($this->once())
            ->method('getDepartment')
            ->willReturn($department);

        $employee->expects($this->once())
            ->method('getPosition')
            ->willReturn($position);

        $employee->expects($this->once())
            ->method('getSalary')
            ->willReturn($salary);

        $sut = new EmployeeModel($employee);

        $this->assertEquals(
            [
                'id'         => $id,
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'gender'     => $gender,
                'birth_date' => $birthDate,
                'hire_date'  => $hireDate,
                'department' => $department,
                'position'   => $position,
                'salary'     => $salary,
            ],
            $sut->jsonSerialize()
        );
    }
}
