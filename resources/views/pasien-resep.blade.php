@extends('footerheader.navbar')
@section('content')
<div class="container">
    <h2 class="me-4">DATA PASIEN</h2>
    @if ($data_pasien->isEmpty())
    <button type="button" class="btn btn-resep px-4 py-3 mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
       <strong> + Tambah Pasien</strong>
    </button>
    @endif

    <form action="{{ route('tambah-resep') }}" method="GET">
    <div class="search-bar mt-5">
        <input type="text" class="form-control" placeholder="Cari Obat" name="search" value="{{ request("search") }}">
        <button class="btn btn-link" type="submit">
            <img src="{{ asset('images/search icon.png') }}">
        </button>
    </div>
    </form>
</div>

<div class="d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">No RM</th>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Jenis kelamin</th>
                    <th class="px-4 py-2">Tanggal Lahir</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">No Telp</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data_pasien as $index => $item)
                <tr>
                    <td>{{ $data_pasien->firstItem() + $index }}</td>
                    <td>{{ $item->no_rm }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>
                        <button class="btn btn-resep p-2 px-3 detail-btn" type="submit" onclick="document.location='{{route('resep-tiap-pasien', $item->id_pasien)}}'">
                            <img  src="{{ asset('images/detail icon.png') }}" class="me-2"> Detail
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tambah Pasien Modal -->
        <div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPasienModalLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <!-- Nama Pasien -->
                            <div class="mb-3">
                                <label for="namaPasien" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="namaPasien" placeholder="Nama pasien">
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenisKelamin">
                                    <option selected>Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggalLahir">
                            </div>
                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Alamat pasien">
                            </div>
                            <!-- No Telp -->
                            <div class="mb-3">
                                <label for="noTelp" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="noTelp" placeholder="No telp pasien">
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

        {{-- Detail Pasien --}}



        <!-- Pagination -->
        <div class="paginate d-flex justify-content-center">
            {{ $data_pasien->links() }}
        </div>
    </div>
</div>
@endsection