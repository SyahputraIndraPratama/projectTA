@extends('hrd.app')

@section('title', 'HRD - Kelola Pekerjaan')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kelola Lowongan</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Kelola Lowongan</a> / <a href="/admin/home">Beranda</a>
                </h6>
            </div>
            <div class="card-body">
                <button style="margin-bottom:20px" data-toggle="modal" data-target="#addJobModal" class="btn btn-info">
                    Tambah Job Baru
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Gambar Pekerjaan</th>
                                <th>Nama Posisi</th>
                                <th>Deskripsi Pekerjaan</th>
                                <th>Kualifikasi</th>
                                <th>Tanggal Berakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activeJobs as $index => $job)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img style="margin-top: 10px" src="{{ asset('uploads/' . $job->img) }}"
                                            width="100" height="100"></td>
                                    <td>{{ $job->jobname }}</td>
                                    <td>{{ $job->deskripsi }}</td>
                                    <td>
                                        <ul>
                                            @foreach (explode("\n", $job->requirement) as $requirement)
                                                <li>{{ $requirement }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($job->close_date)->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton{{ $job->id_job }}">
                                                <a href="{{ route('jobs.show') }}" type="button"
                                                    class="dropdown-item">Lihat</a>
                                                <button type="button" class="dropdown-item" data-toggle="modal"
                                                    data-target="#editJobModal{{ $job->id_job }}">Edit</button>
                                                <form action="{{ route('jobs.hapus', $job) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Job Modal -->
                                <div id="editJobModal{{ $job->id_job }}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Job</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('jobs.update', $job) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label>Nama Posisi</label>
                                                        <input name="jobname" type="text" class="form-control"
                                                            value="{{ $job->jobname }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi Pekerjaan</label>
                                                        <textarea name="deskripsi" class="form-control">{{ $job->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kualifikasi</label>
                                                        <textarea name="requirement" class="form-control">{{ $job->requirement }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Posting</label>
                                                        <input name="tgl_posting" type="date" class="form-control"
                                                            value="{{ $job->tgl_posting }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Berakhir</label>
                                                        <input name="close_date" type="date" class="form-control"
                                                            value="{{ $job->close_date }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Perusahaan</label>
                                                        <input name="company_name" type="text" class="form-control"
                                                            value="{{ $job->company_name }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Lokasi</label>
                                                        <input name="location" type="text" class="form-control"
                                                            value="{{ $job->location }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tipe Pekerjaan</label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="tipe_pekerjaan" id="part_time" value="Part Time"
                                                                {{ $job->tipe_pekerjaan == 'Part Time' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="part_time">Part
                                                                Time</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="tipe_pekerjaan" id="full_time" value="Full Time"
                                                                {{ $job->tipe_pekerjaan == 'Full Time' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="full_time">Full
                                                                Time</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Durasi</label>
                                                        <input name="durasi" type="text" class="form-control"
                                                            value="{{ $job->durasi }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gaji</label>
                                                        <input name="salary" type="number" class="form-control"
                                                            step="any" value="{{ $job->salary }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Job Modal -->
        <div id="addJobModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Job Baru</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama Posisi</label>
                                <input name="jobname" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Pekerjaan</label>
                                <textarea name="deskripsi" type='text' class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Kualifikasi</label>
                                <textarea name="requirement" type='text' class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Posting</label>
                                <input name="tgl_posting" type="datetime-local" class="form-control"
                                    value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Berakhir</label>
                                <input name="close_date" type="date" class="form-control" required>
                            </div>
                            <!-- Menampilkan pesan error di luar form -->
                            @if ($errors->has('close_date'))
                                <div class="alert alert-danger mt-3" id="closeDateError">
                                    <strong>Gagal:</strong> {{ $errors->first('close_date') }}. Silakan masukkan tanggal
                                    yang valid.
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input name="company_name" type="text" class="form-control"
                                    value="PT. Djileena Sukses Makmur" readonly>
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input name="location" type="text" class="form-control" value="Slawi, Jawa Tengah"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Tipe Pekerjaan</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipe_pekerjaan" id="part_time"
                                        value="Part Time">
                                    <label class="form-check-label" for="part_time">Part Time</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipe_pekerjaan" id="full_time"
                                        value="Full Time">
                                    <label class="form-check-label" for="full_time">Full Time</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Durasi</label>
                                <input name="durasi" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Gaji</label>
                                <input name="salary" type="number" class="form-control" step="any">
                            </div>
                            <div class="form-group">
                                <label>Job Image</label>
                                <input name="img" type="file" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan JavaScript untuk menyembunyikan pesan setelah 5 detik -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorAlert = document.getElementById('closeDateError');
            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 10000); // 5000 milidetik = 5 detik
            }
        });
    </script>
@endsection
