<?php

namespace TileCache;

class TileLayerList
{
    protected $layers = [];

    public function __construct()
    {
        $this->layers = [
            // Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>
            'osmde' => 'http://{a}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png',
            // Wikimedia maps beta | Map data &copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap contributors</a>
            'wikimedia-map' => 'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}.png',
            // Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>
            'stamen-toner-dark' => 'https://stamen-tiles-{a}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png',
            // Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>
            'stamen-toner-lite' => 'https://stamen-tiles-{a}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}.png',
            // Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>
            'stamen-terrain' => 'https://stamen-tiles-{a}.a.ssl.fastly.net/terrain/{z}/{x}/{y}.png',
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
