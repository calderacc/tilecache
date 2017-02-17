<?php

namespace TileCache;

class TileLayerList
{
    protected $layers = [];

    public function __construct()
    {
        $this->layers = [
            'osmde' => 'http://{a}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png'
        ];
    }

    public function layerExists(string $key): bool
    {
        return array_key_exists($key, $this->layers);
    }

    public function resolveSource(string $key, int $x, int $y, int $z): string
    {
        $a = chr(rand(97, 100));

        return str_replace(['{a}', '{x}', '{y}', '{z}'], [$a, $x, $y, $z], $this->layers[$key]);
    }
}