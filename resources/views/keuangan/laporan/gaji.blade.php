@extends('keuangan.app')

@section('title', 'Keuangan - Laporan Gaji')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Laporan Gaji</a> / <a href="/admin/home">Home</a>
                </h6>
            </div>
            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="btn btn-sm btn-primary" href="{{ route('laporan_gaji.print') }}"
                                                target="_blank">&nbsp; Cetak laporan</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="table-responsive">
                                                    <table class="table shadow-hover">
                                                        <thead>
                                                            <tr>
                                                                <th><span class="font-w600 text-black fs-16">Date</span>
                                                                </th>
                                                                <th><span class="font-w600 text-black fs-16">Transaction
                                                                        ID</span></th>
                                                                <th><span class="font-w600 text-black fs-16">QR
                                                                        Code</span></th>
                                                                <th><span class="font-w600 text-black fs-16">Employee</span>
                                                                </th>
                                                                <th><span class="font-w600 text-black fs-16">Total</span>
                                                                </th>
                                                                <th><span class="font-w600 text-black fs-16">Time</span>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($payroll as $row)
                                                                @php
                                                                    $alfa =
                                                                        ($row->pegawai->jabatan->gaji_pokok / 26) *
                                                                        $row->alpha;
                                                                    $gaji = $row->pegawai->jabatan->gaji_pokok;
                                                                    $tunjangan = $row->pegawai->jabatan->tunjangan;
                                                                    $bruto_setahun = $gaji + $tunjangan * 12;
                                                                    $jabatan = 0.05 * $bruto_setahun;
                                                                    $netto = $bruto_setahun - $jabatan;
                                                                    $pkp = 54000000 - $netto;
                                                                    $lapis_pertama = 0.05 * 50000000;
                                                                    $pph = $lapis_pertama / 12;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <p class="text-black mb-1 font-w600">
                                                                            {{ date('l', strtotime($row->tgl_payroll)) }}
                                                                        </p>
                                                                        <span
                                                                            class="fs-14">{{ date('F d, Y', strtotime($row->tgl_payroll)) }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <p class="text-black mb-1 font-w600">#PAY ID :
                                                                        </p>
                                                                        <span
                                                                            class="fs-14">#{{ ucfirst($row->kode_payroll) }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="fs-14">
                                                                            <img src="{{ asset('storage/admin/qr_code/' . $row->qr_code) }}"
                                                                                class="img-fluid width80">
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <p class="text-black mb-1 font-w600">
                                                                            {{ ucfirst($row->pegawai->nama) }}</p>
                                                                        <span class="fs-14">NIP:
                                                                            {{ ucfirst($row->pegawai->nip) }}</span>
                                                                    </td>
                                                                    <td>
                                                                        @if ($row->pegawai->jabatan)
                                                                            <p class="text-black mb-1 font-w600">
                                                                                Rp.{{ number_format($row->pegawai->jabatan->gaji_pokok + $row->pegawai->jabatan->tunjangan - $row->bpjs - $row->pajak, 0, ',', '.') }}
                                                                            </p>
                                                                        @else
                                                                            <p class="text-black mb-1 font-w600">Data
                                                                                jabatan
                                                                                tidak tersedia
                                                                            </p>
                                                                        @endif
                                                                        <span class="fs-14">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-info-circle-fill text-info"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                                            </svg>&nbsp; termasuk potongan
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <p class="text-black mb-1 font-w600">
                                                                            {{ date('h:i:s A', strtotime($row->waktu_payroll)) }}
                                                                        </p>
                                                                        <span class="fs-14 text-success">
                                                                            Payment success
                                                                        </span>
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
                </div>
            </div>
        </div>
    </div>
@endsection
