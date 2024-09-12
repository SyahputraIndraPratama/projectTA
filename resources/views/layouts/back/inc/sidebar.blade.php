<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-4">
                <a class="nav-link" href="{{ '/admin/home' }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Beranda
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-database"></i></i></div>
                    Master Data
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('/admin/provinsi') }}">Provinsi</a>
                        <a class="nav-link" href="{{ url('/admin/kabupaten') }}">Kabupaten</a>
                        <a class="nav-link" href="{{ url('/admin/kecamatan') }}">Kecamatan</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-globe"></i></div>
                    Perusahaan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('/admin/jabatan') }}">Jabatan</a>
                        <a class="nav-link" href="{{ url('/admin/bagian') }}">Bagian</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ url('/admin/pegawai') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                    Pegawai
                </a>
                {{-- <a class="nav-link" href="{{ url('/admin/absensi') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                    Absensi
                </a> --}}
            </div>
        </div>
    </nav>
</div>
