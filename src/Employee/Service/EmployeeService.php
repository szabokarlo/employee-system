<?php

declare(strict_types=1);

namespace App\Employee\Service;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Repository\EmployeeRepository;
use Exception;

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

    /**
     * @throws Exception
     */
    public function get(int $employeeId): Employee
    {
        return $this->employeeRepository->get($employeeId);
    }

    public function update(Employee $employee): void
    {
        $this->employeeRepository->update($employee);
    }

    public function delete($id): void
    {
        $this->employeeRepository->delete($id);
    }
}
