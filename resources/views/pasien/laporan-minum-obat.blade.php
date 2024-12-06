@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav flex-column flex-md-row">
    <a class="nav-link" href="{{ route('hasil.scan') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('jadwal.obat') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{ route('laporan.obat') }}">Laporan Minum Obat</a>
    <a class="nav-link" href="{{ route('riwayat.minum.obat.pasien') }}">Riwayat Minum Obat</a>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Nama Obat</th>
                            <th class="px-4 py-2">Aturan Pakai</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">Waktu</td>
                            <td class="px-4 py-2">Nama Obat</td>
                            <td class="px-4 py-2">Aturan Pakai</td>
                            <td class="px-4 py-2 d-flex flex-row justify-content-center">
                                <div class="checklist-container d-flex flex-column flex-md-row">
                                    <label class="checklist-item mr-2">
                                        <input type="radio" name="status" class="checklist-radio" id="sudah">
                                        <span class="checklist-label">Sudah</span>
                                    </label>
                                    <label class="checklist-item mr-2">
                                        <input type="radio" name="status" class="checklist-radio" id="tunda">
                                        <span class="checklist-label">Tunda</span>
                                    </label>
                                    <label class="checklist-item">
                                        <input type="radio" name="status" class="checklist-radio" id="tidak">
                                        <span class="checklist-label">Tidak</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <!-- Pagination -->
                <div class="paginate d-flex justify-content-center">
                    {{ $data_pasien->links() }}
                </div>
                --}}
            </div>
        </div>
    </div>
</div>
@endsection
