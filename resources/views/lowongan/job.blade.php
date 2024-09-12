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
                                <h2>Get your job</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- single-job-content -->
                                @foreach ($activeJobs as $job)
                                    @if ($job->status === 'Active')
                                        <!-- single-job-content -->
                                        <div class="single-job-items mb-30">
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
                                                <a href="{{ route('detail', $job->jobname) }}">Full Time</a>
                                                <!-- Tampilkan waktu yang lalu untuk job saat ini -->
                                                @php
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
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
        <!--Pagination Start  -->
        <!--<div class="pagination-area pb-115 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap d-flex justify-content-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                        <li class="page-item active">
                                            <a class="page-link" href="#">01</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">02</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">03</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="ti-angle-right"></span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        <!--Pagination End  -->
    </main>
@endsection
