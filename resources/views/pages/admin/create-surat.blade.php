@extends('layouts.admin-layout')
@section('title', 'Buat Surat Tanah')
@push('head')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
@endpush
@push('foot')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        // Dropzone configuration
        var myDropzone = new Dropzone(".dropzone", {
            url: "/file/post",
            paramName: "file",
            maxFilesize: 2, // MB
            maxFiles: 10,
            acceptedFiles: 'image/*',
            dictDefaultMessage: "Drag files here or click to upload.",
            clickable: true
        });
    </script>
@endpush
@section('content')
    <form action="{{ route('admin.surat.update', $tanah->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row my-3 d-flex">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-title p-3 mb-0 text-secondary">
                        Identitas Pemilik
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Nama</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $tanah->pemilik['nama'] }}"
                                    class="form-control form-control-sm" name="name" placeholder="Input nama pemilik .."
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            @php
                                if ($tanah->pemilik['ttl'] != null) {
                                    $ttl = explode(',', $tanah->pemilik['ttl']);
                                    $tglLahir = explode('-', $ttl[1]);
                                    $tglLahir = $tglLahir[2] . '-' . $tglLahir[1] . '-' . $tglLahir[0];
                                    $tglLahir = str_replace(' ', '', $tglLahir);
                                } else {
                                    $ttl = null;
                                    $tglLahir = null;
                                }
                            @endphp
                            <label class="col-md-4 col-form-label-sm">Tempat/Tgl. Lahir</label>
                            <div class="col-md-4">
                                <input type="text" value="{{ $ttl[0] ?? '' }}" class="form-control form-control-sm"
                                    name="tempat_lahir" placeholder="Tempat Lahir .." required>
                            </div>
                            <div class="col-md-4">
                                <input type="date" value="{{ $tglLahir }}" class="form-control form-control-sm"
                                    name="tanggal_lahir" placeholder="Tanggal Lahir .." required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        {{ $tanah->pemilik['jk'] == 'laki-laki' ? 'checked' : '' }} type="radio"
                                        name="jenis_kelamin" id="inlineRadio1" value="laki-laki" required>
                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        {{ $tanah->pemilik['jk'] == 'perempuan' ? 'checked' : '' }} type="radio"
                                        name="jenis_kelamin" id="inlineRadio2" value="perempuan">
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Pekerjaan</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $tanah->pemilik['pekerjaan'] }}"
                                    class="form-control form-control-sm" name="pekerjaan"
                                    placeholder="Input pekerjaan pemilik .." required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Kewarganegaraan</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $tanah->pemilik['kewarganegaraan'] }}"
                                    class="form-control form-control-sm" name="kewarganegaraan" value="Indonesia" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Alamat</label>
                            <div class="col-md-8">
                                <textarea name="alamat" id="alamat" rows="3" class="form-control form-control-sm"
                                    placeholder="Masukan Alamat Pemilik..." required>{{ $tanah->pemilik['alamat'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title p-3 mb-0 text-secondary">Identitas Tanah</div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Letak</label>
                            <div class="col-md-8">
                                <textarea name="letak" id="alamat" rows="3" class="form-control form-control-sm"
                                    placeholder="Masukan Lokasi Tanah..." required>{{ $tanah->letak }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Ukuran</label>
                            <div class="col-md-8">
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Panjang</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm">
                                            <input type="text" value="{{ $tanah->ukuran['panjang'] ?? '' }}"
                                                name="panjang" class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x" required>
                                            <span class="input-group-text" id="input-coordinate-x">m</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Lebar</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm">
                                            <input type="text" value="{{ $tanah->ukuran['lebar'] ?? '' }}"
                                                name="lebar" class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x" required>
                                            <span class="input-group-text" id="input-coordinate-x">m</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Luas</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm">
                                            <input type="number" value="{{ $tanah->ukuran['luas'] ?? '' }}"
                                                name="luas" class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x" required>
                                            <span class="input-group-text" id="input-coordinate-x">m<sup>2</sup></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Batas-batas</label>
                            <div class="col-md-8">
                                <small class="text-info my-2 d-block"><i class="bi bi-info-circle-fill"></i> Jika
                                    berbatasan lebih dari satu, pisahkan dengan koma</small>
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Utara</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{ implode(',', $tanah->batas['utara']) }}"
                                            name="batas_utara" class="form-control form-control-sm"
                                            aria-describedby="input-coordinate-x" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Timur</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{ implode(',', $tanah->batas['timur']) }}"
                                            name="batas_timur" class="form-control form-control-sm"
                                            aria-describedby="input-coordinate-x" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Selatan</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{ implode(',', $tanah->batas['selatan']) }}"
                                            name="batas_selatan" class="form-control form-control-sm"
                                            aria-describedby="input-coordinate-x" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-md-3 col-form-label-sm">Barat</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{ implode(',', $tanah->batas['barat']) }}"
                                            name="batas_barat" class="form-control form-control-sm"
                                            aria-describedby="input-coordinate-x" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Peruntukan</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $tanah->peruntukan }}" name="peruntukan"
                                    class="form-control form-control-sm" placeholder="Misal : Rumah, Perkebunan, dll"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Riwayat Tanah</label>
                            <div class="col-md-8">
                                <textarea name="riwayat" id="alamat" rows="7" class="form-control form-control-sm"
                                    placeholder="Masukan Riwayat Tanah..." required>{{ $tanah->riwayat_tanah }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Gambar Tanah</label>
                            <div class="col-md-8">
                                {{-- <div class="dropzone dz-clickable dz-default dz-message text-center">
                                    <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                </div> --}}
                                <input type="file" name="file" id="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-title p-3 mb-0 text-secondary">Lainnya</div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Tanggal Permohonan</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="tanggal_permohonan"
                                    id="tanggal-permohonan" placeholder="Example input placeholder" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Tanggal Surat Tugas</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="tanggal_surat_tugas"
                                    id="tanggal-surat-tugas" placeholder="Another input placeholder" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Tanggal Pengukuran</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="tanggal_pengukuran"
                                    id="tanggal-pengukuran" placeholder="Another input placeholder" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Wilayah RT/RW</label>
                            <div class="col-md-8">
                                <select name="rt" class="form-select form-select-sm">
                                    <option value="">Pilih Wilayah</option>
                                    @foreach ($pejabat->value->pejabat_wilayah as $pw)
                                        <option value="{{ $pw->rt }}">
                                            {{ 'RT.' . str_pad($pw->rt, 3, '0', STR_PAD_LEFT) . '/RW.' . str_pad($pw->rw, 3, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3 d-flex align-items-center">
                            <label class="col-md-4 col-form-label-sm">Apakah Tanah Masuk Zona HGU ?</label>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_hgu" type="radio" value="1"
                                        required>
                                    <label class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_hgu" type="radio" value="0">
                                    <label class="form-check-label">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Buat Surat</button>
                </div>
            </div>
        </div>
    </form>
@endsection
