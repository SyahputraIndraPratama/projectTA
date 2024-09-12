@extends('layouts.back.app')

@section('title', 'Admin - Informasi Pegawai')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Riwayat Informasi</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/admin/home') }}">Dashboard</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="#about-me" data-toggle="tab"
                                                class="nav-link active show">About Me</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="about-me" class="tab-pane fade active show">
                                            <div class="profile-about-me">
                                                <div class="pt-4 border-bottom-1 pb-3">
                                                    <h5 class="text-primary">Tentang Saya</h5>
                                                    @if (empty($pegawai->about))
                                                        <center><img src="{{ asset('img/no_data.png') }}" width="200">
                                                        </center>
                                                    @else
                                                        <p class="mb-2">{{ $pegawai->about }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="profile-personal-info">
                                                <h5 class="text-primary mb-4">Informasi Pribadi</h5>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Nama <span class="pull-right"
                                                                style="margin-left: 190px;">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $pegawai->nama }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">NIK KTP <span class="pull-right"
                                                                style="margin-left: 175px;">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $pegawai->nik }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Tempat, Tanggal Lahir <span class="pull-right"
                                                                style="margin-left: 75px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $pegawai->tempat_lahir }},
                                                            {{ date('d-m-Y', strtotime($pegawai->tgl_lahir)) }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Jenis Kelamin <span class="pull-right"
                                                                style="margin-left: 136px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        <span>{{ $pegawai->jenis_kelamin }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Agama <span class="pull-right"
                                                                style="margin-left: 183px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $pegawai->agama }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Email <span class="pull-right"
                                                                style="margin-left: 195px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $pegawai->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Status Kepegawaian <span class="pull-right"
                                                                style="margin-left: 88px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        <span>{{ $pegawai->status_pegawai }}</span>
                                                    </div>
                                                </div>
                                                <?php
                                                $date1 = new DateTime(date('Y-m-d', strtotime($pegawai->tgl_lahir)));
                                                $date2 = new DateTime(date('Y-m-d'));
                                                $interval = $date1->diff($date2);
                                                ?>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Umur <span class="pull-right"
                                                                style="margin-left: 193px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $interval->y }}
                                                            years</span></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h6 class="f-w-500">Alamat <span class="pull-right"
                                                                style="margin-left: 182px">:</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-9 col-7"><span>{{ $pegawai->alamat }},
                                                            Kecamatan {{ $pegawai->kecamatan }},
                                                            {{ $pegawai->kabupaten }}, Provinsi
                                                            {{ $pegawai->provinsi }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="replyModal">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Post Reply</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <textarea class="form-control" rows="4">Message</textarea>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Rincian Pembayaran Terbaru</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table shadow-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Payment No.</th>
                                                <th scope="col">Pegawai</th>
                                                <th scope="col">Type of payment</th>
                                                <th scope="col">Payment date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pay as $p)
    <tr>
                                                    <td>#{{ $p->kode_payroll }}</td>
                                                    <td>{{ $p->nama }}</td>
                                                    <td>Pembayaran Gaji</td>
                                                    <td>{{ \Carbon\Carbon::parse($p->tgl_payroll)->format('d F Y') }} |
                                                        {{ \Carbon\Carbon::parse($p->waktu_payroll)->format('h:i:s') }}</td>
                                                    <td><span class="badge badge-rounded badge-success">Berhasil</span></td>
                                                    <td>Rp. {{ number_format($p->total, 0, ',', '.') }}</td>
                                                </tr>
    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->
            </div>
        </div>
    </main>
@endsection
