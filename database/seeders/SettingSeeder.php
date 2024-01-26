<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            "camat" => [
                "nama" => "Muhammad Hudzaifah",
                "nip" => ""
            ],
            "kepala_desa" => [
                "nama" => "Aan Trisakbani, S.Pd,"
            ],
            "kasi_pemerintahan" => [
                "nama" => "Nuraiti"
            ],
            "Petugas_pengukur" => [
                "nama" => "Yuniansyah"
            ],
            "pejabat_wilayah" => [
                [
                    "nama" => "Rudi",
                    "rt" => 1,
                    "rw" => 1
                ],
                [
                    "nama" => "Jainudin",
                    "rt" => 2,
                    "rw" => 1
                ],
                [
                    "nama" => "Rahmanudin",
                    "rt" => 3,
                    "rw" => 2
                ],
                [
                    "nama" => "Rosita",
                    "rt" => 4,
                    "rw" => 2
                ],
                [
                    "nama" => "GT. Tinus Lisya",
                    "rt" => 5,
                    "rw" => 2
                ]
            ],
            "mantir" => [
                [
                    "nama" => "Sarno",
                    "jabatan" => "Koordinator Mantir"
                ],
                [
                    "nama" => "Rudi Hartono",
                    "jabatan" => "Anggota Mantir"
                ],
                [
                    "nama" => "Ardiansyah",
                    "jabatan" => "Anggota Mantir"
                ]
            ]
        ];
        Setting::create(['key' => 'pejabat', 'value' => $data]);
    }
}
