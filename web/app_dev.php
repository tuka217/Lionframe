<?php

use Symfony\Component\HttpFoundation\Request;

if (!in_array(@$_SERVER['REMOTE_ADDR'], array(
    '127.0.0.1',
    '172.33.33.1',
    '::1',
))) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$request = Request::createFromGlobals();

Request::enableHttpMethodParameterOverride();

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
