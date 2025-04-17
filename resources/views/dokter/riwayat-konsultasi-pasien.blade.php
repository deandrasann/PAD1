@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav">
    <a class="nav-link" href="{{ route('detail-data-pasien') }}">Isi Resume Medis</a>
    <a class="nav-link" href="{{ route('riwayat-konsultasi-pasien') }}">Riwayat Konsultasi</a>
</nav>

<div class="table-responsive my-4 mx-2">
    <table class="table table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th class="px-4 py-2" style="width: fit-content">Tanggal</th>
                <th class="px-4 py-2 w-25">Nakes</th>
                <th class="px-4 py-2">Anamnesa</th>
                <th class="px-4 py-2">Diagnosis</th>
                <th class="px-4 py-2">Medikamentosa </th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-4 py-2"><strong>29 Sep 2024</strong><br>08.00 - 20.00</td>
                <td class="px-4 py-2"><strong>dr.Sinta Rahmawati</strong><br>Poli Umum</td>
                <td class="px-4 py-2">Batuk Pilek</td>
                <td class="px-4 py-2">ISPA</td>
                <td class="px-4 py-2">R/ Paracemtamol 500 mg Tablet (10 Tablet) S 3x1 Tablet.</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
