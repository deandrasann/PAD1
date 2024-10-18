@extends('footerheader.navbar')

@section('content')

<div class="container mt-4">
    <h2>DATA RESEP OBAT</h2>

    <!-- Tombol Tambah Obat -->
    <button type="button" class="btn btn-resep tambah-obat-btn">
        <strong>+ Tambah Obat</strong>
    </button>

    <!-- Search Bar -->
    <div class="search-bar mb-3">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>

    <!-- Tabel Data Resep Obat -->
    <div class="table-data table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th style="width:250px">Indikasi</th>
                    <th style="width:250px">Golongan Obat</th>
                    <th style="width:400px">Nama Obat</th>
                    <th >Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_role }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <button class="btn btn-resep p-2 px-3 detail-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button>
                            <button class="btn btn-success p-2 px-3 edit-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Edit
                            </button>
                            <button class="btn btn-danger p-2 px-3 delete-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="paginate d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection
