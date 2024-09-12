@extends('frontend.layouts')

@section('container')
    <div class="container" style="margin-top: 50px; margin-bottom: 70px">
        <h1>Histori Lamaran</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <style>
            .badge-warning {
                background-color: #ffc107;
                color: #000;
            }

            .badge-info {
                background-color: #17a2b8;
                color: #fff;
            }

            .badge-success {
                background-color: #28a745;
                color: #fff;
            }

            .badge-danger {
                background-color: #dc3545;
                color: #fff;
            }

            .badge-secondary {
                background-color: #6c757d;
                color: #fff;
            }

            .thumbnail {
                max-width: 100px;
                max-height: 100px;
            }
        </style>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Posisi</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->jobname }}</td>
                            <td>
                                <p><img src="{{ asset('uploads/' . $application->applicantJobs->img) }}" alt="Gambar Pekerjaan" class="thumbnail"></p>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y') }}</td>
                            <td>
                                @if ($application->status == 'interview')
                                    <span class="badge badge-info">Interview</span>
                                @elseif($application->status == 'rejected')
                                    <span class="badge badge-danger">Tidak diterima</span>
                                @elseif($application->status == 'accepted')
                                    <span class="badge badge-success">Diterima</span>
                                @else
                                    <span class="badge badge-warning">Menunggu Tanggapan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
