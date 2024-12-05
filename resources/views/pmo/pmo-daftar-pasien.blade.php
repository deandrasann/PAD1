@extends('footerheader.navbar')
@section('content')
<div class="container">
    <h2 class="me-4">LIST PASIEN</h2>
    {{-- <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
       <strong> + Tambah Pasien</strong>
    </button> --}}
    <form action="{{ route('pmo-daftar-pasien') }}" method="GET">
    <div class="search-bar my-3">
        <input type="text" class="form-control" placeholder="Cari Pasien" name="search" value="{{ request("search") }}" autocomplete="off">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>
</div>
</form>


<div class="d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-2 py-2">No</th>
                    <th class="px-2 py-2">Tanggal Resep</th>
                    <th class="px-4 py-2">No Resep</th>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Tanggal Lahir</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Jumlah obat</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data_pasien as $index => $item)
                <tr>
                    <td>{{ $item->no_rm }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>
                    <a href="{{ route('pmo-cek-pasien', $item->id_pasien) }}"class="btn btn-resep p-2 px-3 detail-btn">
                            <img src="{{ asset('images/detail icon.png') }}" class="me-2">Cek Pasien
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Pasien Yang Dicari Tidak Ada, Tolong Tambahkan Dulu Pengawas Minum ObatNya</td>
                </tr>
                @endforelse
            </tbody>
        </table>

       

        <!-- Pagination -->
        <div class="paginate d-flex justify-content-center">
            {{ $data_pasien->links() }}
        </div>
    </div>
</div>
@endsection

<!-- Bootstrap JS and Popper -->
