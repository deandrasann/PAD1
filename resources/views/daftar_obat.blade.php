@extends('footerheader.navbar')

@section('content')

<div class="container mt-4">
    <h2>DATA RESEP OBAT</h2>

    <div class="d-flex justify-content-between align-items-center">
        <div class="card my-4" style="width: 24rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-5"><strong>No Resep</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Tanggal Resep</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Nama </strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Jenis Kelamin</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>No Telepon</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
                <div class="row">
                    <div class="col-5"><strong>Alamat</strong></div>
                    <div class="col-1">:</div>
                    <div class="col-5">11</div>
                </div>
            </div>
        </div>

        <a href="#" class="container-row-2 p-4" data-bs-toggle="modal" data-bs-target="#cetakObat">
            <img src="{{ asset('images/printer.png') }}">
        </a>
    </div>

    <button type="button" class="btn btn-resep tambah-obat-btn">
        <strong>+ Tambah Obat</strong>
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
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_role }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <!-- Detail Button -->
                            <button class="btn btn-resep p-2 px-3 detail-btn" data-bs-toggle="modal" data-bs-target="#detailObatModal">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                            </button>

                            <!-- Edit Button -->
                            <button class="btn btn-success p-2 px-3 edit-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Edit
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger p-2 px-3 delete-btn">
                                <img src="{{ asset('images/detail icon.png') }}" class="me-2">Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Detail Modal -->
        <div class="modal fade" id="detailObatModal" tabindex="-1" aria-labelledby="detailObatModalLabel" aria-hidden="true">
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
                                    <th>Nama</th>
                                    <td>: Amlodipine Tablet 10 mg</td>
                                </tr>
                                <tr>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Pagination -->
    <div class="paginate d-flex justify-content-center">
        {{ $data->links() }}
    </div>
</div>

@endsection
