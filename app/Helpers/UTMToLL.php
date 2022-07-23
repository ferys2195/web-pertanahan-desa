<?php

namespace App\Helpers;

class UTMToLL
{
    public static function convert($x, $y)
    {
        $pointConverter = new GPointConverter();
        $pointConverter->setUTM($x, $y, 49);
        $pointConverter->convertTMtoLL();

        return [$pointConverter->Long(), $pointConverter->Lat()];
    }
}
