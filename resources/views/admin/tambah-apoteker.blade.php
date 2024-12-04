@extends('footerheader.navbar')
@section('content')
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-4">TAMBAH APOTEKER</h3>
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="col-md-6">
                        <label for="namaApoteker" class="form-label">Nama Apoteker</label>
                        <input type="text" class="form-control" id="namaApoteker" placeholder="Nama Apoteker">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-secondary me-2">Batal</button>
                        <button type="submit" class="btn btn-resep">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection