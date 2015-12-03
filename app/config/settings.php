<?php

use App\ServiceManager\ServiceProvider\CommandBusServiceProvider;
use App\ServiceManager\ServiceProvider\EventServiceProvider;
use App\ServiceManager\ServiceProvider\GenericServiceProvider;
use App\ServiceManager\ServiceProvider\LogServiceProvider;
use App\ServiceManager\ServiceProvider\SessionServiceProvider;
use App\ServiceManager\ServiceProvider\ViewServiceProvider;

return [
    'providers' => [
        new EventServiceProvider(require __DIR__ . '/params/eventlisteners.php'),
        new CommandBusServiceProvider(),
        new LogServiceProvider(require __DIR__ . '/params/log.php'),
        new SessionServiceProvider(),
        new ViewServiceProvider(),
        new GenericServiceProvider(),
    ],
];
