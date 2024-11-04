@extends('footerheader.navbar')

@section('content')
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-4">TAMBAH PASIEN</h3>
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="noRM" class="form-label">No RM</label>
                        <input type="text" class="form-control" id="noRM" placeholder="No RM">
                    </div>
                    <div class="col-md-6">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenisKelamin" placeholder="Jenis Kelamin">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama" >
                    </div>
                    <div class="col-md-6">
                        <label for="noTelepon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" id="noTelepon" placeholder="No Telepon">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggalLahir" placeholder="Tanggal Lahir">
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" placeholder="Alamat">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-secondary me-2">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

@endsection
