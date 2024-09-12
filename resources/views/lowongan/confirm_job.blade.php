@extends('frontend.layouts')

@section('container')
    <style>
        .container.my-5 {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        #o_recruitment_thank_cta .btn {
            margin: 5px;
        }

        img.img {
            max-width: 50%;
            height: auto;
        }

        h1.fw-bolder {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        p.fw-light {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }

        h3.mt-2.mb-3 {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>

    <div class="container my-5">
        <div class="text-center">
            <h1 class="fw-bolder">Selamat!</h1>
            <p class="fw-light">
                Lamaran Anda telah berhasil dikirim<br class="mb-2" />
            </p>
            <img class="img" src="/img/icon/job_congratulations.svg" alt="Congratulations!" />
            <div class="row" id="o_recruitment_thank_cta">
                <div class="col-lg-12 text-center mt-4 mb-5">
                    <p>
                        <span class="h5 fw-light">Sementara itu,</span><br />
                        <span class="h3 mt-2 mb-3 fw-bold">Lihatlah di sekitar situs web kami:</span>
                    </p>
                    <a role="button" href="/" class="btn btn-lg" style="border-radius: 50px">Home</a>
                    <a role="button" href="/history" class="btn btn-lg ms-3" style="border-radius: 50px">Histori</a>
                </div>
            </div>
        </div>
    </div>
@endsection
