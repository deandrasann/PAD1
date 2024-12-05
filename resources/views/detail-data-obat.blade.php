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
                        <th>Nama</th>
                        <td>: {{ $item->nama_obat }} </td>
                    </tr>
                    <tr>
                        <th>Dosis</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Aturan Pakai</th>
                        <td>: {{ $item->aturan_pakai }} </td>
                    </tr>
                    <tr>
                        <th>Waktu Kali Minum</th>
                        <td>: {{ $item->jml_kali_minum }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Obat</th>
                        <td>:  {{ $item->jumlah_obat }}</td>
                    </tr>
                    <tr>
                        <th>Efek Samping</th>
                        <td>:  {{ $item->efek_samping }}</td>
                    </tr>
                    <tr>
                        <th>Kontraindikasi</th>
                        <td>:  {{ $item->kontraindikasi }}</td>
                    </tr>
                    <tr>
                        <th>Interaksi Obat</th>
                        <td>: {{ $item->interaksi_obat }}</td>
                    </tr>
                    <tr>
                        <th>Petunjuk Penyimpanan</th>
                        <td>: {{ $item->petunjuk_penyimpanan }}</td>

                    </tr>
                    <tr>
                        <th>Pola makan dan Hidup Sehat</th>
                        <td>
                            <ol>
                                <li>Perbanyak konsumsi air putih, sayuran, buah, ikan.</li>
                                <li>Kurangi konsumsi makanan/minuman manis, berlemak, garam.</li>
                                <li>Kurangi makanan instan (sosis, makanan kaleng).</li>
                                <li>Ganti konsumsi susu dengan yang rendah lemak.</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <th>Informasi Tambahan</th>
                        <td>
                            <ol>
                                <li>Hindari mengubah posisi tubuh secara tiba-tiba dari duduk ke berdiri atau berbaring ke duduk.</li>
                                <li>Rutin cek tekanan darah anda.</li>
                                <li>Hindari rokok.</li>
                                <li>Olahraga aerobik 30 menit tiap minggu.</li>
                            </ol>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div> --}}

