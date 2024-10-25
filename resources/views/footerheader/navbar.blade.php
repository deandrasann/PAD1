<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
        < script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" >
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </script>


</head>

<nav class="navbar sticky-top bg-body-tertiary d-flex justify-content-between p-2"
    style=" background: linear-gradient(90deg, #0D426C 22.99%, #338CC1 95.86%); width: 100%;">

    <div class="d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="200" height="auto"
                class="d-inline-block align-text-center me-3 ">

        </a>
        <button class="btn btn-primary mt-4 ms-4 mb-4" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"
            style="background: none; border:none;">
            <img src="{{ asset('images/navbar menu/navbar icon.png') }}">
        </button>
    </div>



    <div class="d-flex align-items-end me-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="{{ route('logout') }}" class="text-decoration-none d-flex align-items-center">
                <img src="{{ asset('images/navbar menu/logout.png') }}" alt="Logout Icon">
                <span class="logout-text ms-2" style="color:white">Logout</span>
            </a>
    </div>
    </form>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel"
        style="background: var(--Linear-Gradient, linear-gradient(180deg, #0D426C 12.3%, #338CC1 62%, #BDE5FF 100%)); backdrop-filter: blur(2px); backdrop-filter: blur(2px); color:#FFFFFF">
        <button type="button" class="mt-5 me-5 d-flex justify-content-end" data-bs-dismiss="offcanvas"
            aria-label="Close" style="background: none; border:none; outline:none">
            <img src="{{ asset('images/navbar menu/navbar icon.png') }}" alt="">
        </button>

        <div class="offcanvas-header d-flex flex-column align-items-center text-align-center">
            @auth
                <img src="{{ asset('images/profile.png') }}" class="m-4">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{ auth()->user()->username }}</h5>
                <p>{{ auth()->user()->nama_role }}</p>
            @endauth
        </div>

        <div class="offcanvas-body d-flex flex-column justify-content-start align-items-center">
            <a href="{{ route('tambah-resep') }}" type="button"
                class="btn btn-primary d-flex justify-content-center align-items-center m-2 mb-5"
                style="width: 257px; height: 62px; flex-shrink: 0; border-radius: 90px;background: #3378AA; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);border:none"><strong>TAMBAH
                    RESEP</strong> <img src="{{ asset('images/tambah resep icon.png') }}" class="ms-4"
                    style="width: 45px; height:45px"></a>
            @can('admin+apoteker+pengawas')
            <a href ="{{ route('beranda') }}" type="button"
                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/home icon.png') }}" class="me-4" style="width: 30px; height:30px">
                <strong>Beranda</strong></a>
            @endcan
            @can('admin+apoteker')
            <a href ="{{ route('daftar-obat') }}" type="button"
                class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/obat icon.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Obat</strong></a>
            @endcan
            @can('admin+apoteker')
            <a href ="{{ route('daftar-pasien') }}" type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/home icon.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Pasien</strong></a>
            @endcan
            @can('apoteker')
            <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/obat icon.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Riwayat Resep</strong></button>
            @endcan
            @can('admin+pengawas')
            <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>List Pasien</strong></button>
            @endcan
            @can('admin+pengawas')
            <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/riwayat pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Riwayat Pasien</strong></button>
            @endcan
            @can('admin')
            <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Apoteker</strong></button>
                    @endcan
            @can('admin')
            <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/riwayat pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Pengawas</strong></button>
                    @endcan
        </div>
</nav>

<body>

    <div class="body m-5">@yield('content')</div>

</body>

</html>
