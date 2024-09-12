@extends('hrd.app')

@section('title', 'HRD - Home')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h1>Beranda</h1>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light bg-white">
                        <i class="mdi mdi-calendar"></i> Hari ini ({{ date('d-m-Y') }})
                    </button>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Beranda</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <p class="mb-4">Pendaftar Bulan ini</p>
                            <h4 class="fs-30 mb-2">
                                {{ $totalPendaftar }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <p class="mb-4">Total karyawan</p>
                            <h4 class="fs-30 mb-2">
                                {{ $totalPegawai }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Jabatan</p>
                            <h4 class="fs-30 mb-2">
                                {{ $jumlahJabatan }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Bagian</p>
                            <h4 class="fs-30 mb-2">
                                {{ $jumlahBagian }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; EHRM 2024</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
@endsection
