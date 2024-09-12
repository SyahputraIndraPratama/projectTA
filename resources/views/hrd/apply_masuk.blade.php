@extends('hrd.app')

@section('title', 'HRD - Lamaran Masuk')

@section('content')
    <main>
        @include('sweetalert::alert')
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($applications->isEmpty())
                <p>Belum ada lamaran kerja yang masuk.</p>
            @else
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Lamaran Masuk</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-black">
                                <a>Lamaran</a> / <a href="/hrd/home">Home</a>
                            </h6>
                        </div>
                        <div class="content-body">
                            <!-- row -->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12 col-lg-12">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table shadow-hover">
                                                    <thead>
                                                        <tr>
                                                            <th><span class="font-w600 text-black fs-16">No</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Nama</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Nama Posisi</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Email</span></th>
                                                            <th><span class="font-w600 text-black fs-16">No. Telepon</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Linkedin</span>
                                                            </th>
                                                            <th><span class="font-w600 text-black fs-16">CV</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Short
                                                                    Introduction</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Aksi</span></th>
                                                            <th><span class="font-w600 text-black fs-16">Status</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($applications as $index => $application)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        {{ $application->name }}</p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        {{ $application->jobname }}</p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        {{ $application->email }}</p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        {{ $application->phone }}</p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        <a href="{{ $application->linkedin }}"
                                                                            target="_blank">View Linkedin</a>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        <a href="{{ asset('resumes/' . $application->resume) }}"
                                                                            target="_blank">View CV</a>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-black mb-1 font-w600">
                                                                        {{ $application->coverletter }}</p>
                                                                </td>
                                                                <td>
                                                                    <div class="button-container">
                                                                        @if ($application->status !== 'rejected' && $application->status !== 'interview' && $application->status !== 'accepted')
                                                                            <form
                                                                                action="{{ route('applications.reject', $application->id) }}"
                                                                                method="POST" style="display:inline;">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-danger"
                                                                                    onclick="return confirm('Are you sure to reject?')">Reject</button>
                                                                            </form>
                                                                        @endif
                                                                        @if ($application->status !== 'interview' && $application->status !== 'rejected' && $application->status !== 'accepted')
                                                                            <div class="btn-container">
                                                                                <a class="btn btn-success"
                                                                                    style="color:white; margin-top:10px"
                                                                                    data-toggle="modal"
                                                                                    data-target="#viewModal{{ $application->id }}">Jadwalkan
                                                                                    Interview</a>
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <!-- Modal for viewing applicant details -->
                                                                    <div id="viewModal{{ $application->id }}"
                                                                        class="modal fade">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">
                                                                                        {{ $application->name }}</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label>Nama Lengkap</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="{{ $application->name }}"
                                                                                            disabled>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>No. Telepon</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="{{ $application->phone }}"
                                                                                            disabled>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Email</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="{{ $application->email }}"
                                                                                            disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-default"
                                                                                        data-dismiss="modal">Tutup</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary"
                                                                                        data-toggle="modal"
                                                                                        data-target="#interviewModal{{ $application->id }}">Jadwalkan
                                                                                        Interview</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal for scheduling an interview -->
                                                                    <div id="interviewModal{{ $application->id }}"
                                                                        class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Jadwalkan
                                                                                        interview</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('interview.schedule', $application->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="id"
                                                                                            value="{{ $application->id }}">
                                                                                        <div class="form-group">
                                                                                            <label>Nama Lengkap</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="namas"
                                                                                                value="{{ $application->name }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Email</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="email"
                                                                                                value="{{ $application->email }}"
                                                                                                disabled>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Tempat (alamat lengkap
                                                                                                tempat bertemu)</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="alamat" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Tanggal dan waktu</label>
                                                                                            <input type="datetime-local"
                                                                                                class="form-control"
                                                                                                name="tanggal" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Bertemu dengan
                                                                                                (PIC)
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="pic" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>No Telp PIC</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="telp" required>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-default"
                                                                                                data-dismiss="modal">Batal</button>
                                                                                            <input type="submit"
                                                                                                name="schedule"
                                                                                                class="btn btn-primary"
                                                                                                value="Jadwalkan">
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @if ($application->status == 'interview')
                                                                        <span class="badge badge-info">Interview</span>
                                                                    @elseif($application->status == 'rejected')
                                                                        <span class="badge badge-danger">Tidak
                                                                            diterima</span>
                                                                    @elseif($application->status == 'accepted')
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
            @endif
        </div>
    </main>
@endsection
