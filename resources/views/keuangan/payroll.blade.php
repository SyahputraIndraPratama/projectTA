@extends('keuangan.app')

@section('title', 'Keuangan - Payroll')

@section('content')
    <style>
        .form-tombol {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .form-tombol form {
            margin: 0;
        }
    </style>
    @include('sweetalert::alert')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penggajian</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Penggajian</a> / <a href="/admin/home">Beranda</a>
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
                                    <div class="form-tombol">
                                        @if ($datas->count() > 0)
                                            <form action="{{ route('payroll.generate') }}" method="post"
                                                class="d-inline-block mb-2 mb-md-0">
                                                @csrf
                                                <input type="hidden" name="cari" value="{{ $cari }}">
                                                <input data-toggle="tooltip" data-placement="top"
                                                    title="Data yang sudah di generate akan di skip!" class="btn btn-info"
                                                    type="submit" id="babeng-submit"
                                                    onclick="return confirm('Anda yakin generate data bulan ini?')"
                                                    value="Generate Gaji">
                                            </form>
                                            <form action="{{ route('payroll.slip.rincian') }}" method="get"
                                                class="d-inline-block mb-2 mb-md-0">
                                                @csrf
                                                <input type="hidden" name="cari" value="{{ $cari }}">
                                                <input class="btn btn-info" type="submit" id="babeng-submit"
                                                    onclick="return confirm('Anda yakin mencetak data bulan ini?')"
                                                    value="Cetak Rincian">
                                            </form>
                                        @else
                                            <form action="{{ route('payroll.generate') }}" method="post"
                                                class="d-inline-block mb-2 mb-md-0">
                                                @csrf
                                                <input type="hidden" name="cari" value="{{ $cari }}">
                                                <input class="btn btn-info" type="submit" id="babeng-submit"
                                                    onclick="return confirm('Anda yakin generate data bulan ini?')"
                                                    value="Generate Gaji">
                                            </form>
                                        @endif
                                    </div>
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
                                                <th><span class="font-w600 text-black fs-16">Jabatan</span></th>
                                                <th><span class="font-w600 text-black fs-16">Gaji Pokok</span></th>
                                                <th><span class="font-w600 text-black fs-16">Tunjangan</span></th>
                                                <th><span class="font-w600 text-black fs-16">BPJS</span></th>
                                                <th><span class="font-w600 text-black fs-16">Pajak</span></th>
                                                <th><span class="font-w600 text-black fs-16">Jumlah Diterima</span></th>
                                                <th><span class="font-w600 text-black fs-16">Aksi</span></th>
                                                <th><span class="font-w600 text-black fs-16">Status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->pegawai->nama }}</td>
                                                    <td>{{ $data->tgl_generate }}</td>
                                                    <td>{{ $data->nama_jabatan }}</td>
                                                    <td>{{ formatRupiah($data->pegawai->gaji_pokok) }}</td>
                                                    <td>{{ formatRupiah($data->pegawai->tunjangan) }}</td>
                                                    <td>{{ formatRupiah($data->bpjs) }}
                                                    </td>
                                                    <td>{{ formatRupiah($data->pajak) }}
                                                    </td>
                                                    <td>{{ formatRupiah($data->pegawai->gaji_pokok + $data->pegawai->tunjangan - $data->bpjs - $data->pajak) }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column align-items-center">
                                                            <a href="{{ route('payroll.slip.perid', $data->id_payroll) }}"
                                                                class="btn btn-info btn-sm mb-1" data-toggle="tooltip"
                                                                data-placement="top" title="Cetak Slip Gaji">
                                                                <i class="far fa-file-pdf"></i>
                                                            </a>
                                                            @if ($data->status !== 'berhasil')
                                                                <form
                                                                    action="{{ route('payroll.send', $data->id_payroll) }}"
                                                                    method="post" class="align-items-center"
                                                                    style="margin-bottom: 1px">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-warning btn-sm mb-1"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Kirim"
                                                                        onclick="return confirm('Anda yakin ingin mengirim data gaji ini?')">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            <form action="{{ route('payroll.delete', $data->id_payroll) }}" method="post" class="align-items-center">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Hapus Data Gaji"
                                                                    onclick="return confirm('Anda yakin ingin menghapus data gaji ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.send-slip').forEach(button => {
                button.addEventListener('click', function() {
                    const payrollId = this.getAttribute('data-id');
                    if (confirm('Apakah Anda yakin sudah mengirim slip gaji ini?')) {
                        fetch(/payroll/send / $ {
                            payrollId
                        }, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(response => {
                            if (response.ok) {
                                location.reload();
                            } else {
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
