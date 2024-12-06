@extends('footerheader.navbar-pmo')

@section('content')
<nav class="nav flex-column flex-sm-row">
    <a class="nav-link" href="{{ route('hasil.scan') }}">Data Resep</a>
    <a class="nav-link" href="{{ route('jadwal.obat') }}">Jadwal Minum Obat</a>
    <a class="nav-link" href="{{ route('laporan.obat') }}">Laporan Minum Obat</a>
    <a class="nav-link" href="{{ route('riwayat.minum.obat.pasien') }}">Riwayat Minum Obat</a>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <tr>
                        <th></th>
                        <th>Pagi (06.00 - 08.00)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Obat 1</td>
                        <td>Dosis 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Data 2</td>
                        <td>Dosis 2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6 mb-4">
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <tr>
                        <th></th>
                        <th>Siang (12.00 - 15.00)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Obat 1</td>
                        <td>Dosis 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Data 2</td>
                        <td>Dosis 2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <tr>
                        <th></th>
                        <th>Malam (18.00 - 21.00)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Obat 1</td>
                        <td>Dosis 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Data 2</td>
                        <td>Dosis 2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6 mb-4">
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="background-color: #4284B3; color: white; font-weight: 400;">
                    <tr>
                        <th></th>
                        <th>Kondisional</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Obat 1</td>
                        <td>Dosis 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Data 2</td>
                        <td>Dosis 2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
