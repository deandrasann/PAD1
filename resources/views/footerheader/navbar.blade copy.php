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
    <script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
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
                    src="{{ asset('images/pasien icon.png') }}" class="me-4"
                    style="width: 24px; height:24px"><strong>Pasien</strong></a>
            @endcan
            @can('apoteker')
            <a href ="{{ route('riwayat-resep') }}" type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/riwayat resep.png') }}" class="me-4"
                    style="width: 24px; height:24px"><strong>Riwayat Resep</strong></a>
            @endcan
            @can('admin+pengawas')
            <button type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>List Pasien</strong></button>
            @endcan
            @can('admin+pengawas')
            <button  type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/riwayat pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Riwayat Pasien</strong></button>
            @endcan
            @can('admin')
            <a href ="{{ route('jumlah-apoteker') }}"  type="button" class="btn-custom ps-3 d-flex justify-content-start align-items-center m-2"> <img
                    src="{{ asset('images/navbar menu/list pasien.png') }}" class="me-4"
                    style="width: 30px; height:30px"><strong>Apoteker</strong></a>
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


{{-- <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">loser</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            <h3>Left Sidebar with Submenus</h3>
            <p class="lead">
                An example 2-level sidebar with collasible menu items. The menu functions like an "accordion" where only a single
                menu is be open at a time. While the sidebar itself is not toggle-able, it does responsively shrink in width on smaller screens.</p>
            <ul class="list-unstyled">
                <li><h5>Responsive</h5> shrinks in width, hides text labels and collapses to icons only on mobile</li>
            </ul>
        </div>
    </div>
</div> --}}
