@extends('layouts.back.app')

@section('title', 'Admin - Provinsi')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Provinsi</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">
                        <a>Data Provinsi</a> / <a href="/admin/home">Beranda</a>
                    </h6>
                </div>
                <div class="card-body">
                    <a href="javascript:void(0);" class="btn btn-primary mb-3" data-toggle="modal"
                        data-target="#addProvinsi">Tambah Provinsi</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Provinsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($data as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $row->provinsi }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-warning edit-provinsi"
                                                data-id="{{ $row->id_provinsi }}" data-provinsi="{{ $row->provinsi }}"
                                                data-toggle="modal" data-target="#editProvinsi">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete-provinsi"
                                                data-id="{{ $row->id_provinsi }}">
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
        <form id="deleteProvinsiForm" action="" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <!-- Modal add -->
        <div class="modal fade" id="addProvinsi">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Provinsi</h5>
                        <span type="button" class="close" data-dismiss="modal"
                            style="font-size: 1.5rem"><span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('provinsi.tambah') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="mb-2">Nama Provinsi</label>
                                <input type="text" class="form-control" name="provinsi" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="editProvinsi" tabindex="-1" role="dialog" aria-labelledby="editProvinsiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Provinsi</h5>
                        <span type="button" class="close" data-dismiss="modal"
                            style="font-size: 1.5rem"><span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editProvinsiForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_provinsi" id="editIdProvinsi">
                            <div class="form-group">
                                <label>Nama Provinsi</label>
                                <input type="text" class="form-control" name="provinsi" id="editNamaProvinsi" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
