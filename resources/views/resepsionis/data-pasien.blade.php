@extends('footerheader.navbar')
@section('content')
<h2> Pasien</h2>
<div class="card p-4">
    <div class="d-flex flex-row justify-content-between ">
        <div class="d-flex flex-row">
            <form action="{{ route('resepsionis') }}" method="GET">
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari No RM" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}">
                    </button>
                </div>
            </form>
            <form action="{{ route('resepsionis') }}" method="GET">
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Nama Pasien" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}">
                    </button>
                </div>
            </form>
        </div>
        <a href="{{ route('resepsionis-tambah') }}" class="btn btn-resep fw-bold">+ Tambah Pasien</a>
    </div>
    <div class="table-responsive">
                <table class="table table-striped table-hover align-middle my-4">
                    <thead class="table-primary">
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th style="text-align: center;">Aksi</th>
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
                                            <img src="{{ asset('images/detail icon.png') }}" class="me-1" alt="Detail">Detail
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
@endsection

