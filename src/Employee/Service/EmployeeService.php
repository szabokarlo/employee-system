<?php

declare(strict_types=1);

namespace App\Employee\Service;

use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Repository\EmployeeRepository;

class EmployeeService
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getList(EmployeeGetListInput $input): EmployeeCollection
    {
        return $this->employeeRepository->getList($input);
    }

    public function delete($id): void
    {
        $this->employeeRepository->delete($id);
    }
}
