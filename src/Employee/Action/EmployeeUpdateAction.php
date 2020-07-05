<?php

declare(strict_types=1);

namespace App\Employee\Action;

use App\Employee\Domain\Employee;
use App\Employee\Service\EmployeeService;
use App\SlimSkeleton\Actions\Action;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class EmployeeUpdateAction extends Action
{
    protected EmployeeService $employeeService;

    public function __construct(LoggerInterface $logger, EmployeeService $employeeService)
    {
        parent::__construct($logger);

        $this->employeeService = $employeeService;
    }
    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    protected function action(): Response
    {
        $employeeId = (int)$this->resolveArg('id');

        $employee =  $this->employeeService->get($employeeId);

        $employee->setBirthDate('1985-02-15')
            ->setFirstName('first')
            ->setLastName('last')
            ->setGender('F')
            ->setHireDate('2020-07-10');

        $this->employeeService->update($employee);

        return $this->respondWithData();
    }
}
