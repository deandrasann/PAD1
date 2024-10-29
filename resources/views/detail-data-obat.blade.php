@extends('footerheader.navbar')
@section('content')


<div class="d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <div class="container">
            <h2 class="my-4">DATA DATA OBAT</h2>
        </div>
        <div class="container">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Dosis</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Aturan Pakai</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Waktu Kali Minum</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Jumlah Obat</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Efek Samping</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Kontraindikasi</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Interaksi Obat</th>
                        <td>: </td>
                    </tr>
                    <tr>
                        <th>Petunjuk Penyimpanan</th>
                        <td>: </td>

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
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        {{-- <div class="paginate d-flex justify-content-center">
            {{ $data_pasien->links() }}
        </div> --}}
    </div>
</div>
@endsection
