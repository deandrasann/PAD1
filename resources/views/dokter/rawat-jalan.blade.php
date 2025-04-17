@extends('footerheader.navbar')
@section('content')
<h2 class="m-4"> RAWAT JALAN</h2>
<div class="container-fluid p-4">
    <div class="card p-4">
        <!-- Bagian Filter Pencarian -->
        <div class="row g-2">
            <!-- Search No RM -->
            <div class="col-md-6 col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari No RM">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Search Nama Pasien -->
            <div class="col-md-8 col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Nama Pasien">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Cari Klinik Pasien -->
            <div class="col-md-8 col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Klinik Pasien">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Pilih Hari Tanggal -->
            <div class="col-md-8 col-lg-3">
                <div class="input-group">
                    <input type="date" class="form-control">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Tombol Refresh di kanan layar -->
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-secondary" type="button" title="Refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </div>



        <!-- Tab Navigasi -->
        <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Menunggu Konsultasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Selesai Konsultasi</button>
            </li>
        </ul>

        <!-- Konten Tab -->
        <div class="tab-content" id="myTabContent">
            <!-- Tab Menunggu Konsultasi -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive my-4">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Tanggal</th>
                                <th>Antrean</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>29 Sep 2024</strong><br>08.00 - 20.00</td>
                                <td><strong>1 (12:30)</strong><br>Belum Dipanggil</td>
                                <td><strong>Viska Ayu</strong><br>87658</td>
                                <td><strong>dr. Andi</strong><br>Poli Umum</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-volume-high me-2"></i>Panggil
                                        </button>
                                        <button class="btn btn-resep">
                                            <a class="nav-link" href="{{ route('resume-medis') }}"><i class="fa-solid fa-circle-info me-2"></i>Detail</a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab Selesai Konsultasi -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive my-4">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Tanggal</th>
                                <th>Antrean</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>29 Sep 2024</strong><br>08.00 - 20.00</td>
                                <td><strong>1 (12:30)</strong><br>Belum Dipanggil</td>
                                <td><strong>Viska Ayu</strong><br>87658</td>
                                <td><strong>dr. Andi</strong><br>Poli Umum</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-resep">
                                            <a class="nav-link" href="{{ route('detail-data-pasien') }}"><i class="fa-solid fa-circle-info me-2"></i>Detail</a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
