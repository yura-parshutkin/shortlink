<?php

use App\Repository\LinkPostgresRepository;
use App\Component\Encoder;
use App\Component\ShortLinkGenerator;
use App\Component\Postgres\SequenceGenerator;

$container['db'] = function($c) {
    $config = $c['config'];

    $params = [
        "pgsql:host={$config['host']}",
        "port={$config['port']}",
        "dbname={$config['dbname']}",
        "user={$config['user']}",
        "password={$config['pass']}"
    ];

    return new PDO(implode(';', $params));
};
$container['repository.link'] = function($c) {
    return new LinkPostgresRepository($c['db']);
};

$container['encoder.link'] = function($c) {
    return new Encoder($c['config']['encode_chars']);
};

$container['sequence.generator'] = function($c) {
    return new SequenceGenerator($c['db']);
};

$container['generator.link'] = function($c) {
    return new ShortLinkGenerator(
        $c['repository.link'],
        $c['encoder.link'],
        $c['sequence.generator']
    );
};

$container['router'] = function() {
    return new AltoRouter();
};