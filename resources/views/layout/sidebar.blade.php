{{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    @can('admin')
        <div class="position-sticky pt-3 sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">
                        <span data-feather="home" class="align-text-bottom"></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('data_siswa*') ? 'active' : '' }}" href="/data_siswa">
                        <span data-feather="file" class="align-text-bottom"></span>
                        Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/data_guru*') ? 'active' : '' }}" href="/admin/data_guru">
                        <span data-feather="shopping-cart" class="align-text-bottom"></span>
                        Data Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/mapel*') ? 'active' : '' }}" href="/admin/mapel">
                        <span data-feather="users" class="align-text-bottom"></span>
                        Data Mata Pelajaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('jadwal*') ? 'active' : '' }}" href="/jadwal">
                        <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                        Data Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/kelas*') ? 'active' : '' }}" href="/admin/kelas">
                        <span data-feather="layers" class="align-text-bottom"></span>
                        Data Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/jurusan*') ? 'active' : '' }}" href="/admin/jurusan">
                        <span data-feather="layers" class="align-text-bottom"></span>
                        Data Jurusan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/tahun_ajaran*') ? 'active' : '' }}" href="/admin/tahun_ajaran">
                        <span data-feather="layers" class="align-text-bottom"></span>
                        Data Tahun Ajaran
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>Absensi</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle" class="align-text-bottom"></span>
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('data_absen*') ? 'active' : '' }}" href="/data_absen">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Data Absensi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('data_rekap*') ? 'active' : '' }}" href="/data_rekap">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Rekap Absensi
                    </a>
                </li>
            </ul>
        </div>
    @endcan
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('data_siswa*') ? 'active' : '' }}" href="/data_siswa">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Data Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('jadwal*') ? 'active' : '' }}" href="/jadwal">
                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                    Data Jadwal
                </a>
            </li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Absensi</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('guru/absen*') ? 'active' : '' }}" href="/guru/absen">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Absen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('data_absen*') ? 'active' : '' }}" href="/data_absen">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Data Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('data_rekap*') ? 'active' : '' }}" href="/data_rekap">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Rekap Absensi
                </a>
            </li>
        </ul>
    </div>
</nav> --}}

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src="/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">ABSENSI</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    @can('admin')
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('/') ? 'active bg-gradient-primary' : '' }} "
                        href="/">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Data Master</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('data_siswa*') ? 'active bg-gradient-primary' : '' }} "
                        href="/data_siswa">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/data_guru*') ? 'active bg-gradient-primary' : '' }} "
                        href="/admin/data_guru">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">school</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/jurusan*') ? 'active bg-gradient-primary' : '' }} "
                        href="/admin/jurusan">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">badge</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Jurusan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/mapel*') ? 'active bg-gradient-primary' : '' }} "
                        href="/admin/mapel">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">book</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Mata Pelajaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('jadwal*') ? 'active bg-gradient-primary' : '' }} "
                        href="/jadwal">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">schedule</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Jadwal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/kelas*') ? 'active bg-gradient-primary' : '' }} "
                        href="/admin/kelas">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">home</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Kelas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/tahun_ajaran*') ? 'active bg-gradient-primary' : '' }} "
                        href="/admin/tahun_ajaran">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">today</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Tahun Ajaran</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Absensi</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('data_absen*') ? 'active bg-gradient-primary' : '' }} "
                        href="/data_absen">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">ballot</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('data_rekap*') ? 'active bg-gradient-primary' : '' }} "
                        href="/data_rekap">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">timeline</i>
                        </div>
                        <span class="nav-link-text ms-1">Rekap Absensi</span>
                    </a>
                </li>
            </ul>
        </div>
    @else
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('/') ? 'active bg-gradient-primary' : '' }} "
                        href="/">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Data Master</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('data_siswa*') ? 'active bg-gradient-primary' : '' }}"
                        href="/data_siswa">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('jadwal*') ? 'active bg-gradient-primary' : '' }}"
                        href="/jadwal">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">schedule</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Jadwal</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Absensi</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('guru/absen*') ? 'active bg-gradient-primary' : '' }}"
                        href="/guru/absen">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person_pin</i>
                        </div>
                        <span class="nav-link-text ms-1">Absen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('data_absen*') ? 'active bg-gradient-primary' : '' }}"
                        href="/data_absen">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">ballot</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('data_rekap*') ? 'active bg-gradient-primary' : '' }}"
                        href="/data_rekap">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">timeline</i>
                        </div>
                        <span class="nav-link-text ms-1">Rekap Absensi</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan
</aside>
