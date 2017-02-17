<?php

use TileCache\TileLayerList;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/{layer}/{z}/{x}/{y}.png', function (Silex\Application $app, string $layer, int $z, int $x, int $y)
{
    $tileLayerList = new TileLayerList();

    if (!$tileLayerList->layerExists($layer)) {
        $app->abort(404, 'Tilelayer '.$layer.' is not registered');
    }

    $path = '../cache/'.$layer.'/'.$z.'/'.$x.'/';
    $filename = $path.$y.'.png';

    if (!file_exists($filename)) {
        $source = $tileLayerList->resolveSource($layer, $x, $y, $z);

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