@extends('footerheader.navbar')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h2 class="me-4">DATA PASIEN</h2>
        <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
            <strong> + Tambah Pasien</strong>
        </button>
    </div>
    <div class="search-bar my-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Obat">
            <button class="btn btn-link">
                <img src="{{ asset('images/search icon.png') }}">
            </button>
        </div>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="px-2 py-2">No RM</th>
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
                            <button class="btn btn-resep p-2 px-3 detail-btn" data-bs-toggle="modal" data-bs-target="#detailPasienModal">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button>
                            <button class="btn btn-success p-2 px-3 edit-btn" data-bs-toggle="modal" data-bs-target="#editPasienModal">
                                <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                            </button>
                            <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal" data-bs-target="#hapusPasienModal">
                                <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                            </button>
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

        <!-- Tambah Pasien Modal -->
        <div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPasienModalLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <!-- Nama Pasien -->
                            <div class="mb-3">
                                <label for="namaPasien" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="namaPasien" placeholder="Nama pasien">
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenisKelamin">
                                    <option selected>Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggalLahir">
                            </div>
                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Alamat pasien">
                            </div>
                            <!-- No Telp -->
                            <div class="mb-3">
                                <label for="noTelp" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="noTelp" placeholder="No telp pasien">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
          <!-- Pagination -->
          <div class="paginate d-flex justify-content-center">
            {{ $data_pasien->links() }}
        </div>

        <!-- Detail Pasien Modal -->
        <div class="modal fade" id="detailPasienModal" tabindex="-1" aria-labelledby="detailPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailPasienModalLabel">Detail Data Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>No RM</th>
                                    <td>: {{ $item->no_rm }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>: {{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>:  {{ $item->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>:  {{ $item->tanggal_lahir}}</td>
                                </tr>
                                <tr>
                                    <th>No telpon</th>
                                    <td>: {{ $item->no_telp }} </td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:  {{ $item->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-resep" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hapus Pasien Modal -->
        <div class="modal fade" id="hapusPasienModal" tabindex="-1" aria-labelledby="hapusPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusPasienModalLabel">Hapus Data Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                        <p>Anda yakin ingin menghapus data pasien ini?</p>
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                            <button type="button" class="btn btn-danger px-4">YA</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Pasien Modal -->
        <div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="editPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasienModalLabel">Edit Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <!-- Nama Pasien -->
                            <div class="mb-3">
                                <label for="editNamaPasien" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="editNamaPasien" value="{{ $item->nama }}">
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label for="editJenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="editJenisKelamin">
                                    <option value="Laki-laki" @if($item->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                                    <option value="Perempuan" @if($item->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                                </select>
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="editTanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="editTanggalLahir" value="{{ $item->tanggal_lahir }}">
                            </div>
                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="editAlamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="editAlamat" value="{{ $item->alamat }}">
                            </div>
                            <!-- No Telp -->
                            <div class="mb-3">
                                <label for="editNoTelp" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="editNoTelp" value="{{ $item->no_telp }}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
