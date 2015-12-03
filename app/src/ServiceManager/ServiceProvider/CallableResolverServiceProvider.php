<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\Slim\CallableResolver;
use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Interop\Container\ContainerInterface;

class CallableResolverServiceProvider implements ServiceProviderInterface
{

    public function register(ContainerInterface $container)
    {
        $container->setAllowOverride(true);
        $container->setFactory('callableResolver',
            function ($c) {
                return new CallableResolver($c);
            }
        );
        $container->setAllowOverride(false);
    }
}