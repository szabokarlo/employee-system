<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger'              => [
                'name'  => 'employee-app',
                'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            'db' => [
                'driver'    => 'mysql',
                'host'      => 'docker-mysql',
                'port'      => '3306',
                'database'  => 'employees',
                'username'  => 'root',
                'password'  => 'securedPassw0rd',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
        ]
    ]);
};
