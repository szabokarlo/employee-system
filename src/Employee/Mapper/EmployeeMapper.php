<?php

declare(strict_types=1);

namespace App\Employee\Mapper;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use Exception;

class EmployeeMapper
{
    public const KEY_ID              = 'emp_no';
    public const KEY_FIRST_NAME      = 'first_name';
    public const KEY_LAST_NAME       = 'last_name';
    public const KEY_GENDER          = 'gender';
    public const KEY_BIRTH_DATE      = 'birth_date';
    public const KEY_HIRE_DATE       = 'hire_date';
    public const KEY_DEPARTMENT_NAME = 'dept_name';
    public const KEY_POSITION_NAME   = 'title';
    public const KEY_SALARY          = 'salary';


    public function toCollection(array $employees): EmployeeCollection
    {
        $employeeCollection = new EmployeeCollection();

        foreach ($employees as $employee) {
            try {
                $employeeCollection->add(
                    $this->toDomain($employee)
                );
            } catch (Exception $exception) {
                continue;
            }
        }

        return $employeeCollection;
    }

    public function toDomain(array $employee): Employee
    {
        return new Employee(
            (int)$employee[self::KEY_ID],
            (string)$employee[self::KEY_FIRST_NAME],
            (string)$employee[self::KEY_LAST_NAME],
            (string)$employee[self::KEY_GENDER],
            (string)$employee[self::KEY_BIRTH_DATE],
            (string)$employee[self::KEY_HIRE_DATE],
            (string)$employee[self::KEY_DEPARTMENT_NAME],
            (string)$employee[self::KEY_POSITION_NAME],
            (int)$employee[self::KEY_SALARY]
        );
    }
}
