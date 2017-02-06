<?php

use App\Repository\LinkPostgresRepository;

$routes      = [];
$routes['/'] = function() {
    return new \Frontend\Controller\HomepageController();
};
$routes['/api/links'] = function() {
    $repository         = new LinkPostgresRepository();
    $urlNormalizer      = new \App\Component\Url\UrlNormaliser();
    $encoder            = new \App\Component\Encoder();
    $urlValidator       = new \App\Component\Url\UrlValidator();
    $sequenceGenerator  = '';

    $shortLinkGenerator = new \App\Component\ShortLinkGenerator(
        $repository,
        $encoder,
        $urlNormalizer,
        $urlValidator,
        $sequenceGenerator
    );

    return new \Frontend\Controller\CreateLinkController($shortLinkGenerator);
};

return $routes;