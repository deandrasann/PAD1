@extends('footerheader.navbar')
@section('content')
<div class="d-flex justify-content-between">
    <h2 class="m-4">PASIEN</h2>
    <a class="btn btn-resep m-4">+ Pasien</a>
</div>

<div class="container d-flex justify-content-center align-items-center p-4">
    <div class="card p-4 w-100">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Nama RM</th>
                    <th class="px-4 py-2">Tanggal Lahir</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Jenis Kelamin</th>
                    <th class="px-4 py-2">No Telp.</th>

                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($data as $index => $item) --}}
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        {{-- <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_role }}</td>
                        <td>{{ $item->username }}</td> --}}
                        <td>
                            -
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
