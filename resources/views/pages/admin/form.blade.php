@extends('layouts.admin-layout')
@section('title', 'Tambah Pengukuran')
@push('foot')
    <script src="/js/form.js"></script>
@endpush
@section('content')
    <form action="{{ route('admin.tanah.store') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-5 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label-sm">Nama</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" name="name"
                                    placeholder="Input nama pemilik ..">
                            </div>
                        </div>
                        <div class="py-2 d-flex justify-content-between">
                            <small class="text-muted">Lebih Detail</small>
                            <span type="button" id="btn-advance"><i id="icon-advance"
                                    class="bi bi-chevron-down"></i></span>
                        </div>
                        <div id="container-advance" class="d-none">
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Tempat/Tgl. Lahir</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-sm" name="tempat_lahir"
                                        placeholder="Tempat Lahir ..">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="form-control form-control-sm" name="tanggal_lahir"
                                        placeholder="Tanggal Lahir ..">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="inlineRadio1" value="laki-laki">
                                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="inlineRadio2" value="perempuan">
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Pekerjaan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" name="pekerjaan"
                                        placeholder="Input pekerjaan pemilik ..">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Kewarganegaraan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" name="kewarganegaraan"
                                        value="Indonesia">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Alamat</label>
                                <div class="col-md-8">
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control form-control-sm"
                                        placeholder="Masukan Alamat Pemilik..."></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Letak</label>
                                <div class="col-md-8">
                                    <textarea name="letak" id="alamat" rows="3" class="form-control form-control-sm"
                                        placeholder="Masukan Lokasi Tanah..."></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Ukuran</label>
                                <div class="col-md-8">
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Panjang</label>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <input type="number" name="panjang" class="form-control form-control-sm"
                                                    aria-describedby="input-coordinate-x">
                                                <span class="input-group-text" id="input-coordinate-x">m</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Lebar</label>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <input type="number" name="lebar" class="form-control form-control-sm"
                                                    aria-describedby="input-coordinate-x">
                                                <span class="input-group-text" id="input-coordinate-x">m</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Luas</label>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <input type="number" name="luas" class="form-control form-control-sm"
                                                    aria-describedby="input-coordinate-x">
                                                <span class="input-group-text"
                                                    id="input-coordinate-x">m<sup>2</sup></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Batas-batas</label>
                                <div class="col-md-8">
                                    <small class="text-info my-2 d-block"><i class="bi bi-info-circle-fill"></i>
                                        Jika berbatasan lebih dari satu, pisahkan dengan koma</small>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Utara</label>
                                        <div class="col-md-9">
                                            <input type="text" name="batas_utara" class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Timur</label>
                                        <div class="col-md-9">
                                            <input type="text" name="batas_timur" class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Selatan</label>
                                        <div class="col-md-9">
                                            <input type="text" name="batas_selatan"
                                                class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-md-3 col-form-label-sm">Barat</label>
                                        <div class="col-md-9">
                                            <input type="text" name="batas_barat" class="form-control form-control-sm"
                                                aria-describedby="input-coordinate-x">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Peruntukan</label>
                                <div class="col-md-8">
                                    <input type="text" name="peruntukan" class="form-control form-control-sm"
                                        placeholder="Misal : Rumah, Perkebunan, dll">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label-sm">Riwayat Tanah</label>
                                <div class="col-md-8">
                                    <textarea name="riwayat" id="alamat" rows="3" class="form-control form-control-sm"
                                        placeholder="Masukan Riwayat Tanah..."></textarea>
                                </div>
                            </div>
                            <div class="card-header"><strong>Status Pendaftaran Tanah</strong></div>
                            <div class="card-body">
                                <div class="form-check py-1">
                                    <input class="form-check-input" name="is_register" value="1" type="checkbox"
                                        id="check-register">
                                    <label class="form-check-label" for="check-register">
                                        Terdaftar
                                    </label>
                                </div>
                                <div class="row d-none" id="form-register">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary bg-opacity-25">Desa</div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="col-form-label-sm">Nomor Registrasi</label>
                                                    <input type="text" name="nomor_registrasi_desa"
                                                        class="form-control form-control-sm"
                                                        placeholder="Input Nomor Registasi ..">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label-sm">Tanggal Registrasi</label>
                                                    <input type="date" name="tanggal_registrasi_desa"
                                                        class="form-control form-control-sm"
                                                        placeholder="Input Tanggal Registrasi ..">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-success bg-opacity-25">Kecamatan</div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="col-form-label-sm">Nomor Registrasi</label>
                                                    <input type="text" name="nomor_registrasi_kecamatan"
                                                        class="form-control form-control-sm"
                                                        placeholder="Input Nomor Registasi ..">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label-sm">Tanggal Registrasi</label>
                                                    <input type="date" name="tanggal_registrasi_kecamatan"
                                                        class="form-control form-control-sm"
                                                        placeholder="Input Tanggal Registrasi ..">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between">
                            <strong>Koordinat (UTM 49M)</strong>
                            <button type="button" id="btn-bulk-edit" class="btn btn-outline-secondary btn-sm">Bulk
                                Edit</button>
                        </div>
                        <div class="card-body">
                            <div id="form-coordinate-input">
                                <div id="coordinate-container">

                                </div>
                                <div class="py-3">
                                    <button type="button" id="btn-add-coordinate"
                                        class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Tambah
                                        Titik Koordinat</button>
                                </div>
                            </div>
                            <div id="bulk-coordinate-input" class="d-none">
                                <small id="error-notif" class="text-danger"></small>
                                <textarea name="bulk-coordinate" id="bulk-coordinate" class="form-control mt-2" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary"><i class="bi bi-upload"></i> Tambahkan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
