<?php

declare(strict_types=1);

namespace App\Employee\Model;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use JsonSerializable;

class EmployeeCollectionModel implements JsonSerializable
{
    private EmployeeCollection $employees;

    public function __construct(EmployeeCollection $employees)
    {
        $this->employees = $employees;
    }

    public function jsonSerialize(): array
    {
        $data = [];

        /** @var Employee $employee */
        foreach ($this->employees->getIterator() as $employee) {
            $data[] = new EmployeeModel($employee);
        }

        return $data;
    }
}
