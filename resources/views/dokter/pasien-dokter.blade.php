@extends('footerheader.navbar')
@section('content')
    <div class="container">
        <h2 class="me-4">DATA PASIEN</h2>

        <!-- Search + Tambah Button -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-3">
            <form action="{{ route('daftar-pasien') }}" method="GET" class="w-100">
                <div class="search-bar mt-2 position-relative">
                    <input type="text" class="form-control pe-5" placeholder="Cari Pasien" name="search"
                        value="{{ request('search') }}" autocomplete="off">
                    <button class="btn position-absolute top-50 end-0 translate-middle-y me-2" type="submit">
                        <img src="{{ asset('images/search icon.png') }}" alt="Search">
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
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
                                <td>{{ $item->no_telp }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <!-- Detail Button -->
                                        <button class="btn btn-resep btn-sm detail-btn"
                                            data-norm="{{ $item->no_rm }}"
                                            data-nama="{{ $item->nama }}"
                                            data-jenis="{{ $item->jenis_kelamin }}"
                                            data-tanggal="{{ $item->tanggal_lahir }}"
                                            data-alamat="{{ $item->alamat }}"
                                            data-notelp="{{ $item->no_telp }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailPasienModal">
                                            <a href ="{{ route('detail-data-pasien') }}" ><i class="fa-solid fa-circle-info me-2 " style="color: white"></i></a>Detail
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="paginate d-flex justify-content-center mt-3">
                {{ $data_pasien->links() }}
            </div>
        </div>
    </div>


@endsection
