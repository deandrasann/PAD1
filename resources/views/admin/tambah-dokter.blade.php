@extends('footerheader.navbar')
@section('content')

    <body>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">TAMBAH DOKTER</h3>
                    <form id="create-dokter-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="namadokter" class="form-label">Nama Dokter</label>
                                <input type="text" class="form-control @error('nama_dokter') is-invalid @enderror"
                                    id="namadokter" name="nama_dokter" placeholder="Nama Dokter"
                                    value="{{ old('nama_dokter') }}">
                                @if ($errors->has('nama_dokter'))
                                    <span class="text-danger">{{ $errors->first('nama_dokter') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Jenis Dokter</label>
                                <input type="text" class="form-control @error('jenis_dokter') is-invalid @enderror"
                                    id="jenis_dokter" name="jenis_dokter" placeholder="Jenis Dokter"
                                    value="{{ old('jenis_dokter') }}">
                                @if ($errors->has('jenis_dokter'))
                                    <span class="text-danger">{{ $errors->first('jenis_dokter') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="namadokter" class="form-label">Spesialis</label>
                                <input type="text" class="form-control @error('spesialis') is-invalid @enderror"
                                    id="spesialis" name="spesialis" placeholder="Spesialis" value="{{ old('spesialis') }}">
                                @if ($errors->has('spesialis'))
                                    <span class="text-danger">{{ $errors->first('spesialis') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="photo" class="form-label">Kode dokter</label>
                                <input type="number" class="form-control @error('kode_dokter') is-invalid @enderror"
                                    id="kode_dokter" name="kode_dokter" placeholder="Kode Dokter"
                                    value="{{ old('kode_dokter') }}">
                                @if ($errors->has('kode_dokter'))
                                    <span class="text-danger">{{ $errors->first('kode_dokter') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="photo" class="form-label">Kode bpjs</label>
                                <input type="number" class="form-control @error('kode_bpjs') is-invalid @enderror"
                                    id="kode_bpjs" name="kode_bpjs" placeholder="Kode Dokter"
                                    value="{{ old('kode_bpjs') }}">
                                @if ($errors->has('kode_bpjs'))
                                    <span class="text-danger">{{ $errors->first('kode_bpjs') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="photo" class="form-label">Foto</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="photo" name="foto" value="{{ old('foto') }}" />
                                @if ($errors->has('foto'))
                                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    onclick="document.location='{{ route('jumlah-dokter') }}'">Kembali</button>
                                <button type="submit" class="btn btn-resep">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#create-dokter-form').on('submit', function(e) {
                    e.preventDefault();

                    let formData = new FormData(this);

                    // Make the API request
                    $.ajax({
                        url: '/api/admin/dokter/create',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                window.location.href = '{{ route('jumlah-dokter') }}';
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            let errorMessage = 'Terjadi kesalahan pada server.'; // Pesan default
                            // Cek apakah server mengirim response JSON
                            if (xhr.responseJSON) {
                                errorMessage = xhr.responseJSON.message;
                                // Jika APP_DEBUG=true, tampilkan error teknisnya
                                if (xhr.responseJSON.error) {
                                    console.error("Detail Error:", xhr.responseJSON
                                        .error); // Tampilkan di console
                                    errorMessage += "\n\n(Detail: " + xhr.responseJSON.error +
                                        ")"; // Tampilkan di alert
                                }
                            }
                            alert(errorMessage);
                        }
                    });
                });
            });
        </script>

    </body>
@endsection
