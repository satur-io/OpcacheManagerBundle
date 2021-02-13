<?php

use Dhernandez\Tests\TestApplication\src\Kernel;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/../bootstrap.php';

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
