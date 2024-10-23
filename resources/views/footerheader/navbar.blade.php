<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>

    <nav class="navbar sticky-top bg-body-tertiary d-flex justify-content-between p-2" style="background: linear-gradient(90deg, #0D426C 22.99%, #338CC1 95.86%); width: 100%;">

        <div class="d-flex align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{asset('images/logo.png')}}" alt="Logo" width="200" height="auto" class="d-inline-block align-text-center me-3 ">

            </a>
            <button class="btn btn-primary mt-4 ms-4 mb-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="background: none; border:none;">
                <img src="{{asset('images/navbar menu/navbar icon.png')}}">
            </button>
        </div>


        
        <div class="d-flex align-items-center me-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <a href="{{ route('logout') }}" class="text-decoration-none d-flex align-items-center">
                <img src="{{asset('images/navbar menu/logout.png')}}" alt="Logout Icon">
                <span class="logout-text ms-2" style="color:white">Logout</span>
            </a>
        </div>
    </form>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="background: var(--Linear-Gradient, linear-gradient(180deg, #0D426C 12.3%, #338CC1 62%, #BDE5FF 100%)); backdrop-filter: blur(2px); backdrop-filter: blur(2px); color:#FFFFFF">
            <button type="button" class="mt-5 me-5 d-flex justify-content-end" data-bs-dismiss="offcanvas" aria-label="Close" style="background: none; border:none; outline:none">
                <img src="{{asset('images/navbar menu/navbar icon.png')}}" alt="">
            </button>
            <div class="offcanvas-header d-flex flex-column align-items-center text-align-center">
                @auth
                <img src="{{asset('images/profile.png')}}" class="m-4">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{ auth()->user()->username }}</h5>
                <p>{{ auth()->user()->nama_role }}</p>
                @endauth
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-start align-items-center">
                <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center m-2 mb-5" style="width: 257px; height: 62px; flex-shrink: 0; border-radius: 90px;background: #3378AA; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);border:none"><strong>TAMBAH RESEP</strong> <img src="{{asset('images/tambah resep icon.png')}}" class="ms-4" style="width: 45px; height:45px"></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <svg width="30" height="27" viewBox="0 0 30 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-4">
                    <path d="M11.8331 25.0835V17.1668H18.1665V25.0835C18.1665 25.9543 18.879 26.6668 19.7498 26.6668H24.4998C25.3706 26.6668 26.0831 25.9543 26.0831 25.0835V14.0001H28.7748C29.5031 14.0001 29.8515 13.0976 29.2973 12.6226L16.0606 0.700137C15.459 0.161803 14.5406 0.161803 13.939 0.700137L0.702289 12.6226C0.163956 13.0976 0.496456 14.0001 1.22479 14.0001H3.91646V25.0835C3.91646 25.9543 4.62896 26.6668 5.49979 26.6668H10.2498C11.1206 26.6668 11.8331 25.9543 11.8331 25.0835Z" fill="white"/>
                    </svg> <strong>Beranda</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/obat icon.png')}}" class="me-4" style="width: 30px; height:30px"><strong>Obat</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/home icon.png')}}" class="me-4" style="width: 30px; height:30px"><strong>Pasien</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/obat icon.png')}}" class="me-4" style="width: 30px; height:30px"><strong>Rawat Inap</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/navbar menu/list pasien.png')}}" class="me-4" style="width: 30px; height:30px"><strong>List Pasien</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/navbar menu/riwayat pasien.png')}}" class="me-4" style="width: 30px; height:30px"><strong>Riwayat Pasien</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/navbar menu/list pasien.png')}}" class="me-4" style="width: 30px; height:30px"><strong>Apoteker</strong></button>
                <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2" > <img src="{{asset('images/navbar menu/riwayat pasien.png')}}" class="me-4" style="width: 30px; height:30px"><strong>Pengawas</strong></button>
            </div>

    </nav>
    <div class="m-5">@yield('content')</div>

</body>
</html>
