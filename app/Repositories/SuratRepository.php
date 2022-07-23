<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Tanah;
use App\Helpers\SuratHelper;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratRepository
{

    public static function generateSurat($data)
    {
        $tanah = Tanah::find($data['tanah_id']);
        $tgl_permohonan = $data['tanggal_permohonan'];
        $tgl_surat_tugas = $data['tanggal_surat_tugas'];
        $tgl_pengukuran = $data['tanggal_pengukuran'];
        $nama_rt = $data['nama_rt'];
        $isHGU = $data['is_hgu'];
        $rt = str_pad($data['rt'], 3, '0', STR_PAD_LEFT);
        $rw = str_pad($data['rw'], 3, '0', STR_PAD_LEFT);
        if (!$tanah->registration['is_register']) {
            $template = ($isHGU == "1") ?
                new TemplateProcessor('assets/documents/spt-desa.docx') :
                new TemplateProcessor('assets/documents/spt.docx');

            $data_replace = [
                'nama' => $tanah->pemilik['nama'],
                'NAMA' => strtoupper($tanah->pemilik['nama']),
                'ttl' => $tanah->pemilik['ttl'],
                'jk' => $tanah->pemilik['jk'],
                'alamat' => $tanah->pemilik['alamat'],
                'pekerjaan' => $tanah->pemilik['pekerjaan'],
                'kewarganegaraan' => $tanah->pemilik['kewarganegaraan'] ?? 'Indonesia',
                'nama_rt' => $nama_rt,
                'NAMA_RT' => strtoupper($nama_rt),
                'rt' => $rt,
                'rw' => $rw,
                'tanggal_permohonan' => Carbon::create($tgl_permohonan)->isoFormat('D MMMM Y'),
                'tanggal_surat_tugas' => Carbon::create($tgl_surat_tugas)->isoFormat('D MMMM Y'),
                'tanggal_pengukuran' => Carbon::create($tgl_pengukuran)->isoFormat('dddd, D MMMM Y'),
                'tanggal_permohonan_berita_acara' => Carbon::create($tgl_permohonan)->isoFormat('D MMMM Y'),
                'tanggal_pengukuran_berita_acara' => SuratHelper::beritaAcaraPengukuran($tgl_pengukuran),
                'tanggal_pengukuran_berita_acara_unformat' => Carbon::create($tgl_pengukuran)->isoFormat('D MMMM Y'),
                'tahun' => date('Y'),
                'lokasi' => $tanah->letak,
                'LOKASI' => strtoupper($tanah->letak),
                'panjang' => $tanah->ukuran['panjang'],
                'lebar' => $tanah->ukuran['lebar'],
                'luas' => number_format($tanah->ukuran['luas']),
                'utara' => SuratHelper::batas($tanah->batas['utara']),
                'timur' => SuratHelper::batas($tanah->batas['timur']),
                'selatan' => SuratHelper::batas($tanah->batas['selatan']),
                'barat' => SuratHelper::batas($tanah->batas['barat']),
                'peruntukan' => $tanah->peruntukan,
                'riwayat' => $tanah->riwayat_tanah,
                'coordinates' => SuratHelper::coordinate($tanah->coordinates['data'])
            ];
            $template->setValues($data_replace);
            $pathToSave = 'assets/documents/' . $tanah->pemilik['nama']  . '-' . date('d-m-Y') . '.docx';
            $template->saveAs($pathToSave);
            return response()->download(public_path($pathToSave))->deleteFileAfterSend(true);
        }
        return "Tanah Sudah Terdaftar";
    }
}
