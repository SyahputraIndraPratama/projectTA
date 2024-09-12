@extends('layouts.back.app')

@section('title', 'Tambah Bagian')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
                    <ol class="breadcrumb">
                        <h6 class="m-0 font-weight-bold text-black">
                            <a>Tambah Bagian</a> / <a href="/admin/home">Home</a>
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
                                <form action="{{ route('bagian.tambah') }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Nama Bagian</label>
                                            <input type="text" class="form-control" name="bagian" id="bagian"
                                                value="{{ old('bagian') }}">
                                            @error('bagian')
                                                <small class="text-danger pl-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <a href="{{ route('bagian.index') }}" class="btn btn-danger">Back</a>
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
