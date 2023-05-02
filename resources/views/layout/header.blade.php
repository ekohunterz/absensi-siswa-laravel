{{-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Absensi</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="nav-link px-3 border-0 bg-primary">Sign out</button>
            </form>

        </div>
    </div>
</header> --}}

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
            </ol>
            {{-- <h6 class="font-weight-bolder mb-0">Dashboard</h6> --}}
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth()->user()->foto)
                            <img src="{{ asset('storage/foto-profil/' . Auth()->user()->foto) }}" alt="Foto Profil"
                                class="rounded-circle me-sm-1" width="25" height="25"
                                style="object-fit: cover;object-position: center;">
                        @else
                            <img src="/assets/img/team-2.jpg" alt="Foto Profil" class="rounded-circle me-sm-1"
                                width="25" height="25" style="object-fit: cover;object-position: center;">
                        @endif
                        <span class="d-sm-inline d-none">{{ Auth()->user()->nama }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-1">
                        <li>
                            <a href="/profile" class="dropdown-item py-2">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}"
                                        class="rounded-circle me-2 order-1" width="50" height="50"
                                        style="object-fit: cover; object-position: center;">
                                    <div class="wrap-text text-center order-2">
                                        <h6 class="mb-0 text-wrap">{{ auth()->user()->nama }}</h6>
                                        <span class="text-muted text-small">
                                            @if (auth()->user()->role == 1)
                                                Admin
                                            @else
                                                Guru - {{ auth()->user()->nip }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dark horizontal my-1">
                        </li>
                        <li>
                            <a href="/ubah_pass" class="dropdown-item py-2"><i class="fa fa-lock me-2"></i> Ubah
                                Password</a>
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item py-2"><i class="fa fa-sign-out me-2"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                {{-- <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
