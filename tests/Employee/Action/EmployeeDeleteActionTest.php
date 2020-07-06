<?php

declare(strict_types=1);

namespace Tests\Employee\Action;

use App\Employee\Service\EmployeeService;
use App\SlimSkeleton\Actions\ActionPayload;
use DI\Container;
use Exception;
use Tests\TestCase;

class EmployeeDeleteActionTest extends TestCase
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

        $employeeService = $this->createMock(EmployeeService::class);

        $employeeService->expects($this->once())
            ->method('delete')
            ->with($employeeId);

        $container->set(EmployeeService::class, $employeeService);

        $request  = $this->createRequest('DELETE', "/employee/$employeeId/delete");
        $response = $app->handle($request);

        $payload           = (string) $response->getBody();
        $expectedPayload   = new ActionPayload(200);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
