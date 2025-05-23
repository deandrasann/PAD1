@extends('footerheader.navbar')

@section('content')
<h2>Daftar Pasien</h2>
<div class="container-fluid p-4">
    <div class="card p-4">

        <!-- Baris pencarian dan tombol tambah -->
        <div class="row g-2 mb-3 align-items-center">
            <div class="col-md-6 col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari No RM">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Nama Pasien">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 text-end">
                <!-- Tambah Pasien dengan margin-bottom -->
                <a href="{{ route('tambahrawatjalan') }}" class="btn btn-primary mb-3">
                    + Tambah Pasien
                </a>
            </div>
        </div>

        <!-- Tabel pasien -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No RM</th>
                        <th>Pasien</th>
                        <th>Tanggal lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pasien as $pasien)
                    <tr>
                        <td>{{ $pasien->no_rm }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d F Y') }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>
                            <a href="{{ route('detail', $pasien->id_pasien) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-info-circle me-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div class="d-flex justify-content-center mt-3">
            {{ $data_pasien->links() }}
        </div>

    </div>
</div>
@endsection
