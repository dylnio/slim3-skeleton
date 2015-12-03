<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;

class LogServiceProvider implements ServiceProviderInterface
{
    protected $config = [];

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public function register(ContainerInterface $container)
    {
        $config = $this->getConfig();
        $container['logger'] = function () use ($config) {
            $logger = new Logger($config['name']);
            $logger->pushProcessor(new WebProcessor());
            $logger->pushHandler(new StreamHandler($config['path'], Logger::DEBUG));

            return $logger;
        };
    }

    private function getConfig()
    {
        $config = $this->config;
        $config['name'] = isset($config['name']) ? $config['name'] : 'App';
        $config['path'] = isset($config['path']) ? $config['path'] : sys_get_temp_dir();

        return $config;
    }
}