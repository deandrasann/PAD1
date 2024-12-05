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

        <a href='{{route('detail-resep-obat', $resep_obat->id_pasien)}}' class="container-row-2 p-4">
            <img src="{{ asset('images/printer.png') }}">
        </a>
    </div>

        <button type="button" class="btn btn-resep mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#tambahObatModal">
            + Tambah Resep
        </button>

        <!-- Search Bar -->
        <form action="{{ route('resep-tiap-pasien', $resep_obat->id_pasien) }}" method="GET">
        <div class="search-bar mb-3">
            <input type="text" class="form-control" placeholder="Cari Resep" name="search" value="{{ request("search") }}" autocomplete="off">
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
                                <button class="btn btn-resep p-2 px-3 detail-btn" data-nama="{{ $item->nama_obat }}"
                                    data-indikasi="{{ $item->indikasi }}" data-golongan="{{ $item->golongan_obat }}"
                                    data-efek="{{ $item->efek_samping }}" data-kontra="{{ $item->kontraindikasi }}"
                                    data-pola="{{ $item->pola_makan }}" data-tambahan="{{ $item->informasi_tambahan }}"
                                    data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger p-2 px-3 delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#HapusObatModal{{ $item->no_resep }}">
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
        <!-- Hapus Obat Modal -->
        @foreach($data as $key)
        <div class="modal fade" id="HapusObatModal{{ $key->no_resep }}" tabindex="-1" aria-labelledby="HapusObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="HapusObatModalLabel">Hapus Data Resep</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                        <p>Anda yakin ingin menghapus data resep ini?</p>
                        <form action="{{ route('resep.destroy', $key->no_resep)}}" method="POST">
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
                        <h5 class="modal-title" id="tambahObatModalLabel">Tambah Resep</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('reseptiappasien.store') }}" method="POST">
                      @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="noPemeriksaan" class="col-md-4 col-form-label">Nomor Antrian</label>
                            <div class="col-md-8">
                              {{-- <select id="noPemeriksaan" name="no_antrian" class="form-select" > --}}
                            <select id="noPemeriksaan" name="no_antrian" class="form-select" onmousedown="if(this.options.length>5){this.size=5;}">
                                <option disabled selected>--Pilih Nomor Antrian --</option>
                                @foreach($data_pemeriksaan as $pemeriksaaan)
                                <option value="{{ $pemeriksaaan->no_antrian }}" {{ old('no_antrian') == $pemeriksaaan->no_antrian ? 'selected' : null}}>{{ $pemeriksaaan->no_antrian }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <br>

                            <div class="row mb-3">
                              <label for="namadokter" class="col-md-4 col-form-label" onmousedown="if(this.options.length>5){this.size=5;}">Nama Dokter</label>
                              <div class="col-md-8">
                                <select id="namadokter" name="id_dokter" class="form-select" >
                                  <option disabled selected>--Pilih Dokter --</option>
                                  @foreach($data_dokter as $dokter)
                                  <option value="{{ $dokter->id_dokter }}" {{ old('nama_dokter') == $dokter->nama_dokter ? 'selected' : null}}>{{ $dokter->nama_dokter }}</option>
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
                                  <select id="namaObat" name="kode_obat" class="form-select" onmousedown="if(this.options.length>5){this.size=5;}">
                                    <option disabled selected>--Pilih Obat --</option>
                                    @foreach($data_obat as $obat)
                                    <option value="{{ $obat->kode_obat }}" {{ old('nama_obat') == $obat->nama_obat ? 'selected' : null}}>{{ $obat->nama_obat }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label for="hargaresep" class="col-md-4 col-form-label">Harga Resep</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="hargaresep" name="harga_satuan" class="harga_satuan" value="{{ $ }}" placeholder="Harga Resep">
                                </div>
                            </div> --}}
                           
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
