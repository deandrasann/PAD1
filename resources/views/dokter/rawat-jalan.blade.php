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
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Menunggu Konsultasi</button>
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
                                @forelse ($antreanPasien as $index => $data)
                                    <tr>
                                        <td>
                                            <strong>{{ \Carbon\Carbon::parse($data->tanggal_pemeriksaan)->translatedFormat('d M Y') }}</strong><br>
                                            {{ \Carbon\Carbon::parse($data->created_at)->timezone('Asia/Jakarta')->format('H:i') }}
                                            Asia/Jakarta Timezone

                                        </td>
                                        <td>
                                            <strong>{{ $index + 1 }}</strong>
                                            ({{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }})
                                            <br>
                                            @if ($data->status_pemanggilan === 'sudah dipanggil')
                                                <span class="badge bg-success">Sudah Dipanggil</span>
                                            @elseif($data->status_pemanggilan === 'belum dipanggil')
                                                <span class="badge bg-danger">Belum Dipanggil</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $data->status_pemanggilan }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $data->nama_pasien }}</strong><br>{{ $data->no_rm }}
                                        </td>
                                        <td>
                                            <strong>{{ $data->nama_dokter }}</strong><br>{{ $data->spesialis }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <form action="{{ route('panggil.pasien', $data->id_pasien) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa-solid fa-volume-high me-2"></i>Panggil
                                                    </button>
                                                </form>
                                                <button type="submit" class="btn btn-resep">
                                                    <a class="nav-link"
                                                        href="{{ route('resume-medis', ['id_pemeriksaan_awal' => $data->id_pemeriksaan_awal]) }}">
                                                        <i class="fa-solid fa-circle-info me-2"></i>Detail
                                                    </a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada pasien hari ini.</td>
                                    </tr>
                                @endforelse
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
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Status Pemeriksaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pasien_selesai_konsultasi as $item)
                                    <tr>
                                        <td class="px-4 py-2">
                                            <strong>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</strong><br>
                                            {{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->format('H:i') }}
                                            Asia/Jakarta Timezone
                                        </td>
                                        <td class="px-4 py-2">{{ $item->nama ?? '-' }}</td>
                                        <td class="px-4 py-2"><strong>{{ $item->nama_dokter }}</strong><br>{{ $item->spesialis }}</td>
                                        <td class="px-4 py-2">
                                            @if ($item->status_pemeriksaan === 'selesai')
                                                <span class="badge rounded-pill bg-success shadow-sm px-3 py-1">Selesai</span>
                                            @elseif($item->status_pemeriksaan === 'sedang berjalan')
                                                <span class="badge rounded-pill bg-info shadow-sm px-3 py-1">Sedang Berjalan</span>
                                            @elseif($item->status_pemeriksaan === 'belum dipanggil')
                                                <span class="badge rounded-pill bg-danger shadow-sm px-3 py-1">Belum Dipanggil</span>
                                            @else
                                                <span class="badge rounded-pill bg-secondary shadow-sm px-3 py-1">{{ $item->status_pemeriksaan }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button class="btn btn-resep">
                                                   <a class="nav-link"
                                                        href="{{ route('detail-data-pasien', ['id_pemeriksaan_awal' => $item->id_pemeriksaan_awal]) }}">
                                                        <i class="fa-solid fa-circle-info me-2"></i>Detail
                                                    </a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Tidak ada riwayat konsultasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
