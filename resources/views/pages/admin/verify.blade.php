@extends('layouts.admin-layout')
@section('title', 'Verifikasi Surat Tanah')
@section('content')
    <div class="d-flex justify-content-center mb-5">
        <div class="col-12 col-md-8 col-lg-8 ">
            <form class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Nomor Pendaftaran</label>
                    <div class="input-group">
                        <div class="input-group-text">Nomor Pendaftaran</div>
                        <input type="number" class="form-control" id="inlineFormInputGroupUsername" placeholder="Ex : 01">
                    </div>
                </div>

                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormSelectPref">Tahun Terdaftar</label>
                    <select class="form-select" id="inlineFormSelectPref">
                        <option selected>Pilih Tahun Terdaftar</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="alert alert-info" role="alert">
            <i class="bi bi-check-circle-fill"></i> <strong>Success !</strong> Data berhasil ditemukan
        </div>
        <div class="py-2">
            <span class="text-primary">Berikut rincian yang ditemukan dari database :</span>
        </div>
        <div class="col-md-4 col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 jetbraint-font">No. 593.21/01/Pem/2022</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <figure class="text-start">
                                <blockquote class="blockquote">
                                    <p>Matsum.</p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                    Pemilik
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <figure class="text-start">
                                <blockquote class="blockquote">
                                    <p>Jalan Desa Pamalian RT/RW. 004/002 Pamalian</p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                    Alamat
                                </figcaption>
                            </figure>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <figure class="text-start">
                                <blockquote class="blockquote">
                                    <p>Jalan desa Pamalian 180 meter sebelah timur pasar</p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                    Lokasi Tanah
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <h4>Batas-batas :</h4>
                            <ul>
                                <li>Utara
                                    <ul>
                                        <li>Jalan Desa Pamalian</li>
                                    </ul>
                                </li>
                                <li>Timur
                                    <ul>
                                        <li>Sungai Pamalian</li>
                                    </ul>
                                </li>
                                <li>Selatan
                                    <ul>
                                        <li>Syahruni</li>
                                    </ul>
                                </li>
                                <li>Barat
                                    <ul>
                                        <li>Suhardi</li>
                                        <li>Kantor Koperasi Pamalian Bauntung</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
