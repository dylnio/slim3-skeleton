<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\Session\Session;
use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Interop\Container\ContainerInterface;

class SessionServiceProvider implements ServiceProviderInterface
{

    public function register(ContainerInterface $container)
    {
        $container['session'] = function ($container) {
            return new Session();
        };
    }
}