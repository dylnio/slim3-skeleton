<?php
use App\AppEnv;
use Dyln\Util\BooleanUtil;

return [
    'template_path' => ROOT_DIR . '/app/templates',
    'twig'          => [
        'cache'       => ROOT_DIR . '/var/cache/twig',
        'debug'       => BooleanUtil::getBool(AppEnv::env('VIEW.TWIG.DEBUG', false)),
        'auto_reload' => BooleanUtil::getBool(AppEnv::env('VIEW.TWIG.AUTO_RELOAD', true)),
    ],
];