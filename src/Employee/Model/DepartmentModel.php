<?php

declare(strict_types=1);

namespace App\Employee\Model;

use App\Employee\Domain\CurrentDepartment;
use App\Employee\Domain\Department;
use JsonSerializable;

class DepartmentModel implements JsonSerializable
{
    private Department $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->department->getId(),
            'name' => $this->department->getName(),
        ];
    }
}
