<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tanah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SuratRepository;
use App\Repositories\TanahRepository;

class SuratController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id, TanahRepository $tanahRepository)
    {
        $tanah = $tanahRepository->get($id);
        if (!$tanah->registration['is_register']) {
            return view('layouts.admin.create-surat', compact('tanah'));
        }
        return "Tanah Sudah Terdaftar";
    }


    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $updated = TanahRepository::updateForSuratTanah($request->all(), $id);
        if ($updated) {
            $payloads = [
                'tanah_id' => $id,
                'tanggal_permohonan' => $request->tanggal_permohonan,
                'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
                'tanggal_pengukuran' => $request->tanggal_pengukuran,
                'nama_rt' => $request->nama_rt,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'is_hgu' => $request->is_hgu
            ];
            return SuratRepository::generateSurat($payloads);
        }
    }


    public function destroy($id)
    {
        //
    }
}
