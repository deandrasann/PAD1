@extends('footerheader.navbar')

@section('content')
    <div class="container mt-4">
        <h2>DATA RESEP OBAT</h2>

        <button type="button" class="btn btn-resep mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#tambahObatModal">
            + Tambah Obat
        </button>

        <!-- Search Bar -->
        <form action="{{ route('daftar-obat') }}" method="GET">
            <div class="search-bar mb-3">
                <input type="text" class="form-control" placeholder="Cari Obat" name="search"
                    value="{{ request('search') }}" autocomplete="off">
                <button class="btn btn-link" type="submit">
                    <img src="{{ asset('images/search icon.png') }}">
                </button>
            </div>
        </form>

        <!-- Tabel Data Resep Obat -->
        <div class="table-data table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th style="width:210px;">Indikasi</th>
                        <th style="width:210px;">Golongan Obat</th>
                        <th style="width:180px;">Nama Obat</th>
                        <th style="width:210px;">Status Ketersediaan Obat</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data_obat as $index => $item)
                        <tr>
                            <td>{{ $data_obat->firstItem() + $index }}</td>
                            <td>{{ $item->indikasi }}</td>
                            <td>{{ $item->golongan_obat }}</td>
                            <td>{{ $item->nama_obat }}</td>
                            <td
                                class=" 
                            @if ($item->status_ketersediaan_obat == 'Stocked') text-success font-weight-bold
                            @elseif($item->status_ketersediaan_obat == 'Draft')
                                text-warning font-weight-bold
                            @elseif($item->status_ketersediaan_obat == 'Habis')
                                text-danger font-weight-bold @endif">
                                {{ $item->status_ketersediaan_obat }}
                            </td>
                            <td>
                                {{-- Detail Button --}}
                                <button class="btn btn-resep p-2 px-3 detail-btn" data-nama="{{ $item->nama_obat }}"
                                    data-indikasi="{{ $item->indikasi }}" data-golongan="{{ $item->golongan_obat }}"
                                    data-efek="{{ $item->efek_samping }}" data-kontra="{{ $item->kontraindikasi }}"
                                    data-pola="{{ $item->pola_makan }}" data-tambahan="{{ $item->informasi_tambahan }}"
                                    data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <!-- Edit Button -->
                                <button class="btn btn-success editCategory p-2 px-3"
                                    onclick="openEditObatModal({{ $item->kode_obat }})"
                                    id="editCategory1{{ $item->kode_obat }}">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#HapusObatModal{{ $item->kode_obat }}">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                            <td style="visibility: hidden; display: none"> {{ $item->bentuk_obat }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->kekuatan_sediaan }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->efek_samping }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->kontraindikasi }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->kekuatan_sediaan }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->interaksi_obat }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->petunjuk_penyimpanan }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->pola_makan }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->informasi_tambahan }} </td>
                            <td style="visibility: hidden; display: none"> {{ $item->status_ketersediaan_obat }} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="paginate d-flex justify-content-center">
                {{ $data_obat->links() }}
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
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Nama Obat </th>
                                    <td id="modalNama"></td>
                                </tr>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-resep" data-bs-dismiss="modal">Kembali</button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Hapus Obat Modal --}}
        <!-- Hapus Obat Modal -->
        @foreach ($data_obat as $item)
            <div class="modal fade" id="HapusObatModal{{ $item->kode_obat }}" tabindex="-1"
                aria-labelledby="HapusObatModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="HapusObatModalLabel">Hapus Data Obat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                            <p>Anda yakin ingin menghapus data obat ini?</p>
                            <form action="{{ route('obat.destroy', $item->kode_obat) }}" method="POST">
                                <div class="d-flex justify-content-around mt-3">
                                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-4">YA</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- Tambah Obat Modal --}}
        <div class="modal fade" id="tambahObatModal" tabindex="-1" aria-labelledby="tambahObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahObatModalLabel">Tambah Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('daftarobat.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Nama Obat -->
                            <div class="row mb-3">
                                <label for="namaapoteker" class="col-md-4 col-form-label">Nama Apoteker</label>
                                <div class="col-md-8">
                                    <select id="namaapoteker" name="id_apoteker" class="form-select">
                                        <option disabled selected>--Pilih Apoteker --</option>
                                        @foreach ($apoteker_obat as $ao)
                                            <option value="{{ $ao->id_apoteker }}"
                                                {{ old('nama_apoteker') == $ao->nama_apoteker ? 'selected' : null }}>
                                                {{ $ao->nama_apoteker }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="namaObat" class="col-md-4 col-form-label">Nama Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="namaObat" name="nama_obat"
                                        class="nama_obat" placeholder="Nama obat">
                                </div>
                            </div>

                            <!-- Bentuk Obat -->
                            <div class="row mb-3">
                                <label for="bentukObat" class="col-md-4 col-form-label">Bentuk Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="bentukObat" name="bentuk_obat"
                                        class="bentuk_obat" placeholder="Bentuk obat">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="golonganobat" class="col-md-4 col-form-label">Golongan Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="golonganobat" name="golongan_obat"
                                        class="golongan_obat" placeholder="Golongan obat">
                                </div>
                            </div>

                            <!-- Kebutuhan Sediaan & Satuan -->
                            <div class="row mb-3">
                                <label for="kekuatanSediaan" class="col-md-4 col-form-label">Kebutuhan Sediaan</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="kekuatanSediaan"
                                        name="kekuatan_sediaan" class="kekuatan_sediaan" placeholder="Kebutuhan Sediaan">
                                </div>
                            </div>

                            <!-- Efek Samping -->
                            <div class="row mb-3">
                                <label for="efekSamping" class="col-md-4 col-form-label">Efek Samping</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="efekSamping" name="efek_samping"
                                        class="efek_samping" placeholder="Efek Samping">
                                </div>
                            </div>

                            <!-- Kontraindikasi -->
                            <div class="row mb-3">
                                <label for="kontraindikasi" class="col-md-4 col-form-label">Kontraindikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="kontraindikasi" name="kontraindikasi"
                                        class="kontraindikasi" placeholder="Kontraindikasi">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="indikasi" class="col-md-4 col-form-label">indikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="indikasi" name="indikasi"
                                        class="indikasi" placeholder="indikasi">
                                </div>
                            </div>

                            <!-- Interaksi Obat -->
                            <div class="row mb-3">
                                <label for="interaksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="interaksiObat" name="interaksi_obat"
                                        class="interaksi_obat" placeholder="Interaksi Obat">
                                </div>
                            </div>

                            <!-- Petunjuk Penyimpanan -->
                            <div class="row mb-3">
                                <label for="petunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk
                                    Penyimpanan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="petunjukPenyimpanan"
                                        name="petunjuk_penyimpanan" class="petunjuk_penyimpanan"
                                        placeholder="Petunjuk Penyimpanan">
                                </div>
                            </div>

                            <!-- Pola Makan dan Hidup Sehat -->
                            <div class="row mb-3">
                                <label for="polaMakan" class="col-md-4 col-form-label">Pola Makan dan Hidup Sehat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="polaMakan" name="pola_makan"
                                        class="pola_makan" placeholder="Pola Makan dan Hidup Sehat">
                                </div>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="row mb-3">
                                <label for="informasiTambahan" class="col-md-4 col-form-label">Informasi Tambahan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="informasiTambahan"
                                        name="informasi_tambahan" class="informasi_tambahan"
                                        placeholder="Informasi Tambahan">
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


    </div>

    {{-- Edit Obat Modal --}}
    <div class="modal fade" id="editObatModal1" tabindex="-1" aria-labelledby="editObatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editObatModalLabel">Edit Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formeditan">
                    @csrf
                    <div class="modal-body">
                        <!-- Nama Obat -->
                        <div class="row mb-3">
                            <label for="namaobateditan" class="col-md-4 col-form-label">Nama Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="namaobateditan" name="nama_obat"
                                    placeholder="Nama obat">
                            </div>
                        </div>

                        <!-- Bentuk Obat -->
                        <div class="row mb-3">
                            <label for="bentukobateditan" class="col-md-4 col-form-label">Bentuk Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="bentukobateditan" name="bentuk_obat"
                                    placeholder="Bentuk obat">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="golonganobateditan" class="col-md-4 col-form-label">Golongan Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="golonganobateditan" name="golongan_obat"
                                    placeholder="Golongan obat">
                            </div>
                        </div>

                        <!-- Kebutuhan Sediaan & Satuan -->
                        <div class="row mb-3">
                            <label for="kekuatansediaaneditan" class="col-md-4 col-form-label">Kebutuhan Sediaan</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="kekuatansediaaneditan"
                                    name="kekuatan_sediaan" placeholder="Kebutuhan Sediaan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="statussediaedit" class="col-md-4 col-form-label">Status Ketersediaan</label>
                            <div class="col-md-8">
                                <select id="statussediaedit" name="status_ketersediaan_obat" class="form-select">
                                    <option disabled selected>--Pilih Status Ketersediaan Obat --</option>
                                    <option value="Stocked" {{ old('statussediaedit') == 'Stocked' ? 'selected' : '' }}>
                                        Stocked</option>
                                    <option value="Draft" {{ old('statussediaedit') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="Habis" {{ old('statussediaedit') == 'Habis' ? 'selected' : '' }}>Habis
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Efek Samping -->
                        <div class="row mb-3">
                            <label for="efeksampingeditan" class="col-md-4 col-form-label">Efek Samping</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="efeksampingeditan" name="efek_samping"
                                    placeholder="Efek Samping">
                            </div>
                        </div>

                        <!-- Kontraindikasi -->
                        <div class="row mb-3">
                            <label for="kontraindikasieditan" class="col-md-4 col-form-label">Kontraindikasi</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="kontraindikasieditan"
                                    name="kontraindikasi" placeholder="Kontraindikasi">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="indikasieditan" class="col-md-4 col-form-label">Indikasi</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="indikasieditan" name="indikasi"
                                    placeholder="indikasi">
                            </div>
                        </div>

                        <!-- Interaksi Obat -->
                        <div class="row mb-3">
                            <label for="interaksiobateditan" class="col-md-4 col-form-label">Interaksi Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="interaksiobateditan"
                                    name="interaksi_obat" placeholder="Interaksi Obat">
                            </div>
                        </div>

                        <!-- Petunjuk Penyimpanan -->
                        <div class="row mb-3">
                            <label for="petunjukpenyimpananeditan" class="col-md-4 col-form-label">Petunjuk
                                Penyimpanan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="petunjukpenyimpananeditan"
                                    name="petunjuk_penyimpanan" placeholder="Petunjuk Penyimpanan">
                            </div>
                        </div>

                        <!-- Pola Makan dan Hidup Sehat -->
                        <div class="row mb-3">
                            <label for="polamakaneditan" class="col-md-4 col-form-label">Pola Makan dan Hidup
                                Sehat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="polamakaneditan" name="pola_makan"
                                    placeholder="Pola Makan dan Hidup Sehat">
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="row mb-3">
                            <label for="informasitambahaneditan" class="col-md-4 col-form-label">Informasi
                                Tambahan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="informasitambahaneditan"
                                    name="informasi_tambahan" placeholder="Informasi Tambahan">
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

<script>
    function openEditObatModal(id) {
        // document.getElementById('editObatModal').style.visibility="true";
        $('#editObatModal1').modal('show');
        var editButton = document.getElementById("editCategory1" + id);
        var row = editButton.closest("tr");
        var data = row.getElementsByTagName('td');

        document.getElementById("formeditan").action = "{{ route('daftarobat.update', '') }}/" + id;
        document.getElementById("indikasieditan").value = data[1].innerText;
        document.getElementById("golonganobateditan").value = data[2].innerText;
        document.getElementById("namaobateditan").value = data[3].innerText;
        document.getElementById("bentukobateditan").value = data[6].innerText;
        document.getElementById("efeksampingeditan").value = data[8].innerText;
        document.getElementById("kontraindikasieditan").value = data[9].innerText;
        document.getElementById("kekuatansediaaneditan").value = data[10].innerText;
        document.getElementById("interaksiobateditan").value = data[11].innerText;
        document.getElementById("petunjukpenyimpananeditan").value = data[12].innerText;
        document.getElementById("polamakaneditan").value = data[13].innerText;
        document.getElementById("informasitambahaneditan").value = data[14].innerText;
        document.getElementById("statussediaedit").value = data[15].innerText;
        // console.log(data);

    }
</script>
