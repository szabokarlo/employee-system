<?php

declare(strict_types=1);

namespace App\Employee\Mapper;

use App\Employee\Domain\Department;

class DepartmentMapper
{
    public function toDomain(array $data): Department
    {
        return new Department(
            (string)$data['dept_no'],
            (string)$data['dept_name']
        );
    }
}
