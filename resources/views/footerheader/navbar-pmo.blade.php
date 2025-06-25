{{-- <!DOCTYPE html>
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

    <link rel="icon" type="image/png" href="images/pavicon.png">
    <title>apotech.id</title>

    <style>
        body {
            color: #2E6084;
        }
        .custom-card {
            max-width: 100%;
            overflow-x: auto;
        }
        .custom-table {
            width: 100%;
            min-width: 600px; /* Adjust as needed */
        }
        .custom-table th, .custom-table td {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 p-4 border-end border-bottom">
                <div class="d-flex flex-column align-items-center">
                    <h1>Data Pasien</h1>
                    <img src="{{ asset('images/pengawas_minum_obat.jpeg') }}" class="profile-img m-4" width="200px"
                        height="200px">
                    <div>
                        @php
                          $id = request()->route('id'); // Menangkap id pasien yang diteruskan melalui URL
                            // Eksekusi query untuk mengambil data pasien berdasarkan id
                            $data_pasien = DB::table('resep')
                                ->join('detail_resep', 'resep.no_resep', '=', 'detail_resep.no_resep')
                                ->join('pasien', 'resep.id_pasien', '=', 'pasien.id_pasien')
                                ->where('resep.id_pasien', $id)
                                ->where('resep.status_resep', 'setuju')
                                ->select(
                                    'resep.*',
                                    'detail_resep.*',
                                    'pasien.*',
                                    DB::raw('TIMESTAMPDIFF(YEAR, pasien.tanggal_lahir, CURDATE()) AS umur'),
                                )
                                ->first();
                        @endphp
                         @if ($data_pasien)
                             <ul class="list-group mt-4 width-250">
                                 <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                     <div class="me-2">
                                         <img src="{{ asset('images/navbar pmo/vector-2.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                     </div>
                                     <div>
                                         <strong>No RM:</strong> <br> {{ $data_pasien->no_rm }}
                                     </div>
                                 </li>
                                 <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                     <div class="me-2">
                                         <img src="{{ asset('images/navbar pmo/vector.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                     </div>
                                     <div>
                                         <strong>Nama:</strong> <br> {{ $data_pasien->nama }}
                                     </div>
                                 </li>
                                 <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                     <div class="me-2">
                                         <img src="{{ asset('images/navbar pmo/vector-1.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                     </div>
                                     <div>
                                         <strong>Jenis Kelamin:</strong> <br> {{ $data_pasien->jenis_kelamin }}
                                     </div>
                                    </li>
                                 <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                     <div class="me-2">
                                         <img src="{{ asset('images/navbar pmo/vector-5.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                     </div>
                                     <div>
                                         <strong>Tanggal Lahir:</strong> <br> {{ \Carbon\Carbon::parse($data_pasien->tanggal_lahir)->format('d-m-Y') }}
                                     </div>
                                 </li>
                                 <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                     <div class="me-2">
                                         <img src="{{ asset('images/navbar pmo/vector-4.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                     </div>
                                     <div>
                                         <strong>No Telepon:</strong> <br> {{ $data_pasien->no_telp }}
                                     </div>
                                 </li>
                                 <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                     <div class="me-2">
                                         <img src="{{ asset('images/navbar pmo/vector-3.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                     </div>
                                     <div>
                                         <strong>Alamat:</strong> <br> {{ $data_pasien->alamat }}
                                     </div>
                                 </li>
                                </ul>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="body m-5">
                    @if ($message = Session::get('success'))
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
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- {-- link styles --} --}}
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

    <link rel="icon" type="image/png" href="images/pavicon.png">
    <title>apotech.id</title>

    <style>
        body {
            color: #2E6084;
        }
        .custom-card {
            max-width: 100%;
            overflow-x: auto;
        }
        .custom-table {
            width: 100%;
            min-width: 600px; /* Adjust as needed */
        }
        .custom-table th, .custom-table td {
            white-space: nowrap;
        }
    </style>
</head>

    <body>
        {{-- Navbar --}}
        <nav class="navbar sticky-top bg-body-tertiary px-4 py-2"
            style="background: linear-gradient(90deg, #0D426C 22.99%, #338CC1 95.86%); width: 100%;">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Left Section: Sidebar Toggle & Logo -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="150" height="auto" class="me-3">
                    </a>
                    <!-- Sidebar Toggle Icon -->
                    <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                        class="navbar-brand d-flex align-items-center">
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

        {{-- Sidebar Replacement --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 py-4 collapse collapse-horizontal show border-end border-bottom" id="sidebar">
                    <div class="d-flex flex-column align-items-center">
                        <h1>Data Pasien</h1>
                        <img src="{{ asset('images/ix_user-profile-filled.png') }}" class="profile-img m-4" width="200px" height="200px">
                        <div>
                            <ul class="list-group mt-4 width-250">
                                <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                    <div class="me-2">
                                        <img src="{{ asset('images/navbar pmo/vector-2.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                    </div>
                                    <div>
                                        <strong>No RM:</strong> <br><div id="sidebar_norm"></div>
                                    </div>
                                </li>
                                <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                    <div class="me-2">
                                        <img src="{{ asset('images/navbar pmo/vector.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                    </div>
                                    <div>
                                        <strong>Nama:</strong> <br><div id="sidebar_nama"></div>
                                    </div>
                                </li>
                                <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                    <div class="me-2">
                                        <img src="{{ asset('images/navbar pmo/vector-1.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                    </div>
                                    <div>
                                        <strong>Jenis Kelamin:</strong> <br><div id="sidebar_jeniskelamin"></div>
                                    </div>
                                </li>
                                <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                    <div class="me-2">
                                        <img src="{{ asset('images/navbar pmo/vector-5.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                    </div>
                                    <div>
                                        <strong>Tanggal Lahir:</strong> <br> <div id="sidebar_tanggallahir"></div>
                                    </div>
                                </li>
                                <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                    <div class="me-2">
                                        <img src="{{ asset('images/navbar pmo/vector-4.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                    </div>
                                    <div>
                                        <strong>No Telepon:</strong> <br> <div id="sidebar_notelp"></div>
                                    </div>
                                </li>
                                <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                    <div class="me-2">
                                        <img src="{{ asset('images/navbar pmo/vector-3.png') }}" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                    </div>
                                    <div>
                                        <strong>Alamat:</strong> <br> <div id="sidebar_alamat"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
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
                </div>
            </div>
        </div>

        @stack('scripts')
        <script>
            // Add responsive behavior for sidebar toggle
            $(document).ready(function() {
                $('[data-bs-toggle="collapse"]').on('click', function() {
                    $('#sidebar').toggleClass('d-none d-md-block');
                });
            });
        </script>
        @stack('scripts')
    </body>

</html>
