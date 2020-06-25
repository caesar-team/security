<?php

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

if ('test' !== $_SERVER['APP_ENV']) {
    throw new Exception('Only for test environment');
}

(new Dotenv(true))->load(__DIR__ . '/../.env.test');