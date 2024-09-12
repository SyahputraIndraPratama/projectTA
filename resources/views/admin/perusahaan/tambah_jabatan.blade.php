@extends('layouts.back.app')

@section('title', 'Tambah Jabatan')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
                    <ol class="breadcrumb">
                        <h6 class="m-0 font-weight-bold text-black">
                            <a>Tambah Jabatan</a> / <a href="/admin/home">Home</a>
                        </h6>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Select List</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('tambah') }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Nama Jabatan</label>
                                            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan"
                                                value="{{ old('nama_jabatan') }}">
                                            @error('nama_jabatan')
                                                <small class="text-danger pl-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 mt-2">
                                                <label for="gaji_pokok">Gaji Pokok (Rp)</label>
                                                <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok"
                                                    value="{{ old('gaji_pokok') }}">
                                                @error('gaji_pokok')
                                                    <small class="text-danger pl-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 mt-2">
                                                <label for="tunjangan">Tunjangan (Rp)</label>
                                                <input type="number" class="form-control" name="tunjangan" id="tunjangan"
                                                    value="{{ old('tunjangan') }}">
                                                @error('tunjangan')
                                                    <small class="text-danger pl-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 mt-2">
                                                <label for="benefit1">Keuntungan</label>
                                                <select class="form-control default-select" name="benefit1" id="benefit1">
                                                    <option value="" hidden>Nothing Selected</option>
                                                    <option value="Asset Kendaraan"
                                                        {{ old('benefit1') == 'Asset Kendaraan' ? 'selected' : '' }}>Asset
                                                        Kendaraan</option>
                                                    <option value="Asset Laptop"
                                                        {{ old('benefit1') == 'Asset Laptop' ? 'selected' : '' }}>Asset
                                                        Laptop</option>
                                                    <option value="BPJS Kesehatan"
                                                        {{ old('benefit1') == 'BPJS Kesehatan' ? 'selected' : '' }}>BPJS
                                                        Kesehatan</option>
                                                </select>
                                                @error('benefit1')
                                                    <small class="text-danger pl-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4 mt-2">
                                                <label for="benefit2">Keuntung lain</label>
                                                <select class="form-control default-select" name="benefit2" id="benefit2">
                                                    <option value="" hidden>Nothing Selected</option>
                                                    <option value="Asset Kendaraan"
                                                        {{ old('benefit2') == 'Asset Kendaraan' ? 'selected' : '' }}>Asset
                                                        Kendaraan</option>
                                                    <option value="Asset Laptop"
                                                        {{ old('benefit2') == 'Asset Laptop' ? 'selected' : '' }}>Asset
                                                        Laptop</option>
                                                    <option value="BPJS Kesehatan"
                                                        {{ old('benefit2') == 'BPJS Kesehatan' ? 'selected' : '' }}>BPJS
                                                        Kesehatan</option>
                                                </select>
                                                @error('benefit2')
                                                    <small class="text-danger pl-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4 mt-2">
                                                <label for="benefit3">Keuntungan lain</label>
                                                <select class="form-control default-select" name="benefit3" id="benefit3">
                                                    <option value="" hidden>Nothing Selected</option>
                                                    <option value="Asset Kendaraan"
                                                        {{ old('benefit3') == 'Asset Kendaraan' ? 'selected' : '' }}>Asset
                                                        Kendaraan</option>
                                                    <option value="Asset Laptop"
                                                        {{ old('benefit3') == 'Asset Laptop' ? 'selected' : '' }}>Asset
                                                        Laptop</option>
                                                    <option value="BPJS Kesehatan"
                                                        {{ old('benefit3') == 'BPJS Kesehatan' ? 'selected' : '' }}>BPJS
                                                        Kesehatan</option>
                                                </select>
                                                @error('benefit3')
                                                    <small class="text-danger pl-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <a href="{{ route('jabatan.index') }}" class="btn btn-danger">Back</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
