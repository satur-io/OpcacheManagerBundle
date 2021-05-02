<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/../vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/../.env');
} else {
    bootEnv(dirname(__DIR__).'/../.env');
}

function bootEnv(string $path, string $defaultEnv = 'dev', array $testEnvs = ['test']): void
{
    $p = $path.'.local.php';
    $env = is_file($p) ? include $p : null;
    $k = 'APP_ENV';

    if (\is_array($env) && (!isset($env[$k]) || ($_SERVER[$k] ?? $_ENV[$k] ?? $env[$k]) === $env[$k])) {
        (new Dotenv(true))->populate($env);
    } else {
        (new Dotenv(true))->loadEnv($path, $k, $defaultEnv, $testEnvs);
    }

    $_SERVER += $_ENV;

    $k = 'APP_DEBUG';
    $debug = $_SERVER[$k] ?? !\in_array($_SERVER['APP_ENV'], ['prod'], true);
    $_SERVER[$k] = $_ENV[$k] = (int) $debug || (!\is_bool($debug) && filter_var($debug, \FILTER_VALIDATE_BOOLEAN)) ? '1' : '0';
}