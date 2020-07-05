<?php

declare(strict_types=1);

namespace App\Employee\Mapper;

use App\Employee\Domain\CurrentDepartment;

class CurrentDepartmentMapper
{
    private DepartmentMapper $departmentMapper;

    public function __construct(DepartmentMapper $departmentMapper)
    {
        $this->departmentMapper = $departmentMapper;
    }

    public function toDomain(array $data): CurrentDepartment
    {
        return new CurrentDepartment(
            $this->departmentMapper->toDomain($data),
            (string)$data['from_date'],
            (string)$data['to_date']
        );
    }
}
