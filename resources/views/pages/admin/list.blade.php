@extends('layouts.admin-layout')
@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush
@push('foot')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="/js/admin/pertanahan.js"></script>
@endpush
@section('title', 'Daftar Pengukuran')
@section('content')
    <table class="table table-sm caption-top table-striped table-hover" id="table-pertanahan">
        <caption>
            <a href="{{ route('admin.tanah.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah
                Pengukuran Baru</a>
        </caption>
        <thead>
            <tr>
                <th scope="col">Nama Pemilik</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Status Pendaftaran</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tanah as $it)
                <tr>
                    <td class="w-25">{{ $it->pemilik['nama'] }}</td>
                    <td class="w-50">{{ $it->letak }}</td>
                    <td>{!! $it->registration['is_register']
                        ? '<small class="text-success">Terdaftar</small>'
                        : '<small class="text-warning">Belum Terdaftar</small>' !!}</td>
                    <td>
                        {{-- <div class="d-flex flex-row">
                    <a href="#" class="m-1 text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-detail="{{ $it }}" data-bs-placement="top" title="Tampilkan Rincian Pertanahan {{ $it->pemilik['nama'] }}"><i class="bi bi-eye-fill"></i></a>
                <a href="#" class="m-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i></a>
                <a href="#" class="m-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Status Tanah"><i class="bi bi-map"></i></a>
                <a href="#" class="m-1 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Tanah pada Peta"><i class="bi bi-map-fill"></i></a>
                @if (!$it->registration['is_register'])
                <a href="{{ route('admin.surat.show', $it->id) }}" class="m-1 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Buatkan Surat Tanah"><i class="bi bi-file-earmark-word"></i></a>
                @endif
                </div> --}}
                        {{-- <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Options
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div> --}}
                        <div class="dropdown">
                            <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" id="list-option"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Options
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="list-option">
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-detail="{{ $it }}"><i
                                            class="bi bi-eye-fill"></i> <small>Tampilkan Lebih Detail</small></a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit"><i class="bi bi-pencil-square"></i>
                                        <small>Edit Tanah</small></a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Lihat Tanah pada Peta"><i class="bi bi-map-fill text-success"></i>
                                        <small>Tampilkan pada peta</small></a>
                                </li>
                                @if (!$it->registration['is_register'])
                                    <li><a href="#" class="dropdown-item" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Ubah Status Tanah"><i
                                                class="bi bi-patch-check-fill text-info"></i> <small>Jadikan
                                                Terdaftar</small></a></li>
                                    <li>
                                        <a href="{{ route('admin.surat.show', $it->id) }}" class="dropdown-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Buatkan Surat Tanah"><i
                                                class="bi bi-file-earmark-word text-primary"></i> <small>Buatkan Surat
                                                Tanah</small></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
@endsection
