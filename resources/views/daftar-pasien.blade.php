@extends('footerheader.navbar')
@section('content')
<div class="container">
    <h2 class="me-4">DATA PASIEN</h2>
    <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
       <strong> + Tambah Pasien</strong>
    </button>
    <div class="search-bar my-3">
        <input type="text" class="form-control" placeholder="Cari Obat">
        <button class="btn btn-link">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>
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

        {{-- Detail Pasien --}}
        <div class="modal fade" id="detailPasienModal" tabindex="-1" aria-labelledby="detailPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailPasienModalLabel">Detail Data Obat</h5>
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
        <div class="modal fade" id="hapusPasienModal" tabindex="-1" aria-labelledby="hapusPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusPasienModalLabel">Hapus Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                        <p>Anda yakin ingin menghapus data obat ini?</p>
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                            <button type="button" class="btn btn-danger px-4">YA</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         {{-- Edit Obat Modal --}}
    <div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="editPasienModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editPasienModalLabel">Edit Pasien</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                  <!-- Nama Obat -->
                  <div class="row mb-3">
                    <label for="namaObat" class="col-md-4 col-form-label">No RM</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="namaObat" value=" {{ old('no_rm', $item->no_rm )}}">
                    </div>
                  </div>

                  <!-- Bentuk Obat -->
                  <div class="row mb-3">
                    <label for="bentukObat" class="col-md-4 col-form-label">Nama</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="bentukObat" value=" {{ old('nama', $item->nama )}}">
                    </div>
                  </div>

                  <!-- Kebutuhan Sediaan & Satuan -->
                  <div class="row mb-3">
                    <label for="kekuatanSediaan" class="col-md-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="kekuatanSediaan" value=" {{ old('tanggal_lahir', $item->tanggal_lahir)}}">
                    </div>
                  </div>

                  <!-- Efek Samping -->
                  <div class="row mb-3">
                    <label for="efekSamping" class="col-md-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="efekSamping" value="{{ old('jenis_kelamin', $item->jenis_kelamin )}}">
                    </div>
                  </div>

                  <!-- Kontraindikasi -->
                  <div class="row mb-3">
                    <label for="kontraindikasi" class="col-md-4 col-form-label">No Telepon</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="kontraindikasi" value="{{ old('no_telp', $item->no_telp )}}">
                    </div>
                  </div>

                  <!-- Interaksi Obat -->
                  <div class="row mb-3">
                    <label for="interaksiObat" class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="interaksiObat" value="{{ old('alamat', $item->alamat)}}">
                    </div>
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

        <!-- Pagination -->
        <div class="paginate d-flex justify-content-center">
            {{ $data_pasien->links() }}
        </div>
    </div>
</div>
@endsection

<!-- Bootstrap JS and Popper -->
