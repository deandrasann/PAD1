<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/logo simple" href="images/pavicon.png">
    <title>apotech.id</title>
</head>

{{-- Navbar --}}
<nav class="navbar sticky-top bg-body-tertiary px-4 py-2" style="background: linear-gradient(90deg, #0D426C 22.99%, #338CC1 95.86%); width: 100%;">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Left Section: Sidebar Toggle & Logo -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="150" height="auto" class="me-3">
            </a>
            <!-- Sidebar Toggle Icon -->
            <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('images/navbar menu/navbar icon.png') }}" alt="Menu">
            </a>
        </div>

        <div class="d-flex align-items-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="{{ route('logout') }}" class="text-decoration-none d-flex align-items-center">
                    <img src="{{ asset('images/navbar menu/logout.png') }}" alt="Logout Icon" class="icon">
                    <span class="logout-text text-white">Logout</span>
                </a>
            </form>
        </div>
    </div>
</nav>


{{-- Sidebar --}}

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto px-0">
            <div id="sidebar" class="collapse collapse-horizontal show border-end">
                <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100"
                    style="background: var(--Linear-Gradient, linear-gradient(180deg, #0D426C 12.3%, #338CC1 62%, #BDE5FF 100%)); backdrop-filter: blur(2px); backdrop-filter: blur(2px); color:#FFFFFF">
                    <div class="offcanvas-header d-flex flex-column align-items-center text-align-center m-4">
                        @auth
                            @if (Auth::user()->nama_role == 'apoteker')
                                <!-- Jika role 'apoteker', periksa apakah foto ada -->
                                @if (Auth::user()->apoteker && Auth::user()->apoteker->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->apoteker->foto) }}" class="m-4"
                                        width="200px" height="200px">
                                @else
                                    <img src="{{ asset('images/user_profile1.png') }}" class="m-4" width="200px"
                                        height="200px">
                                @endif
                            @elseif (Auth::user()->nama_role == 'pengawas')
                                <!-- Jika role 'pengawas', periksa apakah foto ada -->
                                @if (Auth::user()->pengawas && Auth::user()->pengawas->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->pengawas->foto) }}" class="m-4"
                                        width="200px" height="200px">
                                @else
                                    <img src="{{ asset('images/user_profile1.png') }}" class="m-4" width="200px"
                                        height="200px">
                                @endif
                            @else
                                <!-- Untuk role lainnya, tampilkan foto default -->
                                <img src="{{ asset('images/user_profile1.png') }}" alt="" width="200px"
                                    height="200px">
                            @endif
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{ auth()->user()->username }}</h5>
                            <p>{{ auth()->user()->nama_role }}</p>
                        @endauth
                    </div>

                    @can('apoteker')
                    <a href="{{ route('tambah-resep') }}" type="button"
                        class="btn btn-primary d-flex justify-content-center align-items-center m-4"
                        style="flex-shrink: 0; border-radius: 90px;background: #3378AA; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);border:none"><strong>TAMBAH
                            RESEP</strong> <img src="{{ asset('images/tambah resep icon.png') }}" class="ms-4"
                            style="width: 45px; height:45px">
                    </a>
                    @endcan

                @can('admin+apoteker+pengawas')
                <a href ="{{ route('beranda') }}"
                    class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4
                    {{request()->routeIs('beranda') ? 'active' : '' }}">
                    <img src="{{ asset('images/home icon.png') }}" class="me-4" style="width: 30px; height:30px">
                    <strong>Beranda</strong>
                </a>
                @endcan
                    @can('apoteker')
                        <a href ="{{ route('daftar-obat') }}" type="button"
                            class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                src="{{ asset('images/obat icon.png') }}" class="me-4"
                                style="width: 30px; height:30px"><strong>Obat</strong></a>
                    @endcan
                    @can('apoteker')
                        <a href ="{{ route('daftar-pasien') }}" type="button"
                            class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                src="{{ asset('images/pasien icon.png') }}" class="me-4"
                                style="width: 24px; height:24px"><strong>Pasien</strong></a>
                    @endcan
                    @can('apoteker')
                        <a href ="{{ route('riwayat-resep') }}" type="button"
                            class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                src="{{ asset('images/riwayat resep.png') }}" class="me-4"
                                style="width: 24px; height:24px"><strong>Riwayat Resep</strong></a>
                    @endcan
                    @can('pengawas')
                        <a href ="{{ route('pmo-daftar-pasien') }}" type="button"
                            class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                                style="width: 30px; height:30px"><strong>List Pasien</strong></button>
                        @endcan
                        @can('pengawas')
                            <a href ="{{ route('riwayat-pasien-PMO') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images/navbar menu/riwayat pasien.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Riwayat Pasien</strong></a>
                        @endcan
                        @can('admin')
                            <a href ="{{ route('jumlah-apoteker') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Apoteker</strong></a>
                        @endcan
                        @can('admin')
                            <a href ="{{ route('jumlah-pengawas') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images/navbar menu/riwayat pasien.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Pengawas</strong></a>
                        @endcan
                        @can('apoteker')
                        <a href ="{{ route('rawat-jalan') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images\carbon_cabin-care.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Rawat Jalan</strong>
                        </a>
                        @endcan
                        @can('apoteker')
                        <a href ="{{ route('view-pasien-dokter') }}" type="button"
                            class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                            src="{{ asset('images/pasien icon.png') }}" class="me-4"
                            style="width: 30px; height:30px"><strong>Pasien</strong></a>
                        @endcan


                </div>
            </div>
        </div>
        <main class="col ps-md-2 pt-2">

            <body>
                <div class="body m-5">@if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; right: 10px; top: 10px;"></button>
                    </div>
                    @elseif($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @yield('content')</div>
            </body>
        </main>


</html>
