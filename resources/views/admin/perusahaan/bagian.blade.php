@extends('layouts.back.app')

@section('title', 'Admin - Bagian')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Bagian</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">
                        <a>Data Bagian</a> / <a href="/admin/home">Home</a>
                    </h6>
                </div>
                <div class="card-body">
                    <a href="{{ url('/admin/bagian/tambah') }}" class="btn btn-primary mb-3">Tambah Bagian</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bagian Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($data as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $row->nama_bagian }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-warning edit-bagian"
                                                data-id="{{ $row->id_bagian }}" data-bagian="{{ $row->nama_bagian }}"
                                                data-toggle="modal" data-target="#editBagian">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete-bagian"
                                                data-id="{{ $row->id_bagian }}">
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
        <form id="deleteBagianForm" action="" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <!-- Modal Update -->
        <div class="modal fade" id="editBagian" tabindex="-1" role="dialog" aria-labelledby="editBagianLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Bagian</h5>
                        <span type="button" class="close" data-dismiss="modal"
                            style="font-size: 1.5rem"><span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editBagianForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_bagian" id="editIdBagian">
                            <div class="form-group">
                                <label>Nama Bagian</label>
                                <input type="text" class="form-control" name="bagian" id="editNamaBagian" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
