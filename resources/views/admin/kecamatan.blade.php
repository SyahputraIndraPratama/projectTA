@extends('layouts.back.app')

@section('title', 'Admin - Kecamatan')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Kecamatan</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">
                        <a>Data Kecamatan</a> / <a href="/admin/home">Beranda</a>
                    </h6>
                </div>
                <div class="card-body">
                    <a href="javascript:void(0);" class="btn btn-primary mb-3" data-toggle="modal"
                        data-target="#addKecamatan">Tambah Kecamatan</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kecamatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($data as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $row->kecamatan }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-warning edit-kecamatan"
                                                data-id="{{ $row->id_kecamatan }}" data-kecamatan="{{ $row->kecamatan }}"
                                                data-id_kabupaten="{{ $row->id_kabupaten }}" data-toggle="modal"
                                                data-target="#editKecamatan">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete-kecamatan"
                                                data-id="{{ $row->id_kecamatan }}" data-kecamatan="{{ $row->kecamatan }}"
                                                data-id_kabupaten="{{ $row->id_kabupaten }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Delete (hidden) -->
        <form id="deleteKecamatanForm" action="" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <!-- Modal add -->
        <div class="modal fade" id="addKecamatan">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kecamatan</h5>
                        <span type="button" class="close" data-dismiss="modal" style="font-size: 1.5rem">
                            <span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kecamatan.tambah') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="mb-2">Kabupaten/Kota</label>
                                <select class="form-control" name="id_kabupaten" required>
                                    <option hidden>Silahkan pilih</option>
                                    @foreach ($kabupaten as $kab)
                                        <option value="{{ $kab->id_kabupaten }}">{{ $kab->kabupaten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input type="text" class="form-control" name="kecamatan" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="editKecamatan" tabindex="-1" role="dialog" aria-labelledby="editKecamatanLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kecamatan</h5>
                        <span type="button" class="close" data-dismiss="modal" style="font-size: 1.5rem">
                            <span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editKecamatanForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editIdKecamatan">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select class="form-control" name="id_kabupaten" id="editIdKabupaten" required>
                                    <option hidden id="currentProvinsiOption"></option>
                                    @foreach ($kabupaten as $kab)
                                        <option value="{{ $kab->id_kabupaten }}">{{ $kab->kabupaten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input type="text" class="form-control" name="kecamatan" id="editNamaKecamatan" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
