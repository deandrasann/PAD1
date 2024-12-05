@extends('footerheader.navbar-pmo')
@section('content')
    <nav class="nav">
        <a class="nav-link" href="{{ route('pmo-cek-pasien', $pasien->id_pasien) }}">Data Resep</a>
        <a class="nav-link" href="{{ route('pmo-data-resep', $pasien->id_pasien) }}">Jadwal Minum Obat</a>
        <a class="nav-link" href="{{ route('pmo-riwayat-minum-obat', $pasien->id_pasien) }}">Riwayat Minum Obat</a>
    </nav>
    <main class="m-3" style="color: black">
        @if ($no_resep)
            <div class="row m-2">
                <div class="col-3"><strong>No Resep</strong></div>
                <div class="col-1">:</div>
                <div class="col-5">{{ $no_resep->no_resep }}</div>
            </div>
            <div class="row m-2">
                <div class="col-3"><strong>Tanggal Resep</strong></div>
                <div class="col-1">:</div>
                <div class="col-5">{{ $no_resep->tgl_resep }}</div>
            </div>
            <div class="row m-2">
                <div class="col-3"><strong>Jumlah Obat</strong></div>
                <div class="col-1">:</div>
                <div class="col-5">{{ $status_setuju_count }}</div>
            </div>
        @endif
        <div class="d-flex justify-content-center align-items-center p-4">
            <div class="card p-4 w-100">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="py-2">No RM</th>
                            <th class="py-2">Nama Obat</th>
                            <th class="py-2">Status</th>
                            <th class="py-2" style="white-space: nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_pasien as $index => $item)
                            <tr>
                                <td>{{ $item->no_rm }}</td>
                                <td>{{ $item->nama_obat }}</td>
                                <td
                                    class=" 
                        @if ($item->status_pengobatan == 'Proses Pengobatan') text-danger font-weight-bold
                        
                        @elseif($item->status_pengobatan == 'Pengobatan Selesai')
                            text-success font-weight-bold @endif">
                                    {{ $item->status_pengobatan }}
                                </td>
                                <td style="width: 250px">
                                    <div class="d-flex">
                                        {{-- <button class="btn btn-resep p-2 detail-btn me-2" data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button> --}}
                                        <button class="btn btn-resep p-2 detail-btn me-2" data-nama="{{ $item->nama_obat }}"
                                            data-dosis="{{ $item->dosis }}" data-aturan="{{ $item->aturan_pakai }}"
                                            data-waktu-minum="{{ $item->waktu_minum }}"
                                            data-keterangan="{{ $item->keterangan }}"
                                            data-jumlah-kali-minum="{{ $item->jml_kali_minum }}"
                                            data-takaran-minum="{{ $item->takaran_minum }}"
                                            data-efek-samping="{{ $item->efek_samping }}"
                                            data-kontradiksi="{{ $item->kontraindikasi }}"
                                            data-interaksi-obat="{{ $item->interaksi_obat }}"
                                            data-petunjuk-penyimpanan="{{ $item->petunjuk_penyimpanan }}"
                                            data-pola-makan-hidup-sehat="{{ $item->pola_makan }}"
                                            data-informasi-tambahan="{{ $item->informasi_tambahan }}"
                                            data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                            <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                        </button>

                                        {{-- <button class="btn btn-danger p-2 delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#HapusObatModal">
                                            <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hentikan
                                        </button> --}}
                                        <button class="btn btn-danger p-2 delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#HapusObatModal{{ $item->no_resep }}">
                                            <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hentikan
                                        </button>
                                    </div>
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
        </div>
        <div class="d-flex justify-content-end m-4">
            <a href ="{{ route('pmo-daftar-pasien') }}" class="btn btn-success p-2 px-3 edit-btn">
                Kembali
            </a>
        </div>
    </main>


    <!-- Detail Modal -->
    <div class="modal fade" id="detailObatModal" tabindex="-1" aria-labelledby="detailObatModalLabel"aria-hidden="true"
        style="color: black">
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
                                <th>Nama Obat</th>
                                <td id="modalNama"></td>
                            </tr>
                            <tr>
                                <th>Dosis</th>
                                <td id="modalDosis"></td>
                            </tr>
                            <tr>
                                <th>Aturan Pakai</th>
                                <td id="modalAturan"></td>
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
                                <th>Jumlah Kali Minum</th>
                                <td id="modalJumlahKaliMinum"></td>
                            </tr>
                            <tr>
                                <th>Takaran Minum</th>
                                <td id="modalTakaranMinum"></td>
                            </tr>
                            <tr>
                                <th>Efek Samping</th>
                                <td id="modalEfekSamping"></td>
                            </tr>
                            <tr>
                                <th>Kontradiksi</th>
                                <td id="modalKontradiksi"></td>
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
                                <th>Pola Makan Hidup Sehat</th>
                                <td id="modalPolaMakanHidupSehat"></td>
                            </tr>
                            <tr>
                                <th>Informasi Tambahan</th>
                                <td id="modalInformasiTambahan"></td>
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
    <!--Hapus Obat Modal-->
    @foreach($data_pasien as $key)
    <div class="modal fade " id="HapusObatModal{{ $key->no_resep }}" aria-labelledby="HapusObatModalLabel" aria-hidden="true"
        style="color: black">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <h3>Hentikan Obat</h3>
                    <p>Anda yakin ingin menghentikan obat ini? Status Akan berubah menjadi Pengobatan Selesai Jika Sudah dihentikan</p>
                    <form action="{{ route('pmo.destroy', $key->no_resep)}}" method="POST">
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
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.detail-btn');

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const nama = this.getAttribute('data-nama');
                const dosis = this.getAttribute('data-dosis');
                const aturan = this.getAttribute('data-aturan');
                const waktuMinum = this.getAttribute('data-waktu-minum');
                const keterangan = this.getAttribute('data-keterangan');
                const jumlahKaliMinum = this.getAttribute('data-jumlah-kali-minum');
                const takaranMinum = this.getAttribute('data-takaran-minum');
                const efekSamping = this.getAttribute('data-efek-samping');
                const kontradiksi = this.getAttribute('data-kontradiksi');
                const interaksiObat = this.getAttribute('data-interaksi-obat');
                const petunjukPenyimpanan = this.getAttribute('data-petunjuk-penyimpanan');
                const polaMakanHidupSehat = this.getAttribute('data-pola-makan-hidup-sehat');
                const informasiTambahan = this.getAttribute('data-informasi-tambahan');

                // Mengisi data ke dalam modal
                document.getElementById('modalNama').textContent = nama;
                document.getElementById('modalDosis').textContent = dosis;
                document.getElementById('modalAturan').textContent = aturan;
                document.getElementById('modalWaktuMinum').textContent = waktuMinum;
                document.getElementById('modalKeterangan').textContent = keterangan;
                document.getElementById('modalJumlahKaliMinum').textContent = jumlahKaliMinum;
                document.getElementById('modalTakaranMinum').textContent = takaranMinum;
                document.getElementById('modalEfekSamping').textContent = efekSamping;
                document.getElementById('modalKontradiksi').textContent = kontradiksi;
                document.getElementById('modalInteraksiObat').textContent = interaksiObat;
                document.getElementById('modalPetunjukPenyimpanan').textContent =
                    petunjukPenyimpanan;
                document.getElementById('modalPolaMakanHidupSehat').textContent =
                    polaMakanHidupSehat;
                document.getElementById('modalInformasiTambahan').textContent =
                    informasiTambahan;
            });
        });
    });
</script>
