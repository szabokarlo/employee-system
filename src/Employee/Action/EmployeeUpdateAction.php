<?php

declare(strict_types=1);

namespace App\Employee\Action;

use App\Employee\Input\EmployeeUpdateInput;
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
        $input = new EmployeeUpdateInput($this->request->getParsedBody());

        $employeeId = (int)$this->resolveArg('id');

        $employee =  $this->employeeService->get($employeeId);

        $this->employeeService->update($employee, $input);

        return $this->respondWithData();
    }
}
