<?php

declare(strict_types=1);

namespace App\Employee\Model;

use App\Employee\Domain\Employee;
use JsonSerializable;

class EmployeeModel implements JsonSerializable
{
    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'                 => $this->employee->getId(),
            'first_name'         => $this->employee->getFirstName(),
            'last_name'          => $this->employee->getLastName(),
            'gender'             => $this->employee->getGender(),
            'birth_date'         => $this->employee->getBirthDate(),
            'hire_date'          => $this->employee->getHireDate(),
            'current_department' => new CurrentDepartmentModel($this->employee->getCurrentDepartment()),
        ];
    }
}
