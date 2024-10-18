@extends('footerheader.navbar')
@section('content')

<h2>Beranda</h2>

<div class="misahin role apoteker">
    <div class="info d-flex flex-wrap justify-content-start">
        <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Resep Baru</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/resep baru.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Pasien Baru</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/pasien baru.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-3 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-2">
                <h2>0</h2>
                <p><strong>Jumlah Pasien</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/jumlah pasien.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-4 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Resep Baru</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/resep baru.png')}}" class="ms-3">
            </div>
        </div>
    </div>
</div>

<div class="misahin role PMO">
    <div class="info d-flex flex-wrap justify-content-start">
        <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Pasien Baru</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/pasien baru.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Pasien Aktif</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/pasien aktif.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-3 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-2">
                <h2>0</h2>
                <p><strong>Riwayat Pasien</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/riwayat pasien.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-4 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-3">
                <h2>0</h2>
                <p><strong>Total Pasien</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/jumlah pasien.png')}}" class="ms-3">
            </div>
        </div>
    </div>
</div>
<div class="misahin role PMO">
    <div class="info d-flex flex-wrap justify-content-start">
        <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Jumlah Apoteker</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/jumlah apoteker.png')}}" class="ms-3">
            </div>
        </div>

        <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
            <div class="me-4">
                <h2>0</h2>
                <p><strong>Jumlah Pengawas</strong></p>
            </div>
            <div>
                <img src="{{ asset('images/beranda/jumlah pasien.png')}}" class="ms-3">
            </div>
        </div>
    </div>
</div>
<div class="table-data table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Obat </th>
                <th >Jumlah</th>

            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($data as $index => $item) --}}
                <tr>
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

@endsection
