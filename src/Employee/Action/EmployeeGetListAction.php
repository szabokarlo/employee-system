<?php

declare(strict_types=1);

namespace App\Employee\Action;

use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Model\EmployeeGetListModel;
use App\Employee\Service\EmployeeService;
use App\SlimSkeleton\Actions\Action;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class EmployeeGetListAction extends Action
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
        $page           = $this->getGetParameter(EmployeeGetListInput::PAGE, '');
        $recordsPerPage = $this->getGetParameter(EmployeeGetListInput::RECORDS_PER_PAGE, '');
        $filters        = $this->getGetParameter(EmployeeGetListInput::FILTERS, []);

        $input = new EmployeeGetListInput($page, $recordsPerPage, $filters);

        $employees = $this->employeeService->getList($input);

        return $this->respondWithData(
            new EmployeeGetListModel($employees)
        );
    }

    /**
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    protected function getGetParameter(string $parameterName, $defaultValue)
    {
        $getParams = $this->request->getQueryParams();

        return isset($getParams[$parameterName])
            ? $getParams[$parameterName]
            : $defaultValue;
    }
}
