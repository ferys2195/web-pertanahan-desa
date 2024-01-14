<?php

namespace App\Utils;

class BatasTanah
{
    private static $utara = "";
    private static $timur = "";
    private static $selatan = "";
    private static $barat = "";

    public static function utara($utara)
    {
        self::$utara = $utara;
        return new self;
    }
    public static function timur($timur)
    {
        self::$timur = $timur;
        return new self;
    }
    public static function selatan($selatan)
    {
        self::$selatan = $selatan;
        return new self;
    }
    public static function barat($barat)
    {
        self::$barat = $barat;
        return new self;
    }
    public static function get()
    {
        return [
            'utara' => explode(',', self::$utara),
            'timur' => explode(',', self::$timur),
            'selatan' => explode(',', self::$selatan),
            'barat' => explode(',', self::$barat),
        ];
    }
}
