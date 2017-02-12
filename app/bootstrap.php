<?php

use Pimple\Container;

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/parameters.php';

$config['encode_chars'] = [
    '0','1','2','3','4','5','6','7','8','9',
    'a','b','c','d','e','f','g','h','i','j',
    'k', 'l','m','n','o','p','q','r','s','t',
    'u','v', 'w','x','y','z','A','B','C','D',
    'E','F','G', 'H','I','J','K','L','M', 'N',
    'O','P','Q','R','S','T','U','V','W','X',
    'Y','Z'
];
$config['template_patch'] = __DIR__ . '/../src/Web/Views';

$container           = new Container();
$container['config'] = $config;

require __DIR__ . '/services.php';