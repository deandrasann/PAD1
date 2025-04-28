@extends('footerheader.navbar')
@section('content')
    <div class="container">
        <h2 class="me-4">RIWAYAT RESEP</h2>

        <!-- Search + Tambah Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Search Bar -->
            <form action="{{ route('riwayat-resep') }}" method="GET">
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Resep" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}">
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
                            <th>Nomor</th>
                            <th style="width: 15%">Tanggal Resep</th>
                            <th>Nomor Resep</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jumlah Obat</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_resep as $index => $item)
                            <tr>
                                <td>{{ $data_resep->firstItem() + $index }}</td>
                                <td>{{ $item->tgl_resep }}</td>
                                <td style="text-align: center;">{{ $item->no_resep }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td style="text-align: center;">{{ $item->jumlah_obat }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <!-- Detail Button -->
                                        <a href="{{ url('resep-pasien/' . $item->no_resep) }}" class="btn btn-resep btn-sm detail-btn">
                                            <img src="{{ asset('images/detail icon.png') }}" class="me-1" alt="Detail">Detail
                                        </a>
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
                {{ $data_resep->links() }}
            </div>
        </div>
    </div>
@endsection