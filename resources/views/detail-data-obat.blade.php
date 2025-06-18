<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail-resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center flex-column align-items-center p-4">
        <div class="d-flex flex-row flex-center card p-4 mb-4">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <div>
                                    {!! $qrCode !!}
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    
    
</body>
</html>




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

