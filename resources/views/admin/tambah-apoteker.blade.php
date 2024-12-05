@extends('footerheader.navbar')
@section('content')
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-4">TAMBAH APOTEKER</h3>
            <form action="{{ route('apoteker.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                    </div>
                    
                    <div class="col-md-6">
                        <label for="namaApoteker" class="form-label">Nama Apoteker</label>
                        <input type="text" class="form-control @error('nama_apoteker') is-invalid @enderror" id="namaApoteker" name="nama_apoteker" placeholder="Nama Apoteker" value="{{ old('nama_apoteker') }}">
                        @if ($errors->has('nama_apoteker'))
                        <span class="text-danger">{{ $errors->first('nama_apoteker') }}</span>
                    @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="photo" name="foto" value="{{ old('foto') }}">
                                @if ($errors->has('foto'))
                                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                                @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="document.location='{{route('jumlah-apoteker')}}'">Kembali</button>
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
