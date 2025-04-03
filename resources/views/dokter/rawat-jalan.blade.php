@extends('footerheader.navbar')
@section('content')
<div class="d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <div class="d-flex align-items-center gap-2">
            <!-- Search No RM -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari No RM">
                <button class="btn btn-outline-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Search Nama Pasien -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari Nama Pasien">
                <button class="btn btn-outline-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Pilih Hari Tanggal -->
            <div class="input-group">
                <input type="date" class="form-control">
                <button class="btn btn-outline-primary" type="button">
                    <i class="fas fa-calendar-alt"></i>
                </button>
            </div>

            <!-- Tombol Refresh -->
            <button class="btn btn-outline-secondary">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
        <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Menunggu Konsultasi</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Selesai Konsultasi</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><div class="table-responsive my-4 mx-2">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="px-4 py-2" style="width: fit-content">Tanggal</th>
                            <th class="px-4 py-2">Antrean</th>
                            <th class="px-4 py-2">Pasien</th>
                            <th class="px-4 py-2">Dokter</th>
                            <th class="px-4 py-2">Aksi </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2"><strong>29 Sep 2024</strong><br>08.00 - 20.00</td>
                            <td class="px-4 py-2"><strong>1 (12:30)</strong><br>Belum Dipanggil </td>
                            <td class="px-4 py-2"><strong>Viska Ayu</strong> <br>87658</td>
                            <td class="px-4 py-2"><strong>dr. Andi </strong> <br>Poli Umum</td>
                            <td class="px-4 py-2">
                                <button class="btn btn-danger p-2 px-3 delete-btn">
                                    <i class="fa-solid fa-volume-high me-2"></i>Panggil
                                </button>
                                <button class="btn btn-resep p-2 px-3 detail-btn">
                                    <img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div></div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
          </div>
    </div>
</div>
@endsection
