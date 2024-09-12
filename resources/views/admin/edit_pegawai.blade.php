@extends('layouts.back.app')

@section('title', 'Admin - Edit Pegawai')

@section('content')
    @include('sweetalert::alert')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Form Pegawai</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/admin/home') }}">Dashboard</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Data Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <div class="default-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home"><i
                                                class="far fa-user mr-2"></i> Data Pribadi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#payrol"><i
                                                class="fas fa-wallet mr-2"></i> Payroll</a>
                                    </li>
                                </ul>
                                <form method="post" id="editPegawaiForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>NIK KTP <small class="text-danger">*</small></label>
                                                            <input type="hidden" name="id_pegawai" id="editIdPegawai"
                                                                value="{{ $pegawai->id }}">
                                                            <input type="text" class="form-control" name="nik"
                                                                placeholder="Masukkan nomor ktp" id="editNikPegawai"
                                                                value="{{ $pegawai->nik }}">
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Nama lengkap <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="nama"
                                                                placeholder="Masukkan nama lengkap" id="editNamaPegawai"
                                                                value="{{ $pegawai->nama }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Email <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="email"
                                                                placeholder="Masukkan email" id="editEmailPegawai"
                                                                value="{{ $pegawai->email }}">
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Mobile number <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="no_hp"
                                                                placeholder="Masukkan nomor hp" id="editNumberPegawai"
                                                                value="{{ $pegawai->no_hp }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Tempat lahir <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="tempat_lahir"
                                                                id="editTempatLahirPegawai"
                                                                value="{{ $pegawai->tempat_lahir }}">
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Tanggal lahir <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="date" name="tgl_lahir" class="form-control"
                                                                id="editTanggalLahirPegawai"
                                                                value="{{ $pegawai->tgl_lahir }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Jenis kelamin <small
                                                                    class="text-danger">*</small></label>
                                                            <select class="form-control" name="jenis_kelamin"
                                                                id="editJenisKelaminPegawai">
                                                                <option hidden value="{{ $pegawai->jenis_kelamin }}">
                                                                    {{ $pegawai->jenis_kelamin }}</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Agama <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="agama"
                                                                id="editAgamaPegawai">
                                                                <option hidden value="{{ $pegawai->agama }}">
                                                                    {{ $pegawai->agama }}</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Katholik">Katholik</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Konghucu">Konghucu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Status pernikahan <small
                                                                    class="text-danger">*</small></label>
                                                            <select class="form-control" name="status_nikah"
                                                                id="editStatusPegawai">
                                                                <option hidden value="{{ $pegawai->status_nikah }}">
                                                                    {{ $pegawai->status_nikah }}</option>
                                                                <option value="Belum Menikah">Belum Menikah</option>
                                                                <option value="Sudah Menikah">Sudah Menikah</option>
                                                                <option value="Duda">Duda</option>
                                                                <option value="Janda">Janda</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Kewarganegaraan <small
                                                                    class="text-danger">*</small></label>
                                                            <select class="form-control" name="warga_negara"
                                                                id="editWargaNegaraPegawai">
                                                                <option hidden value="{{ $pegawai->warga_negara }}">
                                                                    {{ $pegawai->warga_negara }}</option>
                                                                <option value="WNI">WNI</option>
                                                                <option value="WNA">WNA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="payrol" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Nomor rekening <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="no_rek"
                                                                id="editNoRekPegawai"
                                                                placeholder="Masukkan nomor rekening"
                                                                value="{{ $pegawai->no_rek }}">
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Nama akun rekening <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="nama_rek"
                                                                id="editNamaRekPegawai"
                                                                placeholder="Masukkan nama rekening"
                                                                value="{{ $pegawai->nama_rek }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-danger mt-2"><small
                                                        class="text-danger">*</small><small>Catatan : digunakan untuk
                                                        pengiriman gaji kepada rekening yang telah di daftarkan pada field
                                                        diatas.</small></p>
                                                <br>
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit
                                                    data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
