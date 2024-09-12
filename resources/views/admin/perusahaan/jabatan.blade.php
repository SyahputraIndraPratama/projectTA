@extends('layouts.back.app')

@section('title', 'Admin - Jabatan')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Jabatan</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">
                        <a>Data Jabatan</a> / <a href="/admin/home">Home</a>
                    </h6>
                </div>

                <div class="card-body">
                    <a href="{{ url('/admin/jabatan/tambah_jabatan') }}" class="btn btn-primary mb-3">Tambah Jabatan</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jabatan</th>
                                    <th>Gaji Pokok (Rp)</th>
                                    <th>Tunjangan (Rp)</th>
                                    <th class="pl-5 width200">Benefit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($data as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td class="py-3">{{ $row->nama_jabatan }}</td>
                                        <td class="py-2">Rp. {{ number_format($row->gaji_pokok) }}</td>
                                        <td class="py-2">Rp. {{ number_format($row->tunjangan) }}</td>
                                        <td class="py-2 pl-5 wspace-no">
                                            @if ($row->benefit1)
                                                <a class="btn btn-sm btn-primary light mr-3 mb-2">{{ $row->benefit1 }}</a>
                                            @endif
                                            @if ($row->benefit2)
                                                <a class="btn btn-sm btn-success light mr-3 mb-2">{{ $row->benefit2 }}</a>
                                            @endif
                                            @if ($row->benefit3)
                                                <a class="btn btn-sm btn-warning light mr-3 mb-2">{{ $row->benefit3 }}</a>
                                            @endif
                                        </td>
                                        <td class="py-2 text-right">
                                            <a href="javascript:void(0);" class="btn btn-warning text-black edit-jabatan"
                                                style="background-color: transparent; border: none;"
                                                data-id="{{ $row->id_jabatan }}" data-nama="{{ $row->nama_jabatan }}"
                                                data-gaji="{{ $row->gaji_pokok }}" data-tunjangan="{{ $row->tunjangan }}"
                                                data-toggle="modal" data-target="#editJabatan">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-danger text-black delete-jabatan"
                                                style="background-color: transparent; border: none;"
                                                data-id="{{ $row->id_jabatan }}">
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
        <form id="deleteJabatanForm" action="" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <!-- Modal Update -->
        <?php foreach ($data as $row) : ?>
        <!-- Modal Update -->
        <div class="modal fade" id="editJabatan" tabindex="-1" role="dialog" aria-labelledby="editJabatanLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Jabatan</h5>
                        <span type="button" class="close" data-dismiss="modal" style="font-size: 1.5rem">
                            <span>&times;</span>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editJabatanForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_jabatan" id="editIdJabatan">
                            <div class="form-group">
                                <label>Nama Jabatan</label>
                                <input type="text" class="form-control" name="nama_jabatan" id="editNamaJabatan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Gaji Pokok</label>
                                <input type="text" class="form-control" name="gaji_pokok" id="editGajiPokok" required>
                            </div>
                            <div class="form-group">
                                <label>Tunjangan</label>
                                <input type="text" class="form-control" name="tunjangan" id="editTunjangan" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </main>
@endsection
