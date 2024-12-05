@extends('footerheader.navbar')
@section('content')
<div class="d-flex justify-content-center flex-column align-items-center p-4">
    @foreach ($data_detail_obat as $item)
    <div class="d-flex flex-row flex-center card p-4 w-100 mb-4">
        <div class="container">
            <h2 class="my-4">Resep Obat</h2>
            <div class="d-flex flex-start">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>Nama Pasien</th>
                            <td>: {{ $item->nama_obat }}</td>
                        </tr>
                        <tr>
                            <th>Nama Obat</th>
                            <td>: {{ $item->nama_obat }}</td>
                        </tr>
                        <tr>
                            <th>Aturan Pakai</th>
                            <td>: {{ $item->aturan_pakai }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Minum</th>
                            <td>: {{ $item->jml_kali_minum }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <img src="{{ asset('images/barcodee.png') }}">
        </div>
    </div>
    @endforeach
</div>


@endsection


{{--
<div class="d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <div class="container">
            <h2 class="my-4">Resep Obat </h2>
        </div>
        <div class="container">
            <table class="table table-borderless">
                @foreach ($data_detail_obat as $item)
                <tbody>
                    <tr>
                        <th>Nama Pasien</th>
                        <td>: {{ $item->nama }} </td>
                    </tr>
                    <tr>
                        <th>Nama Obat</th>
                        <td>: {{ $item->nama_obat }}</td>
                    </tr>
                    <tr>
                        <th>Aturan Pakai</th>
                        <td>: {{ $item->jml_kali_minum }} Sehari {{ $item->takaran_minum }} </td>
                    </tr>
                    <tr>
                        <th>Waktu Minum</th>
                        <td>: {{ $item->aturan_pakai }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div> --}}

