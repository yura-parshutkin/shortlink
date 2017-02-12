<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\ValueObject\Url;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Entity\Link;

/**
 * @var Pimple\Container $container
 * @var Request $request
 */
$router = $container['router'];

$router->map('GET', '/', function() use($container) {
    $template = $container['template_path'] . '/' . 'base.html';
    return new Response(file_get_contents($template));
});

$router->map('GET', '/[a:link]', function($link) use($container) {
    /**
     * @var Link $link
     */
    if (!$link = $container['repository.link']->findOneByShortId($link)){
        throw new \Web\Exception\HttpException(404, 'Object is not found');
    }

    return new RedirectResponse($link->getUrl());
});

$router->map('POST', '/api/links',  function() use($container, $request) {
    /**
     * @var Link $link
     */
    $url  = $request->request->get('url');
    $link = $container['generator.link']->generate(Url::fromString($url));

    return new JsonResponse([
        'url' => $request->getSchemeAndHttpHost() . '/' . $link->getShortId()
    ]);
});

return $router;