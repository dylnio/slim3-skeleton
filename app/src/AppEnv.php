<?php
namespace App;

class AppEnv
{
    const DEV_ENV = 'development';
    const LIVE_ENV = 'live';

    static private $placeholders = [
        'ROOT_DIR',
        'APPLICATION_ENV',
    ];

    static public function isDev()
    {
        return self::getAppEnv() === self::DEV_ENV;
    }

    static public function getAppEnv()
    {
        if (!defined('APPLICATION_ENV')) {
            define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: self::LIVE_ENV);
        }

        return APPLICATION_ENV;
    }

    static public function isLive()
    {
        return self::getAppEnv() == self::LIVE_ENV;
    }

    static public function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        if ($value && strpos($value, '{{') !== false) {
            foreach (self::$placeholders as $placeholder) {
                $value = str_replace('{{' . $placeholder . '}}', self::env($placeholder), $value);
            }
        }

        return $value;
    }
}