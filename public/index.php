<?php

session_start();
ini_set('display_errors', true);
putenv('ROOT_DIR=' . realpath(__DIR__ . '/../'));
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', getenv('ROOT_DIR'));
}
use App\AppEnv;
use App\ServiceManager\Factory\ActionAbstractFactory;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require ROOT_DIR . '/vendor/autoload.php';

if (!AppEnv::isLive()) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}

$dotenv = new \Dotenv\Dotenv(ROOT_DIR);
$dotenv->load();

// Instantiate the app
$settings = require ROOT_DIR . '/app/config/settings.php';
$container = new RKA\ZsmSlimContainer\Container(['settings' => $settings]);

$app = new \Dyln\Slim\App($container);
$container['app'] = $app;
$app->boot();

$container->addAbstractFactory(new ActionAbstractFactory());

// Register middleware
require ROOT_DIR . '/app/config/middleware.php';

// Register routes
require ROOT_DIR . '/app/config/routes.php';

if (!defined('CONSOLE') || CONSOLE === false) {
    // Run!
    $app->run();
} else {
    return $app;
}
