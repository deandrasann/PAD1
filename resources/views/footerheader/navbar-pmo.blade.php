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
    <title>Document</title>
    <style>
        body {
            color: #2E6084;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 p-4 border-end border-bottom">
                <div class="d-flex flex-column align-items-center">
                    <h1>Data Pasien</h1>
                    <img src="images/profil-pmo.png" class="profile-img m-4">
                    <div>
                        <ul class="list-group mt-4 width-250" >
                            <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                <div class="me-2">
                                    <img src="images/navbar pmo/vector-2.png" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                </div>
                                <div>
                                    <strong>No RM:</strong> <br> 87658
                                </div>
                            </li>
                            <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                <div class="me-2">
                                    <img src="images/navbar pmo/vector.png" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                </div>
                                <div>
                                    <strong>Nama:</strong> <br> Nama
                                </div>
                            </li>
                            <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                <div class="me-2">
                                    <img src="images/navbar pmo/vector-1.png" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                </div>
                                <div>
                                    <strong>Jenis Kelamin:</strong> <br> Jenis Kelamin
                                </div>
                            </li>
                            <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                <div class="me-2">
                                    <img src="images/navbar pmo/vector-5.png" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                </div>
                                <div>
                                    <strong>Tanggal Lahir:</strong> <br> Tanggal Lahir
                                </div>
                            </li>
                            <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                <div class="me-2">
                                    <img src="images/navbar pmo/vector-4.png" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                </div>
                                <div>
                                    <strong>No Telepon:</strong> <br> Tanggal Lahir
                                </div>
                            </li>
                            <li class="list-group-item p-3 d-flex align-items-start" style="color: #2E6084; width: 250px;">
                                <div class="me-2">
                                    <img src="images/navbar pmo/vector-3.png" class="img-fluid" alt="Icon" style="max-width: 50px; height: auto;">
                                </div>
                                <div>
                                    <strong>Alamat:</strong> <br> Alamat
                                </div>
                            </li>


                            {{-- <li class="list-group-item p-3"><strong>Nama:</strong> Viska Ayu</li>
                            <li class="list-group-item p-3"><strong>Jenis Kelamin:</strong> Perempuan</li>
                            <li class="list-group-item p-3" ><strong>Tanggal Lahir:</strong> 01 Februari 1994</li>
                            <li class="list-group-item p-3"><strong>No Telp:</strong> 081263748388</li>
                            <li class="list-group-item p-3"><strong>Alamat:</strong> Karanganyar</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="body m-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
