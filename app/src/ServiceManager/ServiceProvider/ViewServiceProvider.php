<?php
namespace App\ServiceManager\ServiceProvider;

use Dyln\Slim\ServiceProvider\ServiceProviderInterface;
use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class ViewServiceProvider implements ServiceProviderInterface
{
    protected $config = [];

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public function register(ContainerInterface $container)
    {
        $config = $this->getConfig();
        $container['view'] = function ($container) use ($config) {
            $view = new Twig($config['template_path'], $config['twig']);

            // Add extensions
            $view->addExtension(new TwigExtension($container['router'], $container['request']->getUri()));
            $view->addExtension(new \Twig_Extension_Debug());

            return $view;
        };
    }

    private function getConfig()
    {
        $config = $this->config;
        $config['template_path'] = isset($config['template_path']) ? $config['template_path'] : ROOT_DIR . '/app/templates';
        $config['twig']['cache'] = isset($config['twig']['cache']) ? $config['twig']['cache'] : ROOT_DIR . '/var/cache/twig';
        $config['twig']['debug'] = isset($config['twig']['debug']) ? $config['twig']['debug'] : false;
        $config['twig']['auto_reload'] = isset($config['twig']['auto_reload']) ? $config['twig']['auto_reload'] : true;

        return $config;
    }
}