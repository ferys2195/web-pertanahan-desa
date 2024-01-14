<?php

namespace App\Utils;

use Carbon\Carbon;

class Pemilik
{
    private static $nama;
    private static $ttl;
    private static $jenis_kelamin;
    private static $pekerjaan;
    private static $kewarganegaraan = 'Indonesia';
    private static $alamat;
    public static function nama($nama)
    {
        self::$nama = $nama;
        return new self;
    }
    public static function ttl($tempatLahir, $tglLahir)
    {
        $tgl = Carbon::create($tglLahir)->isoFormat('DD-MM-Y');
        self::$ttl = $tempatLahir . ', ' . $tgl;
        return new self;
    }
    public static function jenis_kelamin($jenis_kelamin)
    {
        self::$jenis_kelamin = $jenis_kelamin;
        return new self;
    }
    public static function pekerjaan($pekerjaan)
    {
        self::$pekerjaan = $pekerjaan;
        return new self;
    }
    public static function kewarganegaraan($kewarganegaraan)
    {
        self::$kewarganegaraan = $kewarganegaraan;
        return new self;
    }
    public static function alamat($alamat)
    {
        self::$alamat = $alamat;
        return new self;
    }
    public static function get()
    {
        $pemilik = [
            'nama' => self::$nama,
            'ttl' => self::$ttl,
            'jk' => self::$jenis_kelamin ?? 'tidak_tahu',
            'pekerjaan' => self::$pekerjaan,
            'kewarganegaraan' => self::$kewarganegaraan,
            'alamat' => self::$alamat,
        ];
        return $pemilik;
    }
}
