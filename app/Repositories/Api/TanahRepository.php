<?php

namespace App\Repositories\Api;

use App\Models\Tanah;
use App\Utils\BatasTanah;
use App\Utils\Pemilik;
use App\Utils\UkuranTanah;

class TanahRepository
{
    public function store($request)
    {
        $pemilik = Pemilik::nama($request['nama'])->get();
        $coordinates = $request['coordinates'];
        return Tanah::create([
            'pemilik' => $pemilik,
            'coordinates' => $coordinates,
            'registration' => $request['registration'],
            'ukuran' => UkuranTanah::get(),
            'batas' => BatasTanah::get()
        ]);
    }
}
