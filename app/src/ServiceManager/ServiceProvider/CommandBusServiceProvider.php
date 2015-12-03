<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\CommandBus\Bus;
use Dyln\CommandBus\Command\Handler\Resolver\SimpleHandlerResolver;
use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Interop\Container\ContainerInterface;

class CommandBusServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container)
    {
        $container['commandbus'] = function ($container) {
            $handlerResolver = new SimpleHandlerResolver($container);
            $bus = new Bus([$handlerResolver], $container['events'], $container);

            return $bus;
        };
        $this->registerHandlers($container);

    }

    private function registerHandlers(ContainerInterface $container)
    {

    }

}