@extends('footerheader.navbar-pmo')

@section('content')
<nav class="nav">
    <a class="nav-link" href="#">Data Resep</a>
    <a class="nav-link" href="{{ route('pmo-data-resep') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="#">Riwayat Minum Obat</a>
</nav>
<div class="col-md-6 m-4">
    <table class="table table-striped table-hover">
        <thead class="table-primary">
            <tr style="width: 200px">
                 Pagi (06.00 - 08.00)
            </tr>
        </thead>
        <tbody>
            {{-- @forelse ($data_pasien as $index => $item) --}}
            <tr>
                <td>
                    1
                </td>
                <td>
                    Data 1
                </td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td>
                    Data
                </td>
            </tr>
            {{-- @empty --}}
            {{-- <tr>
                <td colspan="7" class="text-center">Tidak Ada Data</td>
            </tr> --}}
            {{-- @endforelse --}}
        </tbody>
    </table>
</div>


@endsection
