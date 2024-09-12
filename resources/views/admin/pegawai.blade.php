@extends('layouts.back.app')

@section('title', 'Admin - Pegawai')

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
                    <div class="d-flex mb-3">
                        <a href="{{ route('pegawai.tambah') }}" class="btn btn-primary me-2">Tambah Pegawai</a>
                        <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal') }}" class="form-control me-2" style="max-width: 200px;">
                        <a href="#" id="cetakDataPegawai" class="btn btn-primary" target="_blank">Cetak</a>
                    </div>
                    
                    <!-- Filter Form -->
                    <form method="GET" action="" class="mb-3" id="filterForm">
                        <div class="row">
                            <!-- Filter berdasarkan Jabatan -->
                            <div class="col-md-3">
                                <select name="jabatan_id" class="form-control" onchange="filterData()">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id_jabatan }}"
                                            {{ request('jabatan_id') == $jabatan->id_jabatan ? 'selected' : '' }}>
                                            {{ $jabatan->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <!-- Filter berdasarkan Gaji Pokok -->
                            <div class="col-md-3">
                                <input type="number" name="gaji_pokok" value="{{ request('gaji_pokok') }}"
                                    class="form-control" placeholder="Gaji Pokok" onchange="filterData()">
                            </div> --}}
                            <!-- Filter berdasarkan Jenis Kelamin -->
                            <div class="col-md-3">
                                <select name="jenis_kelamin" class="form-control" onchange="filterData()">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive" id="dataTableContainer">
                        @include('admin.partials.pegawai_table', ['data' => $data])
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

    <script>
        function filterData() {
            // Ambil data dari formulir
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);

            // Buat URL dengan parameter query
            const url = new URL(window.location.href);
            url.search = new URLSearchParams(formData).toString();

            // Ubah URL tanpa memuat ulang halaman
            window.history.replaceState({}, '', url);

            // Kirim permintaan AJAX
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'text/html'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Perbarui konten tabel
                    const newDocument = new DOMParser().parseFromString(html, 'text/html');
                    const newTableContent = newDocument.querySelector('#dataTableContainer').innerHTML;
                    document.getElementById('dataTableContainer').innerHTML = newTableContent;
                })
                .catch(error => console.error('Error:', error));
        }

        function printTable() {
            // Ambil konten tabel tanpa kolom aksi
            const tableContent = document.querySelector('#dataTableContainer').innerHTML;

            // Buat jendela baru untuk print
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Cetak Pegawai</title>');
            printWindow.document.write(
                '<link rel="stylesheet" href="{{ asset('css/app.css') }}">'); // Include your CSS for styling
            printWindow.document.write('</head><body >');
            printWindow.document.write('<h1>Data Pegawai</h1>');

            // Remove the "Aksi" column from the table content
            const modifiedTableContent = tableContent.replace(/<th>Aksi<\/th>.*?<\/tr>/s, '</tr>');
            printWindow.document.write(modifiedTableContent);

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
        }

        // Ketika tombol cetak ditekan
        document.getElementById('cetakDataPegawai').addEventListener('click', function() {
            const tanggal = document.getElementById('filterTanggal').value;
            if(tanggal) {
                window.open(`{{ route('pegawai.cetak') }}?tanggal=${tanggal}`, '_blank');
            } else {
                alert('Pilih tanggal terlebih dahulu');
            }
        });
    </script>
@endsection
