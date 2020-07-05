<?php

declare(strict_types=1);

namespace App\Employee\Mapper;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use Exception;

class EmployeeMapper
{
    private CurrentDepartmentMapper $currentDepartmentMapper;

    public function __construct(CurrentDepartmentMapper $currentDepartmentMapper)
    {
        $this->currentDepartmentMapper = $currentDepartmentMapper;
    }

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

    private function toDomain(array $employee): Employee
    {
        return new Employee(
            (int)$employee['emp_no'],
            (string)$employee['first_name'],
            (string)$employee['last_name'],
            (string)$employee['gender'],
            (string)$employee['birth_date'],
            (string)$employee['hire_date'],
            $this->currentDepartmentMapper->toDomain($employee)
        );
    }
}
