<?php

use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../app/bootstrap.php';

$request    = Request::createFromGlobals();
$action     = '';
$routes     = require __DIR__ . '/../app/routes.php';

/**
 * @var  Frontend\Controller\
 */
$controller = $routes[$action];
$controller
    ->handle($request)
    ->sand();



