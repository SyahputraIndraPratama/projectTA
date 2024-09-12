@extends('hrd.app')

@section('title', 'HRD - Schedule Interview')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penjadwalan Wawancara</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Wawancara</a> / <a href="/hrd/home">Beranda</a>
                </h6>
            </div>
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12 col-lg-12">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table shadow-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Tempat</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>PIC</th>
                                                <th>Telp PIC</th>
                                                <th>Aksi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $index => $schedule)
                                                @php
                                                    $tanggal = \Carbon\Carbon::parse($schedule->tanggal);
                                                    $tgl = $tanggal->format('D, d F Y');
                                                    $waktu = $tanggal->format('H:i');
                                                @endphp
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $schedule->alamat }}</td>
                                                    <td>{{ $tgl }}</td>
                                                    <td>{{ $waktu }}</td>
                                                    <td>{{ $schedule->pic }}</td>
                                                    <td>{{ $schedule->telp }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            @if ($schedule->job_status !== 'accepted')
                                                                <form
                                                                    action="{{ route('applications.accept', $schedule->id_interview) }}"
                                                                    method="POST"
                                                                    style="display:inline; margin-left: 10px;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success"
                                                                        onclick="return confirm('Are you sure to accept?')">Accept</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($schedule->job_status == 'interview')
                                                            <span class="badge badge-info">Interview</span>
                                                        @elseif($schedule->job_status == 'rejected')
                                                            <span class="badge badge-danger">Tidak
                                                                diterima</span>
                                                        @elseif($schedule->job_status == 'accepted')
                                                            <span class="badge badge-success">Diterima</span>
                                                        @else
                                                            <span class="badge badge-warning">Belum
                                                                ditanggapi</span>
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
