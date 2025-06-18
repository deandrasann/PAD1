@extends('footerheader.navbar')

@section('content')
    <div class="container mt-4">
        <h2>DATA OBAT</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="search-bar mt-2">
                <input type="text" class="form-control" placeholder="Cari Obat" name="search" id="searchObat"
                    value="{{ request('search') }}" autocomplete="off">
                <button class="btn btn-link" type="button" id="searchButton">
                    <img src="{{ asset('images/search icon.png') }}">
                </button>
            </div>

            <button type="button" class="btn btn-resep mb-3 px-4 py-3" data-bs-toggle="modal"
                data-bs-target="#tambahObatModal">
                + Tambah Obat
            </button>
        </div>

        <div class="table-data table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Indikasi</th>
                        <th>Golongan Obat</th>
                        <th>Nama Obat</th>
                        <th>Kekuatan Sediaan</th>
                        <th>Status Ketersediaan Obat</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="obatTableBody">
                    {{-- Data will be loaded here via JavaScript --}}
                </tbody>
            </table>
            <div class="paginate d-flex justify-content-center" id="paginationLinks">
                {{-- Pagination links will be loaded here via JavaScript --}}
            </div>
        </div>

        <div class="modal fade" id="detailObatModal" tabindex="-1" aria-labelledby="detailObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailObatModalLabel">Detail Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Nama Obat</th>
                                    <td id="modalNama"></td>
                                </tr>
                                <tr>
                                    <th>Takaran Minum</th>
                                    <td id="modalTakaranMinum"></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Kali Minum</th>
                                    <td id="modalJumlahKaliMinum"></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Obat per Minum</th>
                                    <td id="modalJumlahObatPerMinum"></td>
                                </tr>
                                <tr>
                                    <th>Bentuk Obat</th>
                                    <td id="modalBentukObat"></td>
                                </tr>
                                <tr>
                                    <th>Kemasan Obat</th>
                                    <td id="modalKemasanObat"></td>
                                </tr>
                                <tr>
                                    <th>Aturan Pakai</th>
                                    <td id="modalAturanPakai"></td>
                                </tr>
                                <tr>
                                    <th>Golongan Obat</th>
                                    <td id="modalGolonganObat"></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Obat</th>
                                    <td id="modalJumlahObat"></td>
                                </tr>
                                <tr>
                                    <th>Waktu Minum</th>
                                    <td id="modalWaktuMinum"></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td id="modalKeterangan"></td>
                                </tr>
                                <tr>
                                    <th>Harga Satuan</th>
                                    <td id="modalHargaSatuan"></td>
                                </tr>
                                <tr>
                                    <th>Kontraindikasi</th>
                                    <td id="modalKontraindikasi"></td>
                                </tr>
                                <tr>
                                    <th>Pola Makan</th>
                                    <td id="modalPolaMakan"></td>
                                </tr>
                                <tr>
                                    <th>Interaksi Obat</th>
                                    <td id="modalInteraksiObat"></td>
                                </tr>
                                <tr>
                                    <th>Petunjuk Penyimpanan</th>
                                    <td id="modalPetunjukPenyimpanan"></td>
                                </tr>
                                <tr>
                                    <th>Kekuatan Sediaan</th>
                                    <td id="modalKekuatanSediaan"></td>
                                </tr>
                                <tr>
                                    <th>Informasi Tambahan</th>
                                    <td id="modalInformasiTambahan"></td>
                                </tr>
                                <tr>
                                    <th>Efek Samping</th>
                                    <td id="modalEfekSamping"></td>
                                </tr>
                                <tr>
                                    <th>Indikasi</th>
                                    <td id="modalIndikasi"></td>
                                </tr>
                                <tr>
                                    <th>Status Ketersediaan</th>
                                    <td id="modalStatusKetersediaan"></td>
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

        {{-- Hapus Obat Modal (dynamic content) --}}
        <div class="modal fade" id="hapusObatModalGlobal" tabindex="-1" aria-labelledby="HapusObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="HapusObatModalLabel">Hapus Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                        <p>Anda yakin ingin menghapus data obat ini?</p>
                        <form action="" method="POST" id="deleteObatForm">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex justify-content-around mt-3">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                                <button type="submit" class="btn btn-danger px-4">YA</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- Tambah Obat Modal --}}
        <div class="modal fade" id="tambahObatModal" tabindex="-1" aria-labelledby="tambahObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahObatModalLabel">Tambah Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahObatForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="namaObat" class="col-md-4 col-form-label">Nama Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="namaObat" name="nama_obat"
                                        placeholder="Nama obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="takaranMinum" class="col-md-4 col-form-label">Takaran Minum</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="takaranMinum" name="takaran_minum"
                                        placeholder="Takaran Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jmlKaliMinum" class="col-md-4 col-form-label">Jumlah Kali Minum</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="jmlKaliMinum" name="jml_kali_minum"
                                        placeholder="Jumlah Kali Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jmlObatPerMinum" class="col-md-4 col-form-label">Jumlah Obat per Minum</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="jmlObatPerMinum"
                                        name="jml_obat_per_minum" placeholder="Jumlah Obat per Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="bentukObat" class="col-md-4 col-form-label">Bentuk Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="bentukObat" name="bentuk_obat"
                                        placeholder="Bentuk obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kemasanObat" class="col-md-4 col-form-label">Kemasan Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="kemasanObat" name="kemasan_obat"
                                        placeholder="Kemasan obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="aturanPakai" class="col-md-4 col-form-label">Aturan Pakai</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="aturanPakai" name="aturan_pakai"
                                        placeholder="Aturan Pakai" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="golonganObat" class="col-md-4 col-form-label">Golongan Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="golonganObat" name="golongan_obat"
                                        placeholder="Golongan Obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jumlahObat" class="col-md-4 col-form-label">Jumlah Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="jumlahObat" name="jumlah_obat"
                                        placeholder="Jumlah Obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="waktuMinum" class="col-md-4 col-form-label">Waktu Minum</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="waktuMinum" name="waktu_minum"
                                        placeholder="Waktu Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keterangan" class="col-md-4 col-form-label">Keterangan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        placeholder="Keterangan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="hargaSatuan" class="col-md-4 col-form-label">Harga Satuan</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="hargaSatuan" name="harga_satuan"
                                        placeholder="Harga Satuan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kontraindikasi" class="col-md-4 col-form-label">Kontraindikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="kontraindikasi" name="kontraindikasi"
                                        placeholder="Kontraindikasi" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="polaMakan" class="col-md-4 col-form-label">Pola Makan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="polaMakan" name="pola_makan"
                                        placeholder="Pola Makan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="interaksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="interaksiObat" name="interaksi_obat"
                                        placeholder="Interaksi Obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="petunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk
                                    Penyimpanan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="petunjukPenyimpanan"
                                        name="petunjuk_penyimpanan" placeholder="Petunjuk Penyimpanan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kekuatanSediaan" class="col-md-4 col-form-label">Kekuatan Sediaan</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="kekuatanSediaan"
                                        name="kekuatan_sediaan" placeholder="Kekuatan Sediaan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="informasiTambahan" class="col-md-4 col-form-label">Informasi Tambahan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="informasiTambahan"
                                        name="informasi_tambahan" placeholder="Informasi Tambahan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="efekSamping" class="col-md-4 col-form-label">Efek Samping</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="efekSamping" name="efek_samping"
                                        placeholder="Efek Samping" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="indikasi" class="col-md-4 col-form-label">Indikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="indikasi" name="indikasi"
                                        placeholder="Indikasi" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="statusKetersediaan" class="col-md-4 col-form-label">Status Ketersediaan</label>
                                <div class="col-md-8">
                                    <select id="statusKetersediaan" name="status_ketersediaan_obat" class="form-select"
                                        required>
                                        <option value="Stocked" selected>Stocked</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Habis">Habis</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-resep ms-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


        {{-- Edit Obat Modal --}}
        <div class="modal fade" id="editObatModal" tabindex="-1" aria-labelledby="editObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editObatModalLabel">Edit Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" id="editObatForm">
                        @csrf
                        @method('PUT') {{-- Assuming you use PUT for updates --}}
                        <div class="modal-body">
                            <input type="hidden" id="editKodeObat" name="kode_obat">
                            <div class="row mb-3">
                                <label for="editNamaObat" class="col-md-4 col-form-label">Nama Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editNamaObat" name="nama_obat"
                                        placeholder="Nama obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editTakaranMinum" class="col-md-4 col-form-label">Takaran Minum</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editTakaranMinum" name="takaran_minum"
                                        placeholder="Takaran Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editJmlKaliMinum" class="col-md-4 col-form-label">Jumlah Kali Minum</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="editJmlKaliMinum"
                                        name="jml_kali_minum" placeholder="Jumlah Kali Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editJmlObatPerMinum" class="col-md-4 col-form-label">Jumlah Obat per
                                    Minum</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="editJmlObatPerMinum"
                                        name="jml_obat_per_minum" placeholder="Jumlah Obat per Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editBentukObat" class="col-md-4 col-form-label">Bentuk Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editBentukObat" name="bentuk_obat"
                                        placeholder="Bentuk obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editKemasanObat" class="col-md-4 col-form-label">Kemasan Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editKemasanObat" name="kemasan_obat"
                                        placeholder="Kemasan obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editAturanPakai" class="col-md-4 col-form-label">Aturan Pakai</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editAturanPakai" name="aturan_pakai"
                                        placeholder="Aturan Pakai" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editGolonganObat" class="col-md-4 col-form-label">Golongan Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editGolonganObat" name="golongan_obat"
                                        placeholder="Golongan Obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editJumlahObat" class="col-md-4 col-form-label">Jumlah Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editJumlahObat" name="jumlah_obat"
                                        placeholder="Jumlah Obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editWaktuMinum" class="col-md-4 col-form-label">Waktu Minum</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editWaktuMinum" name="waktu_minum"
                                        placeholder="Waktu Minum" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editKeterangan" class="col-md-4 col-form-label">Keterangan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editKeterangan" name="keterangan"
                                        placeholder="Keterangan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editHargaSatuan" class="col-md-4 col-form-label">Harga Satuan</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="editHargaSatuan" name="harga_satuan"
                                        placeholder="Harga Satuan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editKontraindikasi" class="col-md-4 col-form-label">Kontraindikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editKontraindikasi"
                                        name="kontraindikasi" placeholder="Kontraindikasi" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editPolaMakan" class="col-md-4 col-form-label">Pola Makan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editPolaMakan" name="pola_makan"
                                        placeholder="Pola Makan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editInteraksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editInteraksiObat"
                                        name="interaksi_obat" placeholder="Interaksi Obat" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editPetunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk
                                    Penyimpanan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editPetunjukPenyimpanan"
                                        name="petunjuk_penyimpanan" placeholder="Petunjuk Penyimpanan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editKekuatanSediaan" class="col-md-4 col-form-label">Kekuatan Sediaan</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="editKekuatanSediaan"
                                        name="kekuatan_sediaan" placeholder="Kekuatan Sediaan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editInformasiTambahan" class="col-md-4 col-form-label">Informasi
                                    Tambahan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editInformasiTambahan"
                                        name="informasi_tambahan" placeholder="Informasi Tambahan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editEfekSamping" class="col-md-4 col-form-label">Efek Samping</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editEfekSamping" name="efek_samping"
                                        placeholder="Efek Samping" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editIndikasi" class="col-md-4 col-form-label">Indikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="editIndikasi" name="indikasi"
                                        placeholder="Indikasi" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editStatusKetersediaan" class="col-md-4 col-form-label">Status
                                    Ketersediaan</label>
                                <div class="col-md-8">
                                    <select id="editStatusKetersediaan" name="status_ketersediaan_obat"
                                        class="form-select" required>
                                        <option value="Stocked">Stocked</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Habis">Habis</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-resep ms-auto">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch and display obat data
       function fetchObatData(page = 1, searchQuery = '') {
    $.ajax({
        url: '{{ route('api.obat.get') }}',
        method: 'GET',
        data: {
            page: page,
            search: searchQuery
        },
        success: function(response) {
            if (response.status === 'success') {
                let obatData = response.data.data;
                let html = '';
                if (obatData.length > 0) {
                    $.each(obatData, function(index, item) {
                        let statusClass = '';
                        if (item.status_ketersediaan_obat == 'Stocked') {
                            statusClass = 'text-success font-weight-bold';
                        } else if (item.status_ketersediaan_obat == 'Draft') {
                            statusClass = 'text-warning font-weight-bold';
                        } else if (item.status_ketersediaan_obat == 'Habis') {
                            statusClass = 'text-danger font-weight-bold';
                        }

                        html += `
                        <tr>
                            <td>${response.data.from + index}</td>
                            <td>${item.indikasi}</td>
                            <td>${item.golongan_obat}</td>
                            <td>${item.nama_obat}</td>
                            <td>${item.kekuatan_sediaan}</td>
                            <td class="${statusClass}">${item.status_ketersediaan_obat}</td>
                            <td>
                                <button class="btn btn-resep p-2 px-3 detail-btn"
                                    data-nama="${item.nama_obat}"
                                    data-takaran="${item.takaran_minum || ''}"
                                    data-jumlah-kali="${item.jml_kali_minum || ''}"
                                    data-jumlah-obat-per-minum="${item.jml_obat_per_minum || ''}"
                                    data-bentuk="${item.bentuk_obat || ''}"
                                    data-kemasan="${item.kemasan_obat || ''}"
                                    data-aturan-pakai="${item.aturan_pakai || ''}"
                                    data-golongan="${item.golongan_obat}"
                                    data-jumlah="${item.jumlah_obat || ''}"
                                    data-waktu="${item.waktu_minum || ''}"
                                    data-keterangan="${item.keterangan || ''}"
                                    data-harga="${item.harga_satuan || ''}"
                                    data-kontra="${item.kontraindikasi}"
                                    data-pola="${item.pola_makan}"
                                    data-interaksi="${item.interaksi_obat || ''}"
                                    data-penyimpanan="${item.petunjuk_penyimpanan || ''}"
                                    data-kekuatan="${item.kekuatan_sediaan}"
                                    data-tambahan="${item.informasi_tambahan}"
                                    data-efek="${item.efek_samping}"
                                    data-indikasi="${item.indikasi}"
                                    data-status="${item.status_ketersediaan_obat}"
                                    data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <button class="btn btn-success editCategory p-2 px-3"
                                    data-kode="${item.kode_obat}"
                                    data-nama="${item.nama_obat}"
                                    data-takaran="${item.takaran_minum || ''}"
                                    data-jumlah-kali="${item.jml_kali_minum || ''}"
                                    data-jumlah-obat-per-minum="${item.jml_obat_per_minum || ''}"
                                    data-bentuk="${item.bentuk_obat || ''}"
                                    data-kemasan="${item.kemasan_obat || ''}"
                                    data-aturan-pakai="${item.aturan_pakai || ''}"
                                    data-golongan="${item.golongan_obat}"
                                    data-jumlah="${item.jumlah_obat || ''}"
                                    data-waktu="${item.waktu_minum || ''}"
                                    data-keterangan="${item.keterangan || ''}"
                                    data-harga="${item.harga_satuan || ''}"
                                    data-kontra="${item.kontraindikasi}"
                                    data-pola="${item.pola_makan}"
                                    data-interaksi="${item.interaksi_obat || ''}"
                                    data-penyimpanan="${item.petunjuk_penyimpanan || ''}"
                                    data-kekuatan="${item.kekuatan_sediaan}"
                                    data-tambahan="${item.informasi_tambahan}"
                                    data-efek="${item.efek_samping}"
                                    data-indikasi="${item.indikasi}"
                                    data-status="${item.status_ketersediaan_obat}"
                                    >
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <button class="btn btn-danger p-2 px-3 delete-btn"
                                    data-kode="${item.kode_obat}" data-bs-toggle="modal"
                                    data-bs-target="#hapusObatModalGlobal">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                        </tr>
                        `;
                    });
                } else {
                    html = `<tr><td colspan="7" class="text-center">Tidak Ada Data</td></tr>`;
                }
                $('#obatTableBody').html(html);

                // --- Generasi Pagination ---
                let paginationHtml = '<ul class="pagination">';
                $.each(response.data.links, function(index, link) {
                    let activeClass = link.active ? 'active' : '';
                    let disabledClass = link.url === null ? 'disabled' : ''; // Jika URL null, nonaktifkan
                    let pageNumber;

                    // Ekstrak nomor halaman dari URL, atau gunakan label untuk Prev/Next
                    if (link.url) {
                        const urlParams = new URLSearchParams(new URL(link.url).search);
                        pageNumber = urlParams.get('page');
                    } else {
                        // Untuk "Previous" atau "Next" yang disabled, kita perlu logika khusus
                        // Jika label adalah "Previous" dan URL null, berarti di halaman pertama
                        // Jika label adalah "Next" dan URL null, berarti di halaman terakhir
                        if (link.label.includes('Previous') && link.url === null) {
                            pageNumber = 1; // Tetap di halaman 1 jika di awal dan prev disabled
                        } else if (link.label.includes('Next') && link.url === null) {
                            pageNumber = response.data.last_page; // Menuju halaman terakhir
                        } else {
                            // Untuk tautan angka, label sudah menjadi nomor halaman
                            pageNumber = link.label;
                        }
                    }

                    paginationHtml += `
                        <li class="page-item ${activeClass} ${disabledClass}">
                            <a class="page-link" href="#" data-page="${pageNumber}">${link.label}</a>
                        </li>
                    `;
                });
                paginationHtml += '</ul>';
                $('#paginationLinks').html(paginationHtml);

                // Attach click event to pagination links
                $('#paginationLinks .page-link').on('click', function(e) {
                    e.preventDefault(); // Mencegah perilaku default tautan
                    const pageNum = $(this).data('page');
                    const currentSearchQuery = $('#searchInput').val(); // Ambil nilai dari input search
                    if (pageNum && !$(this).parent().hasClass('disabled')) { // Pastikan ada pageNum dan tidak disabled
                        fetchObatData(pageNum, currentSearchQuery);
                    }
                });
                // --- Akhir Generasi Pagination ---

            } else {
                alert('Gagal mengambil data obat: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + error);
            alert('Terjadi kesalahan saat mengambil data.');
        }
    });
}
            // Initial load of data
            fetchObatData();

            // Search functionality
            $('#searchButton').on('click', function() {
                let searchQuery = $('#searchObat').val();
                fetchObatData(1, searchQuery); // Reset to page 1 on new search
            });

            // Live search as user types (optional, can be performance intensive on large datasets)
            $('#searchObat').on('keyup', function() {
                let searchQuery = $(this).val();
                fetchObatData(1, searchQuery);
            });

            // Pagination links click handler (delegated event)
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let pageUrl = $(this).attr('href');
                let page = new URL(pageUrl).searchParams.get('page');
                let searchQuery = $('#searchObat').val();
                fetchObatData(page, searchQuery);
            });

            // Detail Modal
            $(document).on('click', '.detail-btn', function() {
                $('#modalNama').text($(this).data('nama'));
                $('#modalTakaranMinum').text($(this).data('takaran'));
                $('#modalJumlahKaliMinum').text($(this).data('jumlah-kali'));
                $('#modalJumlahObatPerMinum').text($(this).data('jumlah-obat-per-minum'));
                $('#modalBentukObat').text($(this).data('bentuk'));
                $('#modalKemasanObat').text($(this).data('kemasan'));
                $('#modalAturanPakai').text($(this).data('aturan-pakai'));
                $('#modalGolonganObat').text($(this).data('golongan'));
                $('#modalJumlahObat').text($(this).data('jumlah'));
                $('#modalWaktuMinum').text($(this).data('waktu'));
                $('#modalKeterangan').text($(this).data('keterangan'));
                $('#modalHargaSatuan').text($(this).data('harga'));
                $('#modalKontraindikasi').text($(this).data('kontra'));
                $('#modalPolaMakan').text($(this).data('pola'));
                $('#modalInteraksiObat').text($(this).data('interaksi'));
                $('#modalPetunjukPenyimpanan').text($(this).data('penyimpanan'));
                $('#modalKekuatanSediaan').text($(this).data('kekuatan'));
                $('#modalInformasiTambahan').text($(this).data('tambahan'));
                $('#modalEfekSamping').text($(this).data('efek'));
                $('#modalIndikasi').text($(this).data('indikasi'));
                $('#modalStatusKetersediaan').text($(this).data('status'));
            });

            // Tambah Obat Form Submission
            $('#tambahObatForm').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('api.obat.create') }}', // This route should handle POST
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#tambahObatModal').modal('hide');
                            $('#tambahObatForm')[0].reset(); // Clear form
                            fetchObatData(); // Reload data
                        } else {
                            alert('Gagal menambah data obat: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        alert('Terjadi kesalahan saat menambah data.');
                    }
                });
            });

            // Delete Obat Modal handler
            $(document).on('click', '.delete-btn', function() {
                let kodeObat = $(this).data('kode');
                let deleteUrl = `/api/obat/delete/${kodeObat}`; // Adjust this if your delete route is different
                $('#deleteObatForm').attr('action', deleteUrl);
            });

            // Delete Obat Form Submission
            $('#deleteObatForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let token = $('input[name="_token"]').val(); // Get CSRF token
                let methodOverride = $('input[name="_method"]').val(); // Get method override

                $.ajax({
                    url: url,
                    type: 'POST', // Always POST for method override
                    data: {
                        _token: token,
                        _method: methodOverride
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#hapusObatModalGlobal').modal('hide');
                            fetchObatData(); // Reload data
                        } else {
                            alert('Gagal menghapus data obat: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                });
            });


            // Edit Obat Modal handler (using delegated event for dynamically loaded buttons)
            $(document).on('click', '.editCategory', function() {
                const kodeObat = $(this).data('kode');
                const namaObat = $(this).data('nama');
                const takaranMinum = $(this).data('takaran');
                const jmlKaliMinum = $(this).data('jumlah-kali');
                const jmlObatPerMinum = $(this).data('jumlah-obat-per-minum');
                const bentukObat = $(this).data('bentuk');
                const kemasanObat = $(this).data('kemasan');
                const aturanPakai = $(this).data('aturan-pakai');
                const golonganObat = $(this).data('golongan');
                const jumlahObat = $(this).data('jumlah');
                const waktuMinum = $(this).data('waktu');
                const keterangan = $(this).data('keterangan');
                const hargaSatuan = $(this).data('harga');
                const kontraindikasi = $(this).data('kontra');
                const polaMakan = $(this).data('pola');
                const interaksiObat = $(this).data('interaksi');
                const petunjukPenyimpanan = $(this).data('penyimpanan');
                const kekuatanSediaan = $(this).data('kekuatan');
                const informasiTambahan = $(this).data('tambahan');
                const efekSamping = $(this).data('efek');
                const indikasi = $(this).data('indikasi');
                const statusKetersediaan = $(this).data('status');

                $('#editKodeObat').val(kodeObat);
                $('#editNamaObat').val(namaObat);
                $('#editTakaranMinum').val(takaranMinum);
                $('#editJmlKaliMinum').val(jmlKaliMinum);
                $('#editJmlObatPerMinum').val(jmlObatPerMinum);
                $('#editBentukObat').val(bentukObat);
                $('#editKemasanObat').val(kemasanObat);
                $('#editAturanPakai').val(aturanPakai);
                $('#editGolonganObat').val(golonganObat);
                $('#editJumlahObat').val(jumlahObat);
                $('#editWaktuMinum').val(waktuMinum);
                $('#editKeterangan').val(keterangan);
                $('#editHargaSatuan').val(hargaSatuan);
                $('#editKontraindikasi').val(kontraindikasi);
                $('#editPolaMakan').val(polaMakan);
                $('#editInteraksiObat').val(interaksiObat);
                $('#editPetunjukPenyimpanan').val(petunjukPenyimpanan);
                $('#editKekuatanSediaan').val(kekuatanSediaan);
                $('#editInformasiTambahan').val(informasiTambahan);
                $('#editEfekSamping').val(efekSamping);
                $('#editIndikasi').val(indikasi);
                $('#editStatusKetersediaan').val(statusKetersediaan);

                // Set form action for update
                $('#editObatForm').attr('action', `/api/obat/update/${kodeObat}`); // Adjust this if your update route is different

                $('#editObatModal').modal('show');
            });

            // Edit Obat Form Submission
            $('#editObatForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let formData = form.serialize();

                $.ajax({
                    url: url,
                    type: 'POST', // Use POST with _method for PUT
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#editObatModal').modal('hide');
                            fetchObatData(); // Reload data
                        } else {
                            alert('Gagal mengupdate data obat: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        alert('Terjadi kesalahan saat mengupdate data.');
                    }
                });
            });
        });
    </script>
@endpush
