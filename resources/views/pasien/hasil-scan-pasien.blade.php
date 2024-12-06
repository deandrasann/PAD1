@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav">
    <a class="nav-link" href="{{ route('hasil.scan') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('jadwal.obat') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{ route('laporan.obat') }}">Laporan Minum Obat</a>
    <a class="nav-link" href="{{ route('riwayat.minum.obat.pasien') }}">Riwayat Minum Obat</a>
</nav>
<h2 class="my-4">Data Resep Pasien</h2>
<main class="m-3" style="color: black">
    <div class="row m-2">
        <div class="col-3"><strong>No Resep</strong></div>
        <div class="col-1">:</div>
        <div class="col-5">-</div>
    </div>
    <div class="row m-2">
        <div class="col-3"><strong>Tanggal Resep</strong></div>
        <div class="col-1">:</div>
        <div class="col-5">-</div>
    </div>
    <div class="row m-2">
        <div class="col-3"><strong>Jumlah Obat</strong></div>
        <div class="col-1">:</div>
        <div class="col-5">-</div>
    </div>
    <div class="d-flex justify-content-center align-items-center p-4">
        <div class="card p-4 w-100 custom-card">
            <table class="table table-striped table-hover custom-table">
                <thead class="table-primary">
                    <tr>
                        <th class="py-2">No RM</th>
                        <th class="py-2">Nama Obat</th>
                        <th class="py-2">Status</th>
                        <th class="py-2" style="white-space: nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="width: 250px">
                            <div class="d-flex">
                                <button class="btn btn-resep p-2 detail-btn me-2" data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                                <button class="btn btn-danger p-2 delete-btn" data-bs-toggle="modal" data-bs-target="#HapusObatModal">
                                    <img src="{{ asset('images/atur icon.png') }}" class="me-2">Atur Jadwal
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Detail Modal -->
<div class="modal fade" id="detailObatModal" tabindex="-1" aria-labelledby="detailObatModalLabel"
aria-hidden="true" style="color: black">
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
                            <th>Dosis</th>
                            <td id="modalIndikasi"></td>
                        </tr>
                        <tr>
                            <th>Aturan Pakai</th>
                            <td id="modalGolongan"></td>
                        </tr>
                        <tr>
                            <th>Waktu Minum</th>
                            <td id="modalEfek"></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td id="modalKontra"></td>
                        </tr>
                        <tr>
                            <th>Jumlah Kali Minum</th>
                            <td id="modalPola"></td>
                        </tr>
                        <tr>
                            <th>Jumlah Obat</th>
                            <td id="modalTambahan"></td>
                        </tr>
                        <tr>
                            <th>Efek Samping</th>
                            <td id="modalTambahan"></td>
                        </tr>
                        <tr>
                            <th>Kontradiksi</th>
                            <td id="modalTambahan"></td>
                        </tr>
                        <tr>
                            <th>Interaksi Obat</th>
                            <td id="modalTambahan"></td>
                        </tr>
                        <tr>
                            <th>Petunjuk Penyimpanan</th>
                            <td id="modalTambahan"></td>
                        </tr>
                        <tr>
                            <th>Pola Makan Hidup Sehat</th>
                            <td id="modalTambahan"></td>
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
<!--Hapus Obat Modal-->
<div class="modal fade" id="HapusObatModal" tabindex="-1" aria-labelledby="HapusObatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HapusObatModalLabel">Atur Jadwal Minum Obat Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="obat1" class="form-label">Obat 1</label>
                        <input type="datetime-local" class="form-control" id="obat1" name="obat1">
                    </div>
                    <div class="mb-3">
                        <label for="obat2" class="form-label">Obat 2</label>
                        <input type="datetime-local" class="form-control" id="obat2" name="obat2">
                    </div>
                    <div class="mb-3">
                        <label for="obat3" class="form-label">Obat 3</label>
                        <input type="datetime-local" class="form-control" id="obat3" name="obat3">
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
@endsection
