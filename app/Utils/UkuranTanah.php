<?php

namespace App\Utils;

class UkuranTanah
{
    private static $panjang = null;
    private static $lebar = null;
    private static $luas = null;

    public static function panjang($panjang)
    {
        self::$panjang = $panjang;
        return new self;
    }
    public static function lebar($lebar)
    {
        self::$lebar = $lebar;
        return new self;
    }
    public static function luas($luas)
    {
        self::$luas = $luas;
        return new self;
    }

    public static function get()
    {
        return [
            'panjang' => self::$panjang,
            'lebar' => self::$lebar,
            'luas' => self::$luas
        ];
    }
}
