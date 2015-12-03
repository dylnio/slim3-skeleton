<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Interop\Container\ContainerInterface;
use League\Event\Emitter;

class EventServiceProvider implements ServiceProviderInterface
{
    protected $config = [];

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public function register(ContainerInterface $container)
    {
        $config = $this->getConfig();
        $container['events'] = function () use ($config) {
            $emitter = new Emitter();
            foreach ($config['listeners'] as $event => $eventListeners) {
                foreach ($eventListeners as $eventListener) {
                    $emitter->addListener($event, $eventListener);
                }
            }

            return $emitter;
        };
    }

    private function getConfig()
    {
        $config = $this->config;
        $config['listeners'] = isset($config['listeners']) ? $config['listeners'] : [];

        return $config;
    }
}