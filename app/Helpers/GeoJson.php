<?php

namespace App\Helpers;

class GeoJson
{
    public static function setFeatures($properties, $coordinates, $type = 'Polygon')
    {
        return [
            'type' => 'Feature',
            'properties' => $properties,
            'geometry' => [
                'type' => $type,
                'coordinates' => [$coordinates],
            ],
        ];
    }

    public static function result($features)
    {
        return [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
    }
}
