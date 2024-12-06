@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav flex-column flex-md-row">
    <a class="nav-link" href="{{ route('hasil.scan') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('jadwal.obat') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{ route('laporan.obat') }}">Laporan Minum Obat</a>
    <a class="nav-link" href="{{ route('riwayat.minum.obat.pasien') }}">Riwayat Minum Obat</a>
</nav>

<div class="container mt-4">
    <h4 class="my-4">Riwayat Minum Obat Hari Ini</h4>

    <!-- Search Bar -->
    <div class="search-bar my-3 d-flex">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
        </button>
    </div>

    <!-- Table 1: Riwayat Minum Obat Hari Ini -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-4 py-2">Waktu</th>
                    <th class="px-4 py-2">Nama Obat</th>
                    <th class="px-4 py-2">Aturan Pakai</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2">Waktu</td>
                    <td class="px-4 py-2">Nama Obat</td>
                    <td class="px-4 py-2">Aturan Pakai</td>
                    <td class="px-4 py-2 d-flex justify-content-center">
                        <button class="btn btn-success p-2 px-5">Sudah Minum</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Waktu</td>
                    <td class="px-4 py-2">Nama Obat</td>
                    <td class="px-4 py-2">Aturan Pakai</td>
                    <td class="px-4 py-2 d-flex justify-content-center">
                        <button class="btn btn-resep p-2 px-5">Tunda Minum</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Waktu</td>
                    <td class="px-4 py-2">Nama Obat</td>
                    <td class="px-4 py-2">Aturan Pakai</td>
                    <td class="px-4 py-2 d-flex justify-content-center">
                        <button class="btn btn-danger p-2 px-5">Tidak Minum</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-4">
    <h4 class="my-4">Riwayat Minum Obat</h4>

    <!-- Search Bar -->
    <div class="search-bar my-3 d-flex">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
        </button>
    </div>

    <!-- Table 2: Riwayat Minum Obat -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-4 py-2">Waktu</th>
                    <th class="px-4 py-2">Nama Obat</th>
                    <th class="px-4 py-2">Aturan Pakai</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2">Waktu</td>
                    <td class="px-4 py-2">Nama Obat</td>
                    <td class="px-4 py-2">Aturan Pakai</td>
                    <td class="px-4 py-2 d-flex justify-content-center">
                        <button class="btn btn-success p-2 px-5">Sudah Minum</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Waktu</td>
                    <td class="px-4 py-2">Nama Obat</td>
                    <td class="px-4 py-2">Aturan Pakai</td>
                    <td class="px-4 py-2 d-flex justify-content-center">
                        <button class="btn btn-resep p-2 px-5">Tunda Minum</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Waktu</td>
                    <td class="px-4 py-2">Nama Obat</td>
                    <td class="px-4 py-2">Aturan Pakai</td>
                    <td class="px-4 py-2 d-flex justify-content-center">
                        <button class="btn btn-danger p-2 px-5">Tidak Minum</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
