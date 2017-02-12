<?php

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Web\Exception\HttpException;

require __DIR__ . '/../app/bootstrap.php';

$request = Request::createFromGlobals();
$router  = require __DIR__ . '/../app/routes.php';
$match   = $router->match();

try {
    if (!$match and is_callable($match['target'])) {
        throw new HttpException(404, 'This page is not found');
    }
    $response  = call_user_func_array($match['target'], $match['params']);
} catch (HttpException $e) {
    $response = new Response($e->getMessage(), $e->getStatus());
} catch (\LogicException $e) {
    $response = new Response('Bad request', 400);
}

$response->send();