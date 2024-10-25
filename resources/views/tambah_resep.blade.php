@extends('footerheader.navbar')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-10">
        <div class="card p-4" style="width: 768px;">
            <h3 class="text-center mt-2">Cari Pasien Terdaftar</h3>
            
            <hr>
            <form action="{{ route('pasien-terdaftar') }}" method="GET">
                <div class="mb-3">
                    <label for="no_rm" class="form-label">No RM</label>
                    <input type="text" id="no_rm" class="form-control" name="no_rm">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pasien</label>
                    <input type="text" id="nama" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" id="alamat" class="form-control" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" class="form-control" name="tanggal_lahir">
                </div>
                <div class="d-flex justify-content-end mx-">
                    <button type="submit" class="btn btn-resep mx-2" style="width: 90px">Cari</button>
                    <button type="reset" class="btn btn-secondary mx-2" style="width: 90px">Reset</button>
                </div>
            </form>
        </div>
    </div>

@endsection
