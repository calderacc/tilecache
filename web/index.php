<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/{z}/{x}/{y}.png', function (int $z, int $x, int $y) {
    $path = '../cache/osmde/'.$z.'/'.$x.'/';
    $filename = $path.$y.'.png';

    if (!file_exists($filename)) {
        $server = chr(rand(97, 100));

        $source = 'http://'.$server.'.tile.openstreetmap.de/tiles/osmde/'.$z.'/'.$x.'/'.$y.'.png';

        mkdir($path, 0777, true);

        $tile = file_get_contents($source);

        file_put_contents($filename, $tile);
    } else {
        $tile = file_get_contents($filename);
    }

    $response = new \Symfony\Component\HttpFoundation\Response();

    $response->setContent($tile);
    $response->headers->set('Content-type', 'image/png');

    return $response;
});

$app->run();