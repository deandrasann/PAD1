@extends('footerheader.navbar-pmo')

@section('content')
<nav class="nav">
    <a class="nav-link" href="{{ route('pmo-cek-pasien') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('pmo-data-resep') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{route('pmo-riwayat-minum-obat')}}">Riwayat Minum Obat</a>
</nav>
<div class="container">
    <h4 class="my-4">Riwayat Minum Obat Hari Ini
    </h4>
    {{-- <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
       <strong> + Tambah Pasien</strong>
    </button> --}}
    <div class="search-bar my-3">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>
    <div class="d-flex justify-content-center align-items-center p-4">
        <div class="table-data table-responsivecard p-4 w-100 ">
            <table class="table table-striped table-hover ">
                <thead class="table-primary">
                    <tr>
                        <th class="px-4 py-2">Waktu</th>
                        <th class="px-4 py-2">Nama Obat</th>
                        <th class="px-4 py-2">Aturan Pakai</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($data_pasien as $index => $item) --}}
                    <tr>
                        {{-- <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->no_rm }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->no_telp }}</td> --}}
                    </tr>
                    {{-- @empty --}}
                    <tr>
                        <td colspan="7" style="text-align: center; color:gray">Tidak Ditemukan Data yang Sesuai</td>
                        {{-- <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td> --}}
                    </tr>
                    {{-- @endforelse --}}
                </tbody>
            </table>
            {{-- <!-- Pagination -->
            <div class="paginate d-flex justify-content-center">
                {{ $data_pasien->links() }}
            </div>
        </div> --}}
    </div>
</div>
<div class="container">
    <h4 class="mt-2 mb-4">Riwayat Minum Obat
    </h4>
    {{-- <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
       <strong> + Tambah Pasien</strong>
    </button> --}}
    <div class="search-bar my-3">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>
    <div class="d-flex justify-content-center align-items-center p-4">
        <div class="table-data table-responsivecard p-4 w-100 ">
            <table class="table table-striped table-hover ">
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
                        <td class="px-4 py-2 d-flex flex-row justify-content-center">
                            <button href ="#" class="  btn btn-success p-2 px-5 edit-btn">
                            Sudah Minum
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Waktu</td>
                        <td class="px-4 py-2">Nama Obat</td>
                        <td class="px-4 py-2">Aturan Pakai</td>
                        <td class="px-4 py-2 d-flex flex-row justify-content-center">
                            <button href ="#" class="  btn btn-resep p-2 px-5 edit-btn">
                            Tunda Minum
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Waktu</td>
                        <td class="px-4 py-2">Nama Obat</td>
                        <td class="px-4 py-2">Aturan Pakai</td>
                        <td class="px-4 py-2 d-flex flex-row justify-content-center">
                            <button href ="#" class="  btn btn-danger  p-2 px-5 edit-btn">
                            Tidak Minum
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <!-- Pagination -->
            <div class="paginate d-flex justify-content-center">
                {{ $data_pasien->links() }}
            </div>
        </div> --}}
    </div>
</div>


@endsection
