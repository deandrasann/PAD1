<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- link styles --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/logo simple" href="images/pavicon.png">
    {{-- scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>apotech.id</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar sticky-top bg-body-tertiary px-4 py-2"
        style="background: linear-gradient(90deg, #0D426C 22.99%, #338CC1 95.86%); width: 100%;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Left Section: Sidebar Toggle & Logo -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="150" height="auto"
                        class="me-3">
                </a>
                <!-- Sidebar Toggle Icon -->
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                    class="navbar-brand d-flex align-items-center">
                    <img src="{{ asset('images/navbar menu/navbar icon.png') }}" alt="Menu">
                </a>
            </div>

            <div class="d-flex align-items-center">
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf --}}
                    <a href="#" id="logoutButton" class="text-decoration-none d-flex align-items-center">
                        <img src="{{ asset('images/navbar menu/logout.png') }}" alt="Logout Icon" class="icon">
                        <span class="logout-text text-white">Logout</span>
                    </a>
                {{-- </form> --}}
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    <div class="container-fluid">
        <div class="row ">
            <div class="col-auto px-0">
                <div id="sidebar" class="collapse collapse-horizontal show border-end h-100 w-100 min-vh-100">
                    <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start h-100 w-100 min-vh-100"
                        style="height: 100vh; background: var(--Linear-Gradient, linear-gradient(180deg, #0D426C 12.3%, #338CC1 62%, #BDE5FF 100%)); backdrop-filter: blur(2px); backdrop-filter: blur(2px); color:#FFFFFF">
                        <div class="offcanvas-header d-flex flex-column align-items-center text-align-center m-4">
                            @auth
                                @if (Auth::user()->nama_role == 'apoteker')
                                    <!-- Jika role 'apoteker', periksa apakah foto ada -->
                                    @if (Auth::user()->apoteker && Auth::user()->apoteker->foto)
                                        <img src="{{ asset('storage/' . Auth::user()->apoteker->foto) }}" class="m-4"
                                            width="144px" height="128px">
                                    @else
                                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="m-4"
                                            width="144px" height="auto">
                                    @endif
                                @elseif (Auth::user()->nama_role == 'pengawas')
                                    <!-- Jika role 'pengawas', periksa apakah foto ada -->
                                    @if (Auth::user()->pengawas && Auth::user()->pengawas->foto)
                                        <img src="{{ asset('storage/' . Auth::user()->pengawas->foto) }}" class="m-4"
                                            width="144px" height="128px">
                                    @else
                                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="m-4"
                                            width="144px" height="128px">
                                    @endif
                                @elseif (Auth::user()->nama_role == 'admin')
                                    <!-- Jika role 'admin', periksa apakah foto ada -->
                                    @if (Auth::user()->admin && Auth::user()->admin->foto)
                                        <img src="{{ asset('storage/' . Auth::user()->admin->foto) }}" class="m-4"
                                            width="144px" height="128px">
                                    @else
                                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="m-4"
                                            width="144px" height="128px">
                                    @endif
                                @elseif (Auth::user()->nama_role == 'dokter')
                                    <!-- Jika role 'dokter', periksa apakah foto ada -->
                                    @if (Auth::user()->dokter && Auth::user()->dokter->foto)
                                        <img src="{{ asset('storage/' . Auth::user()->dokter->foto) }}" class="m-4"
                                            width="144px" height="128px">
                                    @else
                                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="m-4"
                                            width="144px" height="128px">
                                    @endif
                                @elseif (Auth::user()->nama_role == 'resepsionis')
                                    <!-- Jika role 'resepsionis', periksa apakah foto ada -->
                                    @if (Auth::user()->resepsionis && Auth::user()->resepsionis->foto)
                                        <img src="{{ asset('storage/' . Auth::user()->resepsionis->foto) }}" class="m-4"
                                            width="144px" height="128px">
                                    @else
                                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="m-4"
                                            width="144px" height="128px">
                                    @endif
                                @elseif (Auth::user()->nama_role == 'pasien')
                                    <!-- Jika role 'pasien', periksa apakah foto ada -->
                                    @if (Auth::user()->pasien && Auth::user()->pasien->foto)
                                        <img src="{{ asset('storage/' . Auth::user()->pasien->foto) }}" class="m-4"
                                            width="144px" height="128px">
                                    @else
                                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="m-4"
                                            width="144px" height="128px">
                                    @endif
                                @else
                                    <!-- Untuk role lainnya, tampilkan foto default -->
                                    <img src="{{ asset('images/ix_user-profile-filled.png') }}" alt=""
                                        width="144px" height="128px">
                                @endif
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{ auth()->user()->username }}
                                </h5>
                                <p>{{ auth()->user()->nama_role }}</p>
                            @endauth
                        </div>

                        @can('apoteker')
                            <a href="{{ route('tambah-resep') }}" type="button"
                                class="btn btn-primary d-flex justify-content-center align-items-center m-4"
                                style="flex-shrink: 0; border-radius: 90px;background: #3378AA; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);border:none"><strong>KELOLA
                                    RESEP</strong> <img src="{{ asset('images/tambah resep icon.png') }}" class="ms-4"
                                    style="width: 45px; height:45px">
                            </a>
                        @endcan

                        @can('admin+apoteker+pengawas+resepsionis')
                            <a href="{{ route('beranda') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4 {{ request()->routeIs('beranda') ? 'active' : '' }}">
                                <i class="fa-solid fa-house ms-4 me-4"></i>
                                <strong>Beranda</strong>
                            </a>
                        @endcan

                        @can('dokter')
                            <a href="{{ route('beranda') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4 {{ request()->routeIs('beranda') ? 'active' : '' }}">
                                <i class="fa-solid fa-house  ms-4 me-4"></i>
                                <strong>Beranda</strong>
                            </a>
                        @endcan

                        @can('apoteker')
                            <a href="{{ route('daftar-obat') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4 {{ request()->routeIs('daftar-obat') ? 'active' : '' }}">
                                <i class="fa-solid fa-capsules  ms-4 me-4"></i>
                                <strong>Obat</strong>
                            </a>
                        @endcan

                        @can('apoteker')
                            <a href="{{ route('daftar-pasien') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4   {{ request()->routeIs('daftar-pasien') ? 'active' : '' }}">
                                <i class="fa-solid fa-user ms-4 me-4"></i> <strong>Pasien</strong></a>
                        @endcan

                        @can('apoteker')
                            <a href="{{ route('riwayat-resep') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4 {{ request()->routeIs('riwayat-resep') ? 'active' : '' }}">
                                <i class="fa-solid fa-file-medical ms-4 me-4"></i><strong>Riwayat Resep</strong></a>
                        @endcan

                        @can('pengawas')
                            <a href="{{ route('pmo-daftar-pasien') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>List Pasien</strong></a>
                        @endcan

                        @can('pengawas')
                            <a href="{{ route('riwayat-pasien-PMO') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images/navbar menu/riwayat pasien.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Riwayat Pasien</strong></a>
                        @endcan

                        @can('admin')
                            <a href="{{ route('jumlah-apoteker') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Apoteker</strong></a>
                        @endcan

                        @can('admin')
                            <a href="{{ route('jumlah-resepsionis') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <i class="fa fa-users fa-2xl me-4" aria-hidden="true"></i><strong>Resepsionis</strong></a>
                        @endcan

                        @can('admin')
                            <a href="{{ route('jumlah-dokter') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <i class="fa fa-user-md fa-2xl me-4" aria-hidden="true"></i>
                            <strong>Dokter</strong></a>
                        @endcan

                        @can('dokter')
                            <a href="{{ route('rawat-jalan') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                    src="{{ asset('images\carbon_cabin-care.png') }}" class="me-4"
                                    style="width: 30px; height:30px"><strong>Rawat Jalan</strong>
                            </a>
                        @endcan

                        @can('dokter')

                            @php
                                $dokterid = Auth::user()->dokter->id_dokter;

                                $pemeriksaanAwal = DB::table('pemeriksaan_awal')
                                    ->where('id_dokter', $dokterid)
                                    ->orderByDesc('created_at')
                                    ->first();
                            @endphp
                            @if ($pemeriksaanAwal)
                                {{-- {{ dd($dokterid) }} --}}
                                <a href="{{ route('view-pasien-dokter', ['id_dokter' => $pemeriksaanAwal->id_dokter]) }}"
                                    type="button"
                                    class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4"> <img
                                        src="{{ asset('images/pasien icon.png') }}" class="me-4"
                                        style="width: 30px; height:30px"><strong>Pasien Dokter </strong></a>
                            @else
                                <div class="mx-4 mt-3"
                                    style="border-radius: 12px; padding: 12px 16px; background: linear-gradient(90deg, #007BFF, #00BFFF); color: white;">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-circle-info me-2 fs-5"></i>
                                        <div>
                                            <strong>Data Tidak Ditemukan:</strong><br>
                                            Belum ada data pemeriksaan <br>yang <strong>selesai</strong> untuk dokter ini.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endcan

                        {{-- haruse resepsionis --}}
                        @can('resepsionis')
                            <a href="{{ route('resepsionis') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4 {{ request()->routeIs('resepsionis') ? 'active' : '' }}">
                                <i class="fa-solid fa-user ms-4 me-4"></i>
                                <strong>Pasien Resepsionis</strong>
                            </a>
                        @endcan

                         {{-- @can('resepsionis')
                            <a href="{{ route('resepsionis') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4 {{ request()->routeIs('resepsionis') ? 'active' : '' }}">
                                <i class="fa-solid fa-user ms-4 me-4"></i>
                                <strong>Tambah Akun Pasien</strong>
                            </a>
                        @endcan --}}

                        @can('resepsionis')
                            <a href="{{ route('daftar-pasien') }}" type="button"
                                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2 mx-4   {{ request()->routeIs('daftar-pasien') ? 'active' : '' }}">
                                <i class="fa-solid fa-user ms-4 me-4"></i> <strong>Tambah Akun Pasien</strong></a>
                        @endcan


                    </div>
                </div>
            </div>

            <main class="col ps-md-2 pt-2">
                <div class="body m-5">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                style="position: absolute; right: 10px; top: 10px;"></button>
                        </div>
                    @elseif($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
    <script>
$(document).ready(function () {
    // Pengaturan global untuk menyertakan CSRF token di semua request AJAX
    // Ini PENTING untuk request POST ke Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Event listener saat elemen dengan id="logoutButton" diklik
    $('#logoutButton').on('click', function(event) {
        // Mencegah aksi default dari link (yaitu pindah halaman)
        event.preventDefault();

        // Kirim request POST ke route 'logout'
        $.ajax({
            url: '{{ route("logout") }}', // URL dari API logout Anda
            method: 'POST',
            success: function(response) {
                // Jika server merespons dengan sukses (logout berhasil)
                console.log(response.message); // Pesan: "Successfully logged out"
                
                // Arahkan pengguna ke halaman login
                window.location.href = '/login'; // Ganti jika URL login Anda berbeda
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Jika ada error (misal: sesi sudah habis atau error server)
                console.error('Logout failed:', errorThrown);
                
                // Sebagai fallback, tetap arahkan ke halaman login
                alert('Gagal melakukan logout. Mengarahkan kembali ke halaman login.');
                window.location.href = '/login';
            }
        });
    });
});
</script>
</body>
</html>
