@extends('layouts.back.app')

@section('title', 'Admin - Kabupaten')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Kabupaten</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">
                        <a>Data Kabupaten</a> / <a href="/admin/home">Beranda</a>
                    </h6>
                </div>
                <div class="card-body">
                    <a href="javascript:void(0);" class="btn btn-primary mb-3" data-toggle="modal"
                        data-target="#addKabupaten">Tambah Kabupaten</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($data as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $row->provinsi->provinsi }}</td>
                                        <td>{{ $row->kabupaten }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-warning edit-kabupaten"
                                                data-id="{{ $row->id_kabupaten }}" data-kabupaten="{{ $row->kabupaten }}"
                                                data-id_provinsi="{{ $row->id_provinsi }}" data-toggle="modal"
                                                data-target="#editKabupaten">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete-kabupaten"
                                                data-id="{{ $row->id_kabupaten }}" data-kabupaten="{{ $row->kabupaten }}"
                                                data-id_provinsi="{{ $row->id_provinsi }}">
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
        <form id="deleteKabupatenForm" action="" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <!-- Modal add -->
        <div class="modal fade" id="addKabupaten">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kabupaten</h5>
                        <span type="button" class="close" data-dismiss="modal" style="font-size: 1.5rem">
                            <span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kabupaten.tambah') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="mb-2">Provinsi</label>
                                <select class="form-control" name="id_provinsi" required>
                                    <option hidden>Silahkan pilih</option>
                                    @foreach ($provinsi as $prov)
                                        <option value="{{ $prov->id_provinsi }}">{{ $prov->provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Kabupaten/Kota</label>
                                <input type="text" class="form-control" name="kabupaten" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="editKabupaten" tabindex="-1" role="dialog" aria-labelledby="editKabupatenLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kabupaten</h5>
                        <span type="button" class="close" data-dismiss="modal" style="font-size: 1.5rem">
                            <span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editKabupatenForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editIdKabupaten">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="id_provinsi" id="editIdProvinsi" required>
                                    <option hidden id="currentProvinsiOption"></option>
                                    @foreach ($provinsi as $prov)
                                        <option value="{{ $prov->id_provinsi }}">{{ $prov->provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Kabupaten/Kota</label>
                                <input type="text" class="form-control" name="kabupaten" id="editNamaKabupaten" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
