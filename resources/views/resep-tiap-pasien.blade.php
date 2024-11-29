@extends('footerheader.navbar')

@section('content')
    <div class="container mt-4">
        <h2>Data Resep Obat {{ $resep_obat->nama }}</h2>

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
                            <td>{{ $item->golongan_obat }}</td>
                            <td>{{ $item->nama_obat }}</td>
                            <td>
                                <!-- Detail Button -->
                                {{-- <button class="btn btn-resep p-2 px-3 detail-btn" data-bs-toggle="modal" data-bs-target="#detailObatModal" name="kode_obat">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button> --}}
                                <button class="btn btn-resep p-2 px-3 detail-btn" data-nama="{{ $item->nama_obat }}"
                                    data-indikasi="{{ $item->indikasi }}" data-golongan="{{ $item->golongan_obat }}"
                                    data-efek="{{ $item->efek_samping }}" data-kontra="{{ $item->kontraindikasi }}"
                                    data-pola="{{ $item->pola_makan }}" data-tambahan="{{ $item->informasi_tambahan }}"
                                    data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <!-- Edit Button -->
                                {{-- <button class="btn btn-success p-2 px-3 edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editObatModal">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button> --}}
                                <button class="btn btn-success editCategory p-2 px-3" onclick="openEditCategoryModal({{$item->kode_obat}})" id="editCategory{{$item->kode_obat}}">
                                <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#HapusObatModal{{ $item->kode_obat }}">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                            <td style="visibility: hidden; display: none"> {{ $item->bentuk_obat }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->kekuatan_sediaan }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->efek_samping }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->kontraindikasi }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->kekuatan_sediaan }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->interaksi_obat }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->petunjuk_penyimpanan }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->pola_makan }} </td>
                            <td style="visibility: hidden; display: none" > {{ $item->informasi_tambahan }} </td>
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
        @foreach($data as $key)
        <div class="modal fade" id="HapusObatModal{{ $key->kode_obat }}" tabindex="-1" aria-labelledby="HapusObatModalLabel"
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
                        <form action="{{ route('resep.destroy', $key->kode_obat)}}" method="POST">
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
                    <form action="{{ route('reseptiappasien.store') }}" method="POST">
                      @csrf
                    <div class="modal-body">
                            <!-- Nama Obat -->
                            <div class="row mb-3">
                              <label for="namaapoteker" class="col-md-4 col-form-label">Nama Apoteker</label>
                              <div class="col-md-8">
                                <select id="namaapoteker" name="id_apoteker" class="form-select" >
                                  <option disabled selected>--Pilih Apoteker --</option>
                                  @foreach($apoteker_obat as $ao)
                                  <option value="{{ $ao->id_apoteker }}" {{ old('nama_apoteker') == $ao->nama_apoteker ? 'selected' : null}}>{{ $ao->nama_apoteker }}</option>
                                  @endforeach
                              </select>
                              </div>
                          </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <input type="hidden" class="form-control" id="idpasien" name="id_pasien" value="{{ $resep_obat->id_pasien }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="namaObat" class="col-md-4 col-form-label">Nama Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="namaObat" name="nama_obat" class="nama_obat" placeholder="Nama obat">
                                </div>
                            </div>

                            <!-- Bentuk Obat -->
                            <div class="row mb-3">
                                <label for="bentukObat" class="col-md-4 col-form-label">Bentuk Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="bentukObat" name="bentuk_obat" class="bentuk_obat"
                                        placeholder="Bentuk obat">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="golonganobat" class="col-md-4 col-form-label">Golongan Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="golonganobat" name="golongan_obat" class="golongan_obat"
                                        placeholder="Golongan obat">
                                </div>
                            </div>

                            <!-- Kebutuhan Sediaan & Satuan -->
                            <div class="row mb-3">
                                <label for="kekuatanSediaan" class="col-md-4 col-form-label">Kebutuhan Sediaan</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="kekuatanSediaan" name="kekuatan_sediaan" class="kekuatan_sediaan"
                                        placeholder="Kebutuhan Sediaan">
                                </div>
                            </div>

                            <!-- Efek Samping -->
                            <div class="row mb-3">
                                <label for="efekSamping" class="col-md-4 col-form-label">Efek Samping</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="efekSamping" name="efek_samping" class="efek_samping"
                                        placeholder="Efek Samping">
                                </div>
                            </div>

                            <!-- Kontraindikasi -->
                            <div class="row mb-3">
                                <label for="kontraindikasi" class="col-md-4 col-form-label">Kontraindikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="kontraindikasi" name="kontraindikasi" class="kontraindikasi"
                                        placeholder="Kontraindikasi">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="indikasi" class="col-md-4 col-form-label">indikasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="indikasi" name="indikasi" class="indikasi"
                                        placeholder="indikasi">
                                </div>
                            </div>

                            <!-- Interaksi Obat -->
                            <div class="row mb-3">
                                <label for="interaksiObat" class="col-md-4 col-form-label">Interaksi Obat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="interaksiObat" name="interaksi_obat" class="interaksi_obat"
                                        placeholder="Interaksi Obat">
                                </div>
                            </div>

                            <!-- Petunjuk Penyimpanan -->
                            <div class="row mb-3">
                                <label for="petunjukPenyimpanan" class="col-md-4 col-form-label">Petunjuk
                                    Penyimpanan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="petunjukPenyimpanan" name="petunjuk_penyimpanan" class="petunjuk_penyimpanan"
                                        placeholder="Petunjuk Penyimpanan">
                                </div>
                            </div>

                            <!-- Pola Makan dan Hidup Sehat -->
                            <div class="row mb-3">
                                <label for="polaMakan" class="col-md-4 col-form-label">Pola Makan dan Hidup Sehat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="polaMakan" name="pola_makan" class="pola_makan"
                                        placeholder="Pola Makan dan Hidup Sehat">
                                </div>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="row mb-3">
                                <label for="informasiTambahan" class="col-md-4 col-form-label">Informasi Tambahan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="informasiTambahan" name="informasi_tambahan" class="informasi_tambahan"
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
    <div class="modal fade" id="editObatModal" tabindex="-1" aria-labelledby="editObatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editObatModalLabel">Edit Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formedit">
                 @csrf
                <div class="modal-body">
                        <!-- Nama Obat -->
                        <div class="row mb-3">
                            <label for="namaObatedit" class="col-md-4 col-form-label">Nama Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="namaObatedit" name="nama_obat" placeholder="Nama obat">
                            </div>
                        </div>

                        <!-- Bentuk Obat -->
                        <div class="row mb-3">
                            <label for="bentukObatedit" class="col-md-4 col-form-label">Bentuk Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="bentukObatedit" name="bentuk_obat" placeholder="Bentuk obat">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="golonganobatedit" class="col-md-4 col-form-label">Golongan Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="golonganobatedit" name="golongan_obat" placeholder="Bentuk obat">
                            </div>
                        </div>

                        <input type="hidden" class="form-control" id="idpasien" name="id_pasien" value="{{ $resep_obat->id_pasien }}">

                        <!-- Kebutuhan Sediaan & Satuan -->
                        <div class="row mb-3">
                            <label for="kekuatanSediaanedit" class="col-md-4 col-form-label">Kebutuhan Sediaan</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="kekuatanSediaanedit" name="kekuatan_sediaan"
                                    placeholder="Kebutuhan Sediaan">
                            </div>
                        </div>

                        <!-- Efek Samping -->
                        <div class="row mb-3">
                            <label for="efekSampingedit" class="col-md-4 col-form-label">Efek Samping</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="efekSampingedit" name="efek_samping" placeholder="Efek Samping">
                            </div>
                        </div>

                        <!-- Kontraindikasi -->
                        <div class="row mb-3">
                            <label for="kontraindikasiedit" class="col-md-4 col-form-label">Kontraindikasi</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="kontraindikasiedit" name="kontraindikasi"
                                    placeholder="Kontraindikasi">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="indikasiedit" class="col-md-4 col-form-label">Indikasi</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="indikasiedit" name="indikasi"
                                    placeholder="indikasi">
                            </div>
                        </div>

                        <!-- Interaksi Obat -->
                        <div class="row mb-3">
                            <label for="interaksiObatedit" class="col-md-4 col-form-label">Interaksi Obat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="interaksiObatedit" name="interaksi_obat"
                                    placeholder="Interaksi Obat">
                            </div>
                        </div>

                        <!-- Petunjuk Penyimpanan -->
                        <div class="row mb-3">
                            <label for="petunjukPenyimpananedit" class="col-md-4 col-form-label">Petunjuk Penyimpanan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="petunjukPenyimpananedit" name="petunjuk_penyimpanan"
                                    placeholder="Petunjuk Penyimpanan">
                            </div>
                        </div>
                        
                        <!-- Pola Makan dan Hidup Sehat -->
                        <div class="row mb-3">
                            <label for="polaMakanedit" class="col-md-4 col-form-label">Pola Makan dan Hidup Sehat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="polaMakanedit" name="pola_makan"
                                    placeholder="Pola Makan dan Hidup Sehat">
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="row mb-3">
                            <label for="informasiTambahanedit" class="col-md-4 col-form-label">Informasi Tambahan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="informasiTambahanedit" name="informasi_tambahan"
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
     function openEditCategoryModal(id) {
    // document.getElementById('editObatModal').style.visibility="true";
    $('#editObatModal').modal('show');
    var editButton = document.getElementById("editCategory"+id);
    var row = editButton.closest("tr");
    var data = row.getElementsByTagName('td');

    document.getElementById("formedit").action = "{{route('reseptiappasien.update', '')}}/" + id;  
    document.getElementById("indikasiedit").value = data[1].innerText;  
    document.getElementById("golonganobatedit").value = data[2].innerText;  
    document.getElementById("namaObatedit").value = data[3].innerText;  
    document.getElementById("bentukObatedit").value = data[5].innerText;  
    document.getElementById("efekSampingedit").value = data[7].innerText;  
    document.getElementById("kontraindikasiedit").value = data[8].innerText;  
    document.getElementById("kekuatanSediaanedit").value = data[9].innerText;  
    document.getElementById("interaksiObatedit").value = data[10].innerText;  
    document.getElementById("petunjukPenyimpananedit").value = data[11].innerText;  
    document.getElementById("polaMakanedit").value = data[12].innerText;  
    document.getElementById("informasiTambahanedit").value = data[13].innerText;  
    // document.getElementById("editCategoryDescription").value = data[1].innerText;  
    // document.getElementById("editCategoryDescription").value = data[2].innerText;  
    // console.log(data);
    
  }
</script>
