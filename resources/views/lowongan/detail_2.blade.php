@extends('frontend.layouts')

@section('container')
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center"
                data-background="{{ 'img/hero/about.jpg' }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>UI UX Design</h2>
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
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        @foreach ($activeJobs as $job)
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
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>{{ $job->location }}
                                            </li>
                                            <li>{{ $job->salary }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- job single End -->

                            <div class="job-post-details">
                                <div class="post-details1 mb-50">
                                    <!-- Small Section Tittle -->
                                    <div class="small-section-tittle">
                                        <h4>Job Description</h4>
                                    </div>
                                    <p>
                                        <li>• Membuat website sesuai spesifikasi</li>
                                        <li>• Maintenance website existing</li>
                                        <li>• Monitoring performa website dan server</li>
                                    </p>
                                </div>
                                <div class="post-details2 mb-50">
                                    <!-- Small Section Tittle -->
                                    <div class="small-section-tittle">
                                        <h4>Required Knowledge, Skills, and Abilities</h4>
                                    </div>
                                    <ul>
                                        <li>Memiliki portofolio website yang masih live/ online (sertakan URL dalam CV)
                                        </li>
                                        <li>Terbiasa membangun website dengan wordpress & woocommerce</li>
                                        <li>Familiar dengan server management seperti cPanel – web develop</li>
                                        <li>Memiliki skill coding PHP, CSS, HTML, Javascript & Codeigniter</li>
                                        <li>Memiliki skill design grafis seperti adobe photoshop/ corel draw/ AI</li>
                                        <li>Memiliki pengetahuan mengenai SEO</li>
                                    </ul>
                                </div>
                                <div class="post-details2 mb-50">
                                    <!-- Small Section Tittle -->
                                    <div class="small-section-tittle">
                                        <h4>Education + Experience</h4>
                                    </div>
                                    <ul>
                                        <li>Pendidikan Minimal S1</li>
                                        <li>Pengalaman Minimal 2 tahun sebagai Full Stack Developer (ditunjukkan dengan
                                            portfolio)</li>
                                        <li>Menguasai HTML, JavaScript, dan CSS.</li>
                                        <li>Menguasai bahasa pemograman back end seperti PHP/Phyton/java</li>
                                        <li>Memahami pengelolaan database seperti MySQL, PostgreSQL atau database relasional
                                            lainnya</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Overview</h4>
                            </div>
                            <ul>
                                <li>Tanggal Posting : <span>{{ $job->created_at->format('d M Y') }}</span></li>
                                <li>Lokasi : <span>{{ $job->location }}</span></li>
                                <li>Job nature : <span>Full time</span></li>
                                <li>Exp date : <span>{{ \Carbon\Carbon::parse($job->close_date)->format('d M Y') }}</span>
                                </li>
                            </ul>
                            <div class="apply-btn2">
                                <a href="{{ url('/form_apply') }}" class="btn">Apply Now</a>
                            </div>
                        </div>
                        <div class="post-details4 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Company Information</h4>
                            </div>
                            <span>Djileena Sukses Makmur</span>
                            <p>
                                It is a long established fact that a reader will be distracted
                                by the readable content of a page when looking at its layout.
                            </p>
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
