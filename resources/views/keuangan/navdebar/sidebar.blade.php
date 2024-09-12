<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-4">
                <a class="nav-link" href="{{ '/keuangan/home' }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Beranda
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapsePengaturan" aria-expanded="false" aria-controls="collapsePengaturan">
                    <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                    Pengaturan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePengaturan" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('/keuangan/settingsgaji') }}">Potongan Gaji</a>
                    </nav>
                </div>
                </a><a class="nav-link" href="{{ url('/keuangan/payroll') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Penggajian
                </a>
            </div>
        </div>
    </nav>
</div>
