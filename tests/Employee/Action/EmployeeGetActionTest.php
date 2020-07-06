<?php

declare(strict_types=1);

namespace Tests\Employee\Action;

use App\Employee\Domain\Employee;
use App\Employee\Model\EmployeeModel;
use App\Employee\Service\EmployeeService;
use App\SlimSkeleton\Actions\ActionPayload;
use DI\Container;
use Exception;
use Tests\TestCase;

class EmployeeGetActionTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testActionWorks()
    {
        $employeeId = 32131;

        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $employee = $this->createMock(Employee::class);

        $employeeService = $this->createMock(EmployeeService::class);

        $employeeService->expects($this->once())
            ->method('get')
            ->with($employeeId)
            ->willReturn($employee);

        $container->set(EmployeeService::class, $employeeService);

        $request  = $this->createRequest('GET', "/employee/$employeeId/get");
        $response = $app->handle($request);

        $payload           = (string) $response->getBody();
        $expectedPayload   = new ActionPayload(200, new EmployeeModel($employee));
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
