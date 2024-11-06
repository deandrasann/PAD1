@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav">
    <a class="nav-link"  href="{{ route('pmo-cek-pasien') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('pmo-data-resep') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{route('pmo-riwayat-minum-obat')}}">Riwayat Minum Obat</a>
</nav>
<main class="m-3" style="color: black">
    <div class="row m-2">
        <div class="col-3"><strong>No Resep</strong></div>
        <div class="col-1">:</div>
        <div class="col-5">-</div>
    </div>
    <div class="row m-2">
        <div class="col-3"><strong>Tanggal Resep</strong></div>
        <div class="col-1">:</div>
        <div class="col-5">-</div>
    </div>
    <div class="row m-2">
        <div class="col-3"><strong>Jumlah Obat</strong></div>
        <div class="col-1">:</div>
        <div class="col-5">-</div>
    </div>
    <div class="d-flex justify-content-center align-items-center p-4">
        <div class="card p-4 w-100">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="py-2">No RM</th>
                        <th class="py-2">Nama Obat</th>
                        <th class="py-2">Status</th>
                        <th class="py-2" style="white-space: nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($data_pasien as $index => $item) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        {{-- <td>{{ $item->no_rm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->no_telp }}</td> --}}
                        <td style="width: 250px">
                            <div class="d-flex">
                                <button class="btn btn-resep p-2 detail-btn me-2" data-bs-toggle="modal" data-bs-target="#detailPasienModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <button class="btn btn-danger p-2 delete-btn" data-bs-toggle="modal" data-bs-target="#hapusPasienModal">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hentikan
                                </button>
                            </div>
                        </td>
                    </tr>
                    {{-- @empty --}}
                    {{-- <tr>
                        <td colspan="7" class="text-center">Tidak Ada Data</td>
                    </tr> --}}
                    {{-- @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end m-4">
        <a href ="{{ route('pmo-daftar-pasien') }}" class="btn btn-success p-2 px-3 edit-btn">
            Kembali
        </a>
    </div>
</main>
@endsection
