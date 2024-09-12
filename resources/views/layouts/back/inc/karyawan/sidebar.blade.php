<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-4">
                <a class="nav-link" href="{{ '/karyawan/dashboard' }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                {{-- <a class="nav-link" href="{{ url('/karyawan/absensi') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                    Absensi
                </a> --}}
                </a><a class="nav-link" href="{{ url('/karyawan/payroll') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Histori Pembayaran
                </a>
            </div>
        </div>
    </nav>
</div>
