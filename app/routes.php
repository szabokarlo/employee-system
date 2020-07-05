<?php

declare(strict_types=1);

use App\Employee\Action\EmployeeDeleteAction;
use App\Employee\Action\EmployeeGetListAction;
use Slim\App;

return function (App $app) {
    $app->get('/employee/get-list', EmployeeGetListAction::class);
    $app->get('/employee/{id}/delete', EmployeeDeleteAction::class);
};
