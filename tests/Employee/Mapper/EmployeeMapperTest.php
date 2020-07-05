<?php

declare(strict_types=1);

namespace Tests\Employee\Mapper;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use App\Employee\Mapper\EmployeeMapper;
use PHPUnit\Framework\TestCase;

class EmployeeMapperTest extends TestCase
{
    public function testToCollection()
    {
        $id1          = 10;
        $firstName1   = 'firstName';
        $lastName1    = 'lastName';
        $gender1      = 'M';
        $birthDate1   = '2010-01-01';
        $hireDate1    = '2011-02-14';
        $department1  = 'Development';
        $position1    = 'Developer';
        $salary1      = 134341;

        $employee1 = [
            EmployeeMapper::KEY_ID              => $id1,
            EmployeeMapper::KEY_FIRST_NAME      => $firstName1,
            EmployeeMapper::KEY_LAST_NAME       => $lastName1,
            EmployeeMapper::KEY_GENDER          => $gender1,
            EmployeeMapper::KEY_BIRTH_DATE      => $birthDate1,
            EmployeeMapper::KEY_HIRE_DATE       => $hireDate1,
            EmployeeMapper::KEY_DEPARTMENT_NAME => $department1,
            EmployeeMapper::KEY_POSITION_NAME   => $position1,
            EmployeeMapper::KEY_SALARY          => $salary1,
        ];

        $id2          = 22;
        $firstName2   = 'firstName2';
        $lastName2    = 'lastName2';
        $gender2      = 'F';
        $birthDate2   = '2011-02-09';
        $hireDate2    = '2018-07-19';
        $department2  = 'Development2';
        $position2    = 'Developer2';
        $salary2      = 176451;

        $employee2 = [
            EmployeeMapper::KEY_ID              => $id2,
            EmployeeMapper::KEY_FIRST_NAME      => $firstName2,
            EmployeeMapper::KEY_LAST_NAME       => $lastName2,
            EmployeeMapper::KEY_GENDER          => $gender2,
            EmployeeMapper::KEY_BIRTH_DATE      => $birthDate2,
            EmployeeMapper::KEY_HIRE_DATE       => $hireDate2,
            EmployeeMapper::KEY_DEPARTMENT_NAME => $department2,
            EmployeeMapper::KEY_POSITION_NAME   => $position2,
            EmployeeMapper::KEY_SALARY          => $salary2,
        ];

        $employeeCollection = new EmployeeCollection();

        $employeeCollection->add(
            new Employee(
                $id1,
                $firstName1,
                $lastName1,
                $gender1,
                $birthDate1,
                $hireDate1,
                $department1,
                $position1,
                $salary1,
            )
        );

        $employeeCollection->add(
            new Employee(
                $id2,
                $firstName2,
                $lastName2,
                $gender2,
                $birthDate2,
                $hireDate2,
                $department2,
                $position2,
                $salary2,
            )
        );

        $employees = [$employee1, $employee2];

        $sut = new EmployeeMapper();

        $this->assertEquals($employeeCollection, $sut->toCollection($employees));
    }
}
