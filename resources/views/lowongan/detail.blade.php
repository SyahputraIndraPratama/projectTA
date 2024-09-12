@extends('frontend.layouts')

@section('container')
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center"
                data-background="{{ asset('img/hero/about.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>{{ $job->jobname }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-8 col-lg-10">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img">
                                    <a><img src="{{ asset('uploads/' . $job->img) }}" alt="" /></a>
                                </div>
                                <div class="job-tittle">
                                    <a>
                                        <h4>{{ $job->jobname }}</h4>
                                    </a>
                                    <ul>
                                        <li>{{ $job->company_name }}</li>
                                        <li><i class="fas fa-map-marker-alt"></i>{{ $job->location }}</li>
                                        <li>{{ formatRupiah($job->salary) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- job single End -->

                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Deskripsi Pekerjaan</h4>
                                </div>
                                <p>
                                    {{ $job->deskripsi}}
                                </p>
                            </div>
                            <div class="post-details2 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Kualifikasi</h4>
                                </div>
                                <ul>
                                    @foreach (explode("\n", $job->requirement) as $requirement)
                                        <li>{!! $requirement !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- <div class="post-details2 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Education + Experience</h4>
                                </div>
                                <ul>
                                    <li>Min. Pendidikan SMP/SMA/Sederajat</li>
                                    <li>Pengalaman Minimal 3 tahun sebagai Chef (ditunjukkan dengan
                                        portfolio)</li>
                                    <li>Menguasai makanan international dan ahli masak memakai wok</li>
                                    <li>Menguasai bahasa pemograman back end seperti PHP/Phyton/java</li>
                                    <li>Jujur, disiplin, rajin, terampil, dan mau belajar</li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Overview</h4>
                            </div>
                            <ul>
                                <li>Tanggal Posting : <span>{{ \Carbon\Carbon::parse($job->tgl_posting)->format('d M Y') }}</span></li>
                                <li>Lokasi : <span>{{ $job->location }}</span></li>
                                <li>Tipe Pekerjaan : <span>{{ $job->tipe_pekerjaan }}</span></li>
                                <li>Tanggal Berakhir : <span>{{ \Carbon\Carbon::parse($job->close_date)->format('d M Y') }}</span>
                                </li>
                            </ul>
                            <div class="apply-btn2">
                                <a href="{{ route('formjob.index', $job->jobname) }}" class="btn">Apply Now</a>
                            </div>
                        </div>
                        <div class="post-details4 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Informasi Perusahaan</h4>
                            </div>
                            <span>Djileena Sukses Makmur</span>
                            <ul>
                                <li>Name: <span>Djileena Sukses </span></li>
                                <li>Web : <span> djileenasukses.com</span></li>
                                <li>Email: <span>carrier.djileena@gmail.com</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->
    </main>
@endsection
