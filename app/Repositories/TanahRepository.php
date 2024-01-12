<?php

namespace App\Repositories;

use App\Helpers\GeoJson;
use App\Helpers\UTMToLL;
use App\Models\Tanah;
use Carbon\Carbon;

class TanahRepository
{
    public function getAll()
    {
        $tanah = Tanah::query()->get();

        return $tanah;
    }
    public function get($id)
    {
        $tanah = Tanah::find($id);
        // $ttl = explode(",", $tanah->pemilik['ttl']);
        // $tempatLahir = $ttl[0];
        // $tglLahir = explode("-", $ttl[1]);
        // $tglLahir = $tglLahir[2] . "-" . $tglLahir[1] . "-" . $tglLahir[0];
        // $tglLahir = str_replace(" ", "", $tglLahir);
        return $tanah;
    }
    public function getGeoJsonForClient(array $column = null)
    {
        $tanah = Tanah::query()->get($column ?? '*');
        $features = [];
        foreach ($tanah as $t) {
            $latLng = []; // define variabel from store utm coordinate from database
            /**
             * get coordinate from database
             */
            foreach ($t->coordinates['data'] as $coordinate) {
                /*
            * Convert coordinate utm from database to latlng
            * and push into variabel $latLng
            */
                $latLng[] = UTMToLL::convert($coordinate['x'], $coordinate['y']);
            }

            /**
             * for polygon type, first coordinate and last coordinate must be same
             * then, push the first coordinate to variabel $latLng using value $latLng[0]
             */
            array_push($latLng, $latLng[0]);
            /**
             * make features collection in geojson
             */
            $properties = [
                'registration' => $t->registration,
            ];
            $features[] = GeoJson::setFeatures($properties, $latLng);
        }

        return GeoJson::result($features);
    }
    public function getGeoJson()
    {
        $tanah = Tanah::query()->get();
        $features = [];
        foreach ($tanah as $t) {
            $latLng = []; // define variabel from store utm coordinate from database
            /**
             * get coordinate from database
             */
            foreach ($t->coordinates['data'] as $coordinate) {
                /*
            * Convert coordinate utm from database to latlng
            * and push into variabel $latLng
            */
                $latLng[] = UTMToLL::convert($coordinate['x'], $coordinate['y']);
            }

            /**
             * for polygon type, first coordinate and last coordinate must be same
             * then, push the first coordinate to variabel $latLng using value $latLng[0]
             */
            array_push($latLng, $latLng[0]);
            /**
             * make features collection in geojson
             */
            $properties = [
                'pemilik' => $t->pemilik,
                'letak' => $t->letak,
                'ukuran' => $t->ukuran,
                'batas' => $t->batas,
                'peruntukan' => $t->peruntukan,
                'riwayat_tanah' => $t->riwayat_tanah,
                'registration' => $t->registration,
            ];
            if (!$t->registration['is_register']) $properties['id'] = $t->id;
            $features[] = GeoJson::setFeatures($properties, $latLng);
        }

        return GeoJson::result($features);
    }

    public function store(array $request)
    {
        $tglLahir = Carbon::create($request['tanggal_lahir'])->isoFormat('DD-MM-Y');
        $pemilik = [
            'nama' => $request['name'],
            'ttl' => $request['tempat_lahir'] . ', ' . $tglLahir,
            'jk' => $request['jenis_kelamin'] ?? 'tidak_tahu',
            'pekerjaan' => $request['pekerjaan'],
            'kewarganegaraan' => $request['kewarganegaraan'],
            'alamat' => $request['alamat'],
        ];
        $ukuran = [
            'panjang' => $request['panjang'],
            'lebar' => $request['lebar'],
            'luas' => $request['luas'],
        ];
        $batas = [
            'utara' => explode(',', $request['batas_utara']),
            'timur' => explode(',', $request['batas_timur']),
            'selatan' => explode(',', $request['batas_selatan']),
            'barat' => explode(',', $request['batas_barat']),
        ];
        $coordinates = [];
        foreach ($request['coordinate_x'] as $i => $x) {
            $coordinates[] = [
                'x' => $x,
                'y' => $request['coordinate_y'][$i],
            ];
        }
        $registration = [];
        if (isset($request['is_register'])) {
            $registration = [
                'is_register' => true,
                'desa' => [
                    'nomor' => $request['nomor_registrasi_desa'],
                    'tanggal' => $request['tanggal_registrasi_desa'],
                ],
                'kecamatan' => [
                    'nomor' => $request['nomor_registrasi_kecamatan'],
                    'tanggal' => $request['tanggal_registrasi_kecamatan'],
                ],
            ];
        } else {
            $registration['is_register'] = false;
        }
        $payload = [
            'pemilik' => $pemilik,
            'letak' => $request['letak'],
            'ukuran' => $ukuran,
            'batas' => $batas,
            'peruntukan' => $request['peruntukan'],
            'riwayat_tanah' => $request['riwayat'],
            'coordinates' => [
                'type' => 'UTM',
                'zone' => '49M',
                'data' => $coordinates,
            ],
            'registration' => $registration,
        ];
        $created = Tanah::create($payload);

        return $created;
    }
    public static function updateForSuratTanah(array $request, $id)
    {
        $tglLahir = Carbon::create($request['tanggal_lahir'])->isoFormat('DD-MM-Y');
        $pemilik = [
            'nama' => $request['name'],
            'ttl' => $request['tempat_lahir'] . ', ' . $tglLahir,
            'jk' => $request['jenis_kelamin'] ?? 'tidak_tahu',
            'pekerjaan' => $request['pekerjaan'],
            'kewarganegaraan' => $request['kewarganegaraan'],
            'alamat' => $request['alamat'],
        ];
        $ukuran = [
            'panjang' => $request['panjang'],
            'lebar' => $request['lebar'],
            'luas' => $request['luas'],
        ];
        $batas = [
            'utara' => explode(',', $request['batas_utara']),
            'timur' => explode(',', $request['batas_timur']),
            'selatan' => explode(',', $request['batas_selatan']),
            'barat' => explode(',', $request['batas_barat']),
        ];
        $updated = Tanah::find($id);
        $updated->pemilik = $pemilik;
        $updated->letak = $request['letak'];
        $updated->ukuran = $ukuran;
        $updated->batas = $batas;
        $updated->peruntukan = $request['peruntukan'];
        $updated->riwayat_tanah = $request['riwayat'];
        $updated->land_sketch = $request['land_sketch'];
        $updated->save();

        return $updated;
    }
}
