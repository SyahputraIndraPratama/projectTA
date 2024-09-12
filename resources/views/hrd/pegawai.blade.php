@extends('hrd.app')

@section('title', 'HRD - Pegawai')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pegawai</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">
                        <a>Data Pegawai</a> / <a href="/admin/home">Beranda</a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($data as $row)
                                    <tr>
                                        <td class="py-3">{{ $no++ }}</td>
                                        <td class="py-3">
                                            <div class="media d-flex align-items-center">
                                                <div class="avatar avatar-xl mr-2">
                                                    @if ($row->photo)
                                                        <img class="rounded-circle img-fluid"
                                                            src="{{ url('uploads/' . $row->photo) }}" width="30"
                                                            alt="{{ $row->nama }}">
                                                    @else
                                                        <img class="rounded-circle img-fluid"
                                                            src="{{ url('uploads/default.png') }}" width="30"
                                                            alt="Default Image">
                                                    @endif
                                                </div>&nbsp;
                                                <div class="media-body">
                                                    <p class="mb-0">{{ $row->nama }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $row->jenis_kelamin }}</td>
                                        <td>{{ $row->jabatan->nama_jabatan ?? 'Tidak Ada' }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->no_hp }}</td>
                                        <td>
                                            <a href="{{ route('hrd.pegawai.detail', $row->id_pegawai) }}"
                                                class="btn btn-success edit-pegawai">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pegawai.edit', $row->id_pegawai) }}"
                                                data-id="{{ $row->id_pegawai }}" data-nik="{{ $row->nik }}"
                                                data-nama="{{ $row->nama }}" data-email="{{ $row->email }}"
                                                data-no_hp="{{ $row->no_hp }}"
                                                data-tempat_lahir="{{ $row->tempat_lahir }}"
                                                data-tgl_lahir="{{ $row->tgl_lahir }}"
                                                data-jenis_kelamin="{{ $row->jenis_kelamin }}"
                                                data-agama="{{ $row->agama }}"
                                                data-status_nikah="{{ $row->status_nikah }}"
                                                data-warga_negara="{{ $row->warga_negara }}"
                                                data-no_rek="{{ $row->no_rek }}" data-nama_rek="{{ $row->nama_rek }}">
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
        <form id="deletePegawaiForm" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </main>
@endsection
