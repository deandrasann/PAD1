@extends('footerheader.navbar')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .table td {
            vertical-align: middle;
        }
        .search-bar {
            display: flex;
            align-items: center;
            gap: 5px;
            max-width: 300px;
        }
        /* .search-bar input {
            flex-grow: 1;
        }
        .pagination .page-item.active .page-link {
            background-color: #0069d9;
            border-color: #0069d9;
        } */
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>DATA RESEP OBAT</h2>

    <!-- Tambah Obat Button -->
    <button type="button" class="btn btn-primary p-3 px-4 my-4 d-flex justify-content-start align-items-center m-2" style="background: #2DA3F9; border:none"><strong>+ Tambah Obat</strong></button>

    <!-- Search Bar -->
    <div class="search-bar mb-3">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{asset('images\search icon.png')}}">
        </button>
    </div>

    <!-- Tabel Data Resep Obat -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th style="background:#1574BA;color:#FFF">No</th>
                    <th  style="background:#1574BA;color:#FFF; width:400px">Nama Obat</th>
                    <th style="background:#1574BA;color:#FFF; width:250px">Indikasi</th>
                    <th style="background:#1574BA;color:#FFF; width:250px">Golongan Obat</th>
                    <th style="background:#1574BA;color:#FFF">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td ><strong> Tablet 10 mg</strong></td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <button class="btn btn-primary  p-2 px-3" style="background: #5C97EF"><img src="{{asset('images\detail icon.png')}}" style="width: 20px; height: 20px; border:none; " class="me-2">Detail</button>
                        <button class="btn btn-success  p-2 px-3 " style="background: #3A9C73"><img src="{{asset('images\detail icon.png')}}" style="width: 20px; height: 20px; border:none;" class="me-2">Edit</button>
                        <button class="btn btn-danger  p-2 px-3 " style="background: #BE2323"><img src="{{asset('images\detail icon.png')}}" style="width: 20px; height: 20px; border:none;" class="me-2">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous" >
                    <span class="page-link" aria-hidden="true"><img src="{{asset('images\back icon.png')}}"></span>
                </li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link" aria-current="page"style="border-radius: 16px" >1</span>
                </li>
                <li class="page-item">
                    <a class="page-link mx-2" style="border-radius: 16px">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link mx-2" style="border-radius: 16px">3</a>
                </li>
                <li class="page-item" >
                    <a class="page-link ms-4" style="border-radius: 16px"><img src="{{asset('images\next icon.png')}}"></a>
                </li>
            </ul>
        </nav>
    </div>

@endsection
