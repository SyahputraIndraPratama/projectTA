@extends('layouts.back.inc.karyawan.app')

@section('title', 'Karyawan - Rincian Pembayaran')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Gaji</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Riwayat Pembayaran</a> / <a href="/admin/home">Home</a>
                </h6>
            </div>
            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12 col-lg-12">
                            <div class="card-header bg-white">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <form action="" method="get" class="d-inline-block mb-2 mb-md-0">
                                        <input type="month" class="babeng babeng-select ml-0" name="cari"
                                            value="{{ $cari !== null ? $cari : date('Y-m') }}">
                                        <input class="btn btn-info ml-2" style="margin-left: 5px" type="submit"
                                            id="babeng-submit" value="Pilih Bulan">
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table shadow-hover">
                                        <thead>
                                            <tr>
                                                <th><span class="font-w600 text-black fs-16">No</span></th>
                                                <th><span class="font-w600 text-black fs-16">Nama</span></th>
                                                <th><span class="font-w600 text-black fs-16">Tanggal</span></th>
                                                <th><span class="font-w600 text-black fs-16">Gaji Pokok</span></th>
                                                <th><span class="font-w600 text-black fs-16">Tunjangan</span></th>
                                                <th><span class="font-w600 text-black fs-16">BPJS</span></th>
                                                <th><span class="font-w600 text-black fs-16">Pajak</span></th>
                                                <th><span class="font-w600 text-black fs-16">Jumlah Diterima</span></th>
                                                <th><span class="font-w600 text-black fs-16">Status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->pegawai->nama }}</td>
                                                    <td>{{ $data->tgl_generate }}</td>
                                                    <td>{{ formatRupiah($data->pegawai->gaji_pokok) }}</td>
                                                    <td>{{ formatRupiah($data->pegawai->tunjangan) }}</td>
                                                    <td>{{ formatRupiah($data->bpjs) }}</td>
                                                    <td>{{ formatRupiah($data->pajak) }}</td>
                                                    <td>{{ formatRupiah($data->pegawai->gaji_pokok + $data->pegawai->tunjangan - $data->bpjs - $data->pajak) }}</td>
                                                    <td>
                                                        @if ($data->status === 'belum')
                                                            <span class="badge bg-info text-dark">Pending</span>
                                                        @elseif ($data->status === 'berhasil')
                                                            <span class="badge bg-success">Paid</span>
                                                        @elseif ($data->status === 'failed')
                                                            <span class="badge bg-danger">Failed</span>
                                                        @else
                                                            <span class="badge bg-secondary">Unknown</span>
                                                        @endif
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
