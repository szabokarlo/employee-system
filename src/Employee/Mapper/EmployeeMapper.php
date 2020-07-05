<?php

declare(strict_types=1);

namespace App\Employee\Mapper;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use Exception;

class EmployeeMapper
{
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
            (int)$employee['emp_no'],
            (string)$employee['first_name'],
            (string)$employee['last_name'],
            (string)$employee['gender'],
            (string)$employee['birth_date'],
            (string)$employee['hire_date'],
            (string)$employee['dept_name'],
            (string)$employee['title'],
            (int)$employee['salary']
        );
    }
}
