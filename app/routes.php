<?php

declare(strict_types=1);

use App\Employee\Action\EmployeeDeleteAction;
use App\Employee\Action\EmployeeGetAction;
use App\Employee\Action\EmployeeGetListAction;
use App\Employee\Action\EmployeeUpdateAction;
use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        return $this->get('view')->render($response, 'layout.twig');
    });
    $app->get('/employee/get-list', EmployeeGetListAction::class);
    $app->get('/employee/{id}/get', EmployeeGetAction::class);
    $app->post('/employee/{id}/update', EmployeeUpdateAction::class);
    $app->delete('/employee/{id}/delete', EmployeeDeleteAction::class);
};
