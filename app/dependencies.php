<?php

declare(strict_types=1);

use App\Employee\Mapper\CurrentDepartmentMapper;
use App\Employee\Mapper\DepartmentMapper;
use App\Employee\Mapper\EmployeeMapper;
use App\Employee\Repository\EmployeeRepository;
use App\Employee\Service\EmployeeService;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $container) {
            $settings = $container->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PDO::class => function (ContainerInterface $container) {
            $settings = $container->get('settings');

            $dbSettings = $settings['db'];
            $driver     = $dbSettings['driver'];
            $host       = $dbSettings['host'];
            $port       = $dbSettings['port'];
            $database   = $dbSettings['database'];
            $username   = $dbSettings['username'];
            $password   = $dbSettings['password'];
            $charset    = $dbSettings['charset'];
            $collation  = $dbSettings['collation'];

            return new PDO(
                "$driver:host=$host;dbname=$database;port:$port;",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collation",
                    PDO::MYSQL_ATTR_LOCAL_INFILE => 1,
                ]
            );
        },
        EmployeeService::class => function (ContainerInterface $container) {
            return new EmployeeService(
                new EmployeeRepository(
                    $container->get(PDO::class),
                    new EmployeeMapper()
                )
            );
        },
    ]);
};
