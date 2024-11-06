@extends('footerheader.navbar-pmo')

@section('content')
<nav class="nav">
    <a class="nav-link" href="{{ route('pmo-cek-pasien') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('pmo-data-resep') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{route('pmo-riwayat-minum-obat')}}">Riwayat Minum Obat</a>
</nav>
<div class="d-flex justfy-content-start">
    <div class="col-md-5 m-4">
        <table class="table table-striped table-hover">
            <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <th></th>
                    <th>Pagi (06.00 - 08.00)</th>
                    <th></th>
            </thead>
            <tbody>
                {{-- @forelse ($data_pasien as $index => $item) --}}
                <tr>
                    <td>1</td>
                    <td>Obat 1</td>
                    <td>Dosis 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Data 2</td>
                </tr>
                {{-- @empty --}}
                {{-- <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                </tr> --}}
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>

    <div class="col-md-5 m-4">
        <table class="table table-striped table-hover">
            <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <th></th>
                    <th>Siang (12.00 - 15.00)</th>
                    <th></th>
            </thead>
            <tbody>
                {{-- @forelse ($data_pasien as $index => $item) --}}
                <tr>
                    <td>1</td>
                    <td>Obat 1</td>
                    <td>Dosis 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Data 2</td>
                </tr>
                {{-- @empty --}}
                {{-- <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                </tr> --}}
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justfy-content-start">
    <div class="col-md-5 m-4 -p-4">
        <table class="table table-striped table-hover">
            <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <th></th>
                    <th>Malam (18.00 - 21.00)</th>
                    <th></th>
            </thead>
            <tbody>
                {{-- @forelse ($data_pasien as $index => $item) --}}
                <tr>
                    <td>1</td>
                    <td>Obat 1</td>
                    <td>Dosis 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Data 2</td>
                </tr>
                {{-- @empty --}}
                {{-- <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                </tr> --}}
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>

    <div class="col-md-5 m-4">
        <table class="table table-striped table-hover">
            <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <th></th>
                    <th>Kondisional</th>
                    <th></th>
            </thead>
            <tbody>
                {{-- @forelse ($data_pasien as $index => $item) --}}
                <tr>
                    <td>1</td>
                    <td>Obat 1</td>
                    <td>Dosis 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Data 2</td>
                </tr>
                {{-- @empty --}}
                {{-- <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                </tr> --}}
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end m-5">
    <a href ="{{ route('pmo-daftar-pasien') }}" class="btn btn-success p-2 px-3 edit-btn">
        Kembali
    </a>
</div>

@endsection
