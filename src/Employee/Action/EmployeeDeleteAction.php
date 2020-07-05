<?php

declare(strict_types=1);

namespace App\Employee\Action;

use App\Employee\Service\EmployeeService;
use App\SlimSkeleton\Actions\Action;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class EmployeeDeleteAction extends Action
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

        $this->employeeService->delete($employeeId);

        return $this->respondWithData();
    }
}
