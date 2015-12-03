<?php
namespace App\Action;

use Dyln\CommandBus\Bus;
use Dyln\Session\Session;
use League\Event\Emitter;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Views\Twig;
use Zend\ServiceManager\ServiceLocatorInterface;

class BaseAction
{
    /** @var  App */
    protected $app;
    /** @var  ServiceLocatorInterface */
    protected $container;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $this->app->getContainer();
    }

    /**
     * @return Emitter
     */
    public function events()
    {
        return $this->container->get('events');
    }

    /**
     * @return Twig
     */
    public function view()
    {
        return $this->container->get('view');
    }

    /**
     * @return LoggerInterface
     */
    public function logger()
    {
        return $this->container->get('logger');
    }

    /**
     * @return Bus
     */
    public function bus()
    {
        return $this->container->get('commandbus');
    }

    /**
     * @return Session
     */
    public function session()
    {
        return $this->container->get('session');
    }
}