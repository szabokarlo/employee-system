<?php

declare(strict_types=1);

use App\Employee\Action\EmployeeDeleteAction;
use App\Employee\Action\EmployeeGetAction;
use App\Employee\Action\EmployeeGetListAction;
use App\Employee\Action\EmployeeUpdateAction;
use Slim\App;

return function (App $app) {
    $app->get('/employee/get-list', EmployeeGetListAction::class);
    $app->get('/employee/{id}/get', EmployeeGetAction::class);
    $app->get('/employee/{id}/update', EmployeeUpdateAction::class);
    $app->delete('/employee/{id}/delete', EmployeeDeleteAction::class);
};
