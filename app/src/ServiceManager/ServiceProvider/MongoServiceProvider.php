<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Dyln\Util\ArrayUtil;
use Interop\Container\ContainerInterface;

class MongoServiceProvider implements ServiceProviderInterface
{
    protected $config = [];

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public function register(ContainerInterface $container)
    {
        $config = $this->getConfig();
        $container['mongo.client'] = function ($container) use ($config) {
            return new \MongoClient($config['client']['host'], $config['client']['options'], $config['client']['driver_options']);
        };

        $container['mongo.database'] = function ($container) use ($config) {
            return new \MongoDB($container['mongo.client'], $config['database']['main']);
        };
    }

    private function getConfig()
    {
        $config = $this->config;
        $config['mongo'] = [
            'client'   => [
                'host'           => ArrayUtil::getIn($config, ['client', 'host'], 'mongodb://localhost:27017'),
                'options'        => ArrayUtil::getIn($config, ['client', 'options'], []),
                'driver_options' => ArrayUtil::getIn($config, ['client', 'driver_options'], []),
            ],
            'database' => [
                'main' => ArrayUtil::getIn($config, ['database', 'main'], 'maindb'),
            ],
        ];

        return $config;
    }
}