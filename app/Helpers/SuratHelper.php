<?php

namespace App\Helpers;

use Carbon\Carbon;

class SuratHelper
{

    public static function coordinate(array $coordinate)
    {
        $result = [];
        foreach ($coordinate as $i => $utm) {
            $no = ++$i;
            $result[] = "P$no = X : $utm[x] Y : $utm[y]";
        }
        return implode("<br/>", $result);
    }
    public static function batas(array $batas)
    {
        return implode("<br/>", $batas);
    }
    public static function beritaAcaraPengukuran($date)
    {
        $tahun = Carbon::create($date)->isoFormat('Y');
        $bulan = Carbon::create($date)->isoFormat('MMMM');
        $tanggal = Carbon::create($date)->isoFormat('D');
        $hari = Carbon::create($date)->isoFormat("dddd");
        return "$hari tanggal " . SuratHelper::getDateAsWord($tanggal) . " Bulan $bulan Tahun " . SuratHelper::getYearAsWord($tahun);
    }
    private static function getYearAsWord($date)
    {
        $result = null;
        switch ($date) {
            case "2020":
                $result = "Dua Ribu Dua Puluh";
                break;
            case "2021":
                $result = "Dua Ribu Dua Puluh Satu";
                break;
            case "2022":
                $result = "Dua Ribu Dua Puluh Dua";
                break;
            case "2023":
                $result = "Dua Ribu Dua Puluh Tiga";
                break;
            case "2024":
                $result = "Dua Ribu Dua Puluh Empat";
                break;
            case "2025":
                $result = "Dua Ribu Dua Puluh Lima";
                break;
        }
        return $result;
    }
    private static function getDateAsWord($date)
    {
        $result = null;
        switch ($date) {
            case "01":
                $result = "Satu";
                break;
            case "02":
                $result = "Dua";
                break;
            case "03":
                $result = "Tiga";
                break;
            case "04":
                $result = "Empat";
                break;
            case "05":
                $result = "Lima";
                break;
            case "06":
                $result = "Enam";
                break;
            case "07":
                $result = "Tujuh";
                break;
            case "08":
                $result = "Delapan";
                break;
            case "09":
                $result = "Sembilan";
                break;
            case "10":
                $result = "Sepuluh";
                break;
            case "11":
                $result = "Sebelas";
                break;
            case "12":
                $result = "Dua Belas";
                break;
            case "13":
                $result = "Tiga Belas";
                break;
            case "14":
                $result = "Empat Belas";
                break;
            case "15":
                $result = "Lima Belas";
                break;
            case "16":
                $result = "Enam Belas";
                break;
            case "17":
                $result = "Tujuh Belas";
                break;
            case "18":
                $result = "Delapan Belas";
                break;
            case "19":
                $result = "Sembilan Belas";
                break;
            case "20":
                $result = "Dua Puluh";
                break;
            case "21":
                $result = "Dua Puluh Satu";
                break;
            case "22":
                $result = "Dua Puluh Dua";
                break;
            case "23":
                $result = "Dua Puluh Tiga";
                break;
            case "24":
                $result = "Dua Puluh Empat";
                break;
            case "25":
                $result = "Dua Puluh Lima";
                break;
            case "26":
                $result = "Dua Puluh Enam";
                break;
            case "27":
                $result = "Dua Puluh Tujuh";
                break;
            case "28":
                $result = "Dua Puluh Delapan";
                break;
            case "29":
                $result = "Dua Puluh Sembilan";
                break;
            case "30":
                $result = "Tiga Puluh";
                break;
            case "31":
                $result = "Tiga Puluh Satu";
                break;
        }
        return $result;
    }
}
