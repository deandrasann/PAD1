@extends('footerheader.navbar')
@section('content')
<div class="container">
        <h2 class="me-4">DATA PASIEN</h2>
        <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4">
           <strong> + Tambah Pasien</strong>
        </button>
    </div>

    <div class="d-flex justify-content-center align-items-center p-4">
        <div class="card p-4 w-100">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="px-4 py-2">No RM</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">Jenis kelamin</th>
                        <th class="px-4 py-2">Tanggal Lahir</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">No Telp</th>
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

                        <td>{{ $item->no_telp }}</td>
                        <td>
                             <!-- Detail Button -->
                            <button class="btn btn-resep p-2 px-3 detail-btn" data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button>

                            <!-- Edit Button -->
                            <button class="btn btn-success p-2 px-3 edit-btn" data-bs-toggle="modal" data-bs-target="#editObatModal" >
                                <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal" data-bs-target="#HapusObatModal">
                                <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                            </button>
                        </td></td>
                    </tr>
                    @empty
                    <tr>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
                        <td>Tidak Ada Data</td>
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

<!-- Modal -->
<div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4 mx-4">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPasienModalLabel">Tambah Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="noRm" class="form-label">No RM</label>
                        <input type="text" class="form-control" id="noRm">
                    </div>
                    <div class="mb-3">
                        <label for="namaPasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="namaPasien">
                    </div>
                    <div class="mb-3">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggalLahir">
                    </div>
                    <div class="mb-3">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenisKelamin">
                            <option selected>Pilih...</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="noTelepon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" id="noTelepon">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-resep ms-auto">Simpan</button>
            </div>

        </div>
    </div>
</div>
@endsection

<!-- Include Bootstrap JS (make sure jQuery is included before Bootstrap JS if you are using Bootstrap 4) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybnuLcZ93j7K6u5TzLg51H1lu3cJU5c9IFsEF8ccReRWK13A6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9F8p3pMV5wx9UAjF8suK4v9Y2lBiwUpyR531v5Er5UNRM5WE5k0FyiJ" crossorigin="anonymous"></script>
