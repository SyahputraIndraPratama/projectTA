@extends('frontend.layouts')

@section('container')
    <main>
        <!-- slider Area Start-->
        <div class="slider-area">
            <!-- Mobile Menu -->
            <div class="slider">
                <div class="single-slider slider-height d-flex align-items-center"
                    data-background="{{ 'img/icon/logo-icon_3.png' }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-9 col-md-10">
                                <div class="hero__caption">
                                    <h1>WELCOME</h1>
                                    <h3>Elektronik Human Resource Manangement</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!-- Our Services Start -->
        <div class="our-services section-pad-t30">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <h3>Kategori Job Kami</h3>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-contnet-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-services text-center">
                            <div class="services-ion">
                                <img src="img/hero/chef.png" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="">Chef</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-services text-center">
                            <div class="services-ion">
                                <img src="img/hero/fisherman.png" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="">Fishing Master</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-services text-center">
                            <div class="services-ion">
                                <img src="img/hero/director.png" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="">Skipper</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-services text-center">
                            <div class="services-ion">
                                <img src="img/hero/engineer.png" alt="">
                            </div>
                            <div class="services-cap">
                                <h5><a href="">Engineer</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- More Btn -->
                <!-- Section Button -->
            </div>
        </div>
        <!-- Our Services End -->

        <!-- Featured_job_start -->
        <section class="featured-job-area feature-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <h3>Pekerjaan Terbaru</h3>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        @foreach ($activeJobs as $job)
                            @if ($job->status === 'Active')
                                <!-- single-job-content -->
                                <div class="single-job-items">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="{{ url('/detail', $job->id) }}"><img
                                                    src="{{ asset('uploads/' . $job->img) }}" alt="" /></a>
                                        </div>
                                        <div class="job-tittle">
                                            <a href="{{ url('/detail', $job->id) }}">
                                                <h4>{{ $job->jobname }}</h4>
                                            </a>
                                            <ul>
                                                <li>{{ $job->company_name }}</li>
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>{{ $job->location }}
                                                </li>
                                                <li>{{ formatRupiah($job->salary) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="{{ route('detail', $job->jobname) }}">{{ $job->tipe_pekerjaan }}</a>
                                        <!-- Tampilkan waktu yang lalu untuk job saat ini -->
                                        @php
                                            \Carbon\Carbon::setLocale('id');
                                            $uploadedAt = Carbon\Carbon::parse($job->created_at);
                                            $timeAgo = $uploadedAt->diffForHumans();
                                        @endphp
                                        <div class="job-item">
                                            <p>{{ $timeAgo }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </section>

        <!-- Featured_job_end -->
        <!-- How  Apply Process Start-->
        <div class="apply-process-area apply-bg pt-150 pb-150" data-background="{{ 'img/gallery/how-applybg.png' }}">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle white-text text-center">
                            <span>Apply process</span>
                            <h2>How it works</h2>
                        </div>
                    </div>
                </div>
                <!-- Apply Process Caption -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center">
                            <div class="process-ion">
                                <span class="flaticon-search"></span>
                            </div>
                            <div class="process-cap">
                                <h5>1. Daftar</h5>
                                <p>
                                    Lakukan pendaftaran di website Djileena Sukses. Dengan cara memilih posisi dan
                                    mengisi form pendaftaran, jangan lupa untuk melampirkan CV.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center">
                            <div class="process-ion">
                                <span class="flaticon-curriculum-vitae"></span>
                            </div>
                            <div class="process-cap">
                                <h5>2. Seleksi</h5>
                                <p>
                                    Proses seleksi ada dua tahap yaitu administrasi dan wawancara. Jika lolos dalam
                                    seleksi administrasi, peserta akan dihubungi untuk melakukan wawancara.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                                <h5>3. Terpilih</h5>
                                <p>
                                    Calon pelamar yang lolos tahap wawancara akan dihubungi oleh Djileena Sukses untuk
                                    menjalani pekerjaan yang dipilih saat pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How  Apply Process End-->


        <div class="lowongan_section"
            style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; margin-top:20px;">
            <div class="lowongan_text" style="flex: 1; padding: 20px 40px; text-align: justify;">
                <h2>Website Lowongan Pekerjaan</h2>
                <p>
                    Selamat datang di halaman Lowongan Kerja Kami! Kami memahami bahwa menemukan pekerjaan yang tepat adalah
                    langkah penting dalam membangun karier yang sukses dan memuaskan. Di sini, Anda memiliki kesempatan
                    untuk mengeksplorasi berbagai peluang karier yang tersedia, mengajukan lamaran, dan mengambil langkah
                    pertama menuju masa depan yang lebih cerah.
                </p>
                <p>
                    Penyediaan informasi lowongan kerja yang akurat dan up-to-date merupakan mekanisme yang efektif untuk
                    membantu para pencari kerja menemukan posisi yang sesuai dengan keahlian dan minat mereka. Setiap
                    kesempatan yang Anda temukan melalui platform ini adalah hasil dari kolaborasi kami dengan berbagai
                    perusahaan terkemuka. Dengan mengetahui kebutuhan dan preferensi Anda, kami dapat menghubungkan Anda
                    dengan peluang yang tepat dan membantu Anda mencapai tujuan karier Anda.
                </p>
                <p>
                    Kami juga percaya bahwa keterbukaan dan akuntabilitas dalam proses rekrutmen adalah kunci untuk
                    menciptakan lingkungan kerja yang inklusif dan responsif terhadap kebutuhan semua calon karyawan. Dengan
                    kerja sama Anda, kami yakin dapat membantu Anda menemukan pekerjaan yang tidak hanya memenuhi kebutuhan
                    finansial, tetapi juga memberikan kepuasan dan pertumbuhan profesional.
                </p>
                <p>
                    Terima kasih atas kepercayaan Anda kepada kami dalam mencari peluang karier yang lebih baik. Kirimkan
                    lamaran Anda hari ini dan jadilah bagian dari perubahan positif yang nyata dalam dunia kerja!
                </p>
            </div>
            <div class="lowongan_img" style="flex: 1;">
                <img src="{{ asset('img/banner/job.png') }}" alt="Gambar Pengaduan Masyarakat"
                    style="width: 100%; height: auto; border-radius: 10px;">
            </div>
        </div>
    </main>
@endsection
