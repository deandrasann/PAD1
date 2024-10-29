@extends('footerheader.navbar')

@section('content')
    <div class="container mt-4">
        <h2>DATA RESEP OBAT</h2>

        <div class="d-flex justify-content-between align-items-center">
            <div class="card my-4" style="width: 26rem;">
                <div class="card-body">
                    @if($resep_obat)
                    <div class="row">
                        <div class="col-5"><strong>No Resep</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5">{{ $resep_obat->no_resep }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Tanggal Resep</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5">{{ $resep_obat->tgl_resep }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Nama</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5">{{ $resep_obat->nama }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Jenis Kelamin</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5">{{ $resep_obat->jenis_kelamin }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>No Telepon</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5">{{ $resep_obat->no_telp }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Alamat</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5">{{ $resep_obat->alamat }}</div>
                    </div>
            @else
                <div class="alert alert-warning" role="alert">
                    Tidak ada data resep yang ditemukan.
                </div>
            @endif
                </div>
            </div>

        <a href='{{route('detail-resep-obat')}}' class="container-row-2 p-4">
            <img src="{{ asset('images/printer.png') }}">
        </a>
    </div>

        <button type="button" class="btn btn-resep mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#tambahObatModal">
            + Tambah Obat
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ $data->firstItem() + $index }}</td>
                            <td>{{ $item->indikasi }}</td>
                            <td>{{ $item->waktu_minum }}</td>
                            <td>{{ $item->nama_obat }}</td>
                            <td>
                                <!-- Detail Button -->
                                {{-- <button class="btn btn-resep p-2 px-3 detail-btn" data-bs-toggle="modal" data-bs-target="#detailObatModal" name="kode_obat">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button> --}}
                                <button class="btn btn-resep p-2 px-3 detail-btn" data-nama="{{ $item->nama_obat }}"
                                    data-indikasi="{{ $item->indikasi }}" data-golongan="{{ $item->waktu_minum }}"
                                    data-efek="{{ $item->efek_samping }}" data-kontra="{{ $item->kontraindikasi }}"
                                    data-pola="{{ $item->pola_makan }}" data-tambahan="{{ $item->informasi_tambahan }}"
                                    data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <!-- Edit Button -->
                                <button class="btn btn-success p-2 px-3 edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editObatModal">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#HapusObatModal">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="paginate d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detailObatModal" tabindex="-1" aria-labelledby="detailObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailObatModalLabel">Detail Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- @foreach ($data as $item) --}}
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Nama Obat </th>
                                    <td id="modalNama"></td>
                                </tr>
                                {{-- <tr>
                                    <th>Indikasi</th>
                                    <td>: Anti Hipertensi (menurunkan tekanan darah)</td>
                                </tr>
                                <tr>
                                    <th>Golongan Obat</th>
                                    <td>: Bengkak di pergelangan kaki, sakit kepala, wajah merah</td>
                                </tr>
                                <tr>
                                    <th>Efek Samping</th>
                                    <td>: Ibu menyusui</td>
                                </tr>
                                <tr>
                                    <th>Kontraindikasi</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Pola makan dan Hidup Sehat</th>
                                    <td>
                                        <ol>
                                            <li>Perbanyak konsumsi air putih, sayuran, buah, ikan.</li>
                                            <li>Kurangi konsumsi makanan/minuman manis, berlemak, garam.</li>
                                            <li>Kurangi makanan instan (sosis, makanan kaleng).</li>
                                            <li>Ganti konsumsi susu dengan yang rendah lemak.</li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Informasi Tambahan</th>
                                    <td>
                                        <ol>
                                            <li>Hindari mengubah posisi tubuh secara tiba-tiba dari duduk ke berdiri atau berbaring ke duduk.</li>
                                            <li>Rutin cek tekanan darah anda.</li>
                                            <li>Hindari rokok.</li>
                                            <li>Olahraga aerobik 30 menit tiap minggu.</li>
                                        </ol>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <th>Indikasi</th>
                                    <td id="modalIndikasi"></td>
                                </tr>
                                <tr>
                                    <th>Golongan Obat</th>
                                    <td id="modalGolongan"></td>
                                </tr>
                                <tr>
                                    <th>Efek Samping</th>
                                    <td id="modalEfek"></td>
                                </tr>
                                <tr>
                                    <th>Kontraindikasi</th>
                                    <td id="modalKontra"></td>
                                </tr>
                                <tr>
                                    <th>Pola makan dan Hidup Sehat</th>
                                    <td id="modalPola"></td>
                                </tr>
                                <tr>
                                    <th>Informasi Tambahan</th>
                                    <td id="modalTambahan"></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- @endforeach --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-resep" data-bs-dismiss="modal">Kembali</button>
                    </div>

                </div>
            </div>
        </div>
        {{-- Hapus Obat Modal --}}
        <!-- Hapus Obat Modal -->
        <div class="modal fade" id="HapusObatModal" tabindex="-1" aria-labelledby="HapusObatModalLabel"
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
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                            <button type="button" class="btn btn-danger px-4">YA</button>
                        </div>
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
                                    <input type="text" class="form-control" id="bentukObat"
                                        placeholder="Bentuk obat">
                                </div>
                            </div>

                            <!-- Kebutuhan Sediaan & Satuan -->
                            <div class="row mb-3">
                                <label for="kekuatanSediaan" class="col-md-4 col-form-label">Kebutuhan Sediaan</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="kekuatanSediaan"
                                        placeholder="Kebutuhan Sediaan">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="satuan" placeholder="Satuan">
                                </div>
                            </div>

                            <!-- Efek Samping -->
                            <div class="row mb-3">
                                <label for="efekSamping" class="col-md-4 col-form-label">Efek Samping</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="efekSamping"
                                        placeholder="Efek Samping">
                                </div>
                            </div>

                            <!-- Kontraindikasi -->
                            <div class="row mb-3">
                                <label for="kontraindikasi" class="col-md-4 col-form-label">Kontraindikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="kontraindikasi"
                                        placeholder="Kontraindikasi">
                                </div>
                            </div>

                            <!-- Interaksi Obat -->
                            <div class="row mb-3">
                                <label for="interaksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="interaksiObat"
                                        placeholder="Interaksi Obat">
                                </div>
                            </div>

                            <!-- Petunjuk Penyimpanan -->
                            <div class="row mb-3">
                                <label for="petunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk
                                    Penyimpanan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="petunjukPenyimpanan"
                                        placeholder="Petunjuk Penyimpanan">
                                </div>
                            </div>

                            <!-- Pola Makan dan Hidup Sehat -->
                            <div class="row mb-3">
                                <label for="polaMakan" class="col-md-4 col-form-label">Pola Makan dan Hidup Sehat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="polaMakan"
                                        placeholder="Pola Makan dan Hidup Sehat">
                                </div>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="row mb-3">
                                <label for="informasiTambahan" class="col-md-4 col-form-label">Informasi Tambahan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="informasiTambahan"
                                        placeholder="Informasi Tambahan">
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


    </div>

    {{-- Edit Obat Modal --}}
    <div class="modal fade" id="editObatModal" tabindex="-1" aria-labelledby="editObatModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" id="kekuatanSediaan"
                                    placeholder="Kebutuhan Sediaan">
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
                                <input type="text" class="form-control" id="kontraindikasi"
                                    placeholder="Kontraindikasi">
                            </div>
                        </div>

                        <!-- Interaksi Obat -->
                        <div class="row mb-3">
                            <label for="interaksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="interaksiObat"
                                    placeholder="Interaksi Obat">
                            </div>
                        </div>

                        <!-- Petunjuk Penyimpanan -->
                        <div class="row mb-3">
                            <label for="petunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk Penyimpanan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="petunjukPenyimpanan"
                                    placeholder="Petunjuk Penyimpanan">
                            </div>
                        </div>

                        <!-- Pola Makan dan Hidup Sehat -->
                        <div class="row mb-3">
                            <label for="polaMakan" class="col-md-4 col-form-label">Pola Makan dan Hidup Sehat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="polaMakan"
                                    placeholder="Pola Makan dan Hidup Sehat">
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="row mb-3">
                            <label for="informasiTambahan" class="col-md-4 col-form-label">Informasi Tambahan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="informasiTambahan"
                                    placeholder="Informasi Tambahan">
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


    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.detail-btn');

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const nama = this.getAttribute('data-nama');
                const indikasi = this.getAttribute('data-indikasi');
                const golongan = this.getAttribute('data-golongan');
                const efek = this.getAttribute('data-efek');
                const kontra = this.getAttribute('data-kontra');
                const pola = this.getAttribute('data-pola');
                const tambahan = this.getAttribute('data-tambahan');

                // Mengisi data ke dalam modal
                document.getElementById('modalNama').textContent = nama;
                document.getElementById('modalIndikasi').textContent = indikasi;
                document.getElementById('modalGolongan').textContent = golongan;
                document.getElementById('modalEfek').textContent = efek;
                document.getElementById('modalKontra').textContent = kontra;
                document.getElementById('modalPola').textContent = pola;
                document.getElementById('modalTambahan').textContent = tambahan;
            });
        });
    });
</script>
