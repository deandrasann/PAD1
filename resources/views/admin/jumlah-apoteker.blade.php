@extends('footerheader.navbar')

@section('content')
<div class="container mt-3">
    <h2>JUMLAH APOTEKER</h2>

    <button type="button" class="btn btn-resep mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#tambahApotekerModal">
        + Tambah Apoteker
    </button>

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
                            <button class="btn btn-success p-2 px-3 mx-2" data-bs-toggle="modal" data-bs-target="#editApotekerModal">
                                <img src="{{ asset('images/edit icon.png') }}" class="me-2" alt="Edit Icon">Edit
                            </button>

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
    <!-- Edit Obat Modal -->
     {{-- Edit Obat Modal --}}
     <div class="modal fade" id="editApotekerModal" tabindex="-1" aria-labelledby="editApotekerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editObatModalLabel">Edit Obat</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                  <!-- Nama Obat -->
                  <div class="row mb-3">
                    <label for="namaObat" class="col-md-4 col-form-label">Nama Obat</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="namaObat" placeholder="Nama obat">
                    </div>
                  </div>

                  <!-- Bentuk Obat -->
                  <div class="row mb-3">
                    <label for="bentukObat" class="col-md-4 col-form-label">Bentuk Obat</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="bentukObat" placeholder="Bentuk obat">
                    </div>
                  </div>

                  <!-- Kebutuhan Sediaan & Satuan -->
                  <div class="row mb-3">
                    <label for="kekuatanSediaan" class="col-md-4 col-form-label">Kebutuhan Sediaan</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" id="kekuatanSediaan" placeholder="Kebutuhan Sediaan">
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="satuan" placeholder="Satuan">
                    </div>
                  </div>

                  <!-- Efek Samping -->
                  <div class="row mb-3">
                    <label for="efekSamping" class="col-md-4 col-form-label">Efek Samping</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="efekSamping" placeholder="Efek Samping">
                    </div>
                  </div>

                  <!-- Kontraindikasi -->
                  <div class="row mb-3">
                    <label for="kontraindikasi" class="col-md-4 col-form-label">Kontraindikasi</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="kontraindikasi" placeholder="Kontraindikasi">
                    </div>
                  </div>

                  <!-- Interaksi Obat -->
                  <div class="row mb-3">
                    <label for="interaksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="interaksiObat" placeholder="Interaksi Obat">
                    </div>
                  </div>

                  <!-- Petunjuk Penyimpanan -->
                  <div class="row mb-3">
                    <label for="petunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk Penyimpanan</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="petunjukPenyimpanan" placeholder="Petunjuk Penyimpanan">
                    </div>
                  </div>

                  <!-- Pola Makan dan Hidup Sehat -->
                  <div class="row mb-3">
                    <label for="polaMakan" class="col-md-4 col-form-label">Pola Makan dan Hidup Sehat</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="polaMakan" placeholder="Pola Makan dan Hidup Sehat">
                    </div>
                  </div>

                  <!-- Informasi Tambahan -->
                  <div class="row mb-3">
                    <label for="informasiTambahan" class="col-md-4 col-form-label">Informasi Tambahan</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="informasiTambahan" placeholder="Informasi Tambahan">
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

@endsection
