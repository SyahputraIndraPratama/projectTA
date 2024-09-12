<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-4">
                <a class="nav-link" href="{{ url('/hrd/home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Beranda
                </a>
                <a class="nav-link" href="{{ url('/hrd/pegawai') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                    Pegawai
                </a>
                {{-- <a class="nav-link" href="{{ url('/hrd/absensi') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                    Absensi
                </a> --}}
                {{-- <a class="nav-link" href="{{ url('/hrd/jobapply') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-door-open"></i></div>
                    Lamaran Masuk
                </a> --}}
                </a><a class="nav-link" href="{{ url('/hrd/kelola_job') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase"></i></div>
                    Kelola Lowongan
                </a>
                </a><a class="nav-link" href="{{ url('/hrd/kelola_job/interview') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bullhorn"></i></div>
                    Wawancara
                </a>
                </a><a class="nav-link" href="{{ url('/hrd/payroll') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Gaji Karyawan
                </a>
            </div>
        </div>
    </nav>
</div>
