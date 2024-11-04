@extends('footerheader.navbar')

@section('content')
<div class="container mt-3">
    <h2>JUMLAH APOTEKER</h2>

    <a type="button" class="btn btn-resep my-4"href="{{ route('tambah-apoteker') }}">
        + Tambah Apoteker
    </a>

    <!-- Search Bar -->
    <div class="search-bar mb-3 d-flex">
        <input type="text" class="form-control" placeholder="Cari apoteker">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
        </button>
    </div>

    <!-- Tabel Data Apoteker -->
    <div class="card p-4 table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th style="width:250px">Username</th>
                    <th style="width:250px">Nama User</th>
                    <th style="width:400px">Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_apoteker as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_role }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <!-- Edit Button -->
                            <a class="btn btn-success p-2 px-3 mx-2" data-bs-toggle="modal" data-bs-target="#editApotekerModal">
                                <img src="{{ asset('images/edit icon.png') }}" class="me-2" alt="Edit Icon">Edit
                            </a>

                            <!-- Delete Button -->
                            <button class="btn btn-danger p-2 px-3 mx-2" data-bs-toggle="modal" data-bs-target="#hapusApotekerModal">
                                <img src="{{ asset('images/delete icon.png') }}" class="me-2" alt="Delete Icon">Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="paginate d-flex justify-content-center">
        {{ $data_apoteker->links() }}
    </div>
</div>

<!-- Modals -->
    <!-- Hapus Obat Modal -->
    <div class="modal fade" id="hapusApotekerModal" tabindex="-1" aria-labelledby="hapusApotekerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="HapusObatModalLabel">Hapus Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <p>Anda yakin ingin menghapus apotker ini?</p>
                    <div class="d-flex justify-content-around mt-3">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                        <button type="button" class="btn btn-danger px-4">YA</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
