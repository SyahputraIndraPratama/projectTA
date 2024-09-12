@extends('hrd.app')

@section('title', 'HRD - Absensi')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Absensi</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Absensi</a> / <a href="/hrd/home">Home</a>
                </h6>
            </div>
            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12 col-lg-12">
                            <div class="card-header bg-white">
                                <div class="d-flex align-items-center mr-3">
                                    <h4 class="fs-20 text-black mb-0">Riwayat Absensi</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table shadow-hover">
                                        <thead>
                                            <tr>
                                                <th><span class="font-w600 text-black fs-16">Date</span></th>
                                                <th><span class="font-w600 text-black fs-16">Pegawai</span></th>
                                                <th><span class="font-w600 text-black fs-16">Distance</span></th>
                                                <th><span class="font-w600 text-black fs-16">Time</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>
                                                        <p class="text-black mb-1 font-w600">
                                                            {{ \Carbon\Carbon::parse($row->waktu)->format('l') }}</p>
                                                        <span
                                                            class="fs-14">{{ \Carbon\Carbon::parse($row->waktu)->format('F d, Y') }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-black mb-1 font-w600">{{ ucfirst($row->nama) }}
                                                        </p>
                                                        <span class="fs-14">#{{ ucfirst($row->nip) }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-black mb-1 font-w600">
                                                            @if ($row->keterangan == 'masuk')
                                                                <font color="green">Masuk</font>
                                                            @else
                                                                <font color="red">Keluar</font>
                                                            @endif
                                                        </p>
                                                        <span class="fs-14">
                                                            @if ($row->keterangan == 'masuk')
                                                                Absent In
                                                            @else
                                                                Absent Out
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <p class="text-black mb-1 font-w600">
                                                            {{ \Carbon\Carbon::parse($row->waktu)->format('h:i:s') }}
                                                        </p>
                                                        <span class="fs-14">Target 40mins</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
