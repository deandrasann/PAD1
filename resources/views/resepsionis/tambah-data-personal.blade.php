@php
    $isDisabled = isset($pasien);
@endphp

@extends('footerheader.navbar')
@section('content')
    <style>

    </style>
    <!-- Tabs -->
    <div class="mb-4">
        <a href="{{ route('resepsionis-tambah-form') }}"
            class="tab-link {{ Route::is('resepsionis-tambah-form') ? 'active' : '' }}">
            Isi Data Personal</a>
        @isset($pasien)
            @if (isset($pasien->id_pasien))
                <a href="{{ route('resepsionis-tambah-kesehatan', ['id' => $pasien->id_pasien]) }}"
                    class="tab-link {{ Route::is('resepsionis-tambah-kesehatan') ? 'active' : '' }}">
                    Isi Data Kesehatan
                </a>
            @endif
        @endisset
    </div>

    <h4 class="text-center mb-4">DATA PERSONAL</h4>

    <form id="form-pasien">
        @csrf
        <div class="row">
            <!-- Kiri -->
            <div class="col-md-6">
                <h6>IDENTITAS PRIBADI</h6>

                <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    {{-- <input type="text" class="form-control"> --}}
                    <input type="text" class="form-control" name="nama" value="{{ $pasien->nama ?? '' }}"
                        {{ $isDisabled ? 'disabled' : '' }}>
                    <div class="invalid-feedback" id="error-nama"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    {{-- <input type="text" class="form-control"> --}}
                    <input type="text" class="form-control" name="jenis_kelamin"
                        value="{{ $pasien->jenis_kelamin ?? '' }}" {{ $isDisabled ? 'disabled' : '' }}>
                    <div class="invalid-feedback" id="error-jenis-kelamin"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    {{-- <input type="text" class="form-control"> --}}
                    <input type="text" class="form-control" name="tempat_lahir" value="{{ $pasien->tempat_lahir ?? '' }}"
                        {{ $isDisabled ? 'disabled' : '' }}>
                    <div class="invalid-feedback" id="error-tempat-lahir"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    {{-- <input type="date" class="form-control"> --}}
                    <input type="date" class="form-control" name="tanggal_lahir"
                        value="{{ $pasien->tanggal_lahir ?? '' }}" {{ $isDisabled ? 'disabled' : '' }}>
                    <div class="invalid-feedback" id="error-tanggal_lahir"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    {{-- <input type="text" class="form-control"> --}}
                    <input type="number" class="form-control" name="no_telp" value="{{ $pasien->no_telp ?? '' }}"
                        {{ $isDisabled ? 'disabled' : '' }}>
                    <div class="invalid-feedback" id="error-no_telp"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    {{-- <input type="email" class="form-control"> --}}
                    <input type="email" class="form-control" name="email" value="{{ $pasien->email ?? '' }}"
                        {{ $isDisabled ? 'disabled' : '' }}>
                    <div class="invalid-feedback" id="error-email"></div>
                </div>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <h6>ALAMAT</h6>

                <div class="mb-3">
                    <label class="form-label">Provinsi</label>
                    {{-- {{ dd($pasien->provinsi) }} --}}
                    <select id="provinsi" class="form-control" name="provinsi" style="width: 100%;"
                        {{ isset($pasien->provinsi) ? 'disabled' : '' }}>
                        <option value="" disabled {{ !isset($pasien->provinsi) ? 'selected' : '' }}>-- Pilih Provinsi
                            --</option>
                        @if (isset($pasien->provinsi))
                            <option value="{{ $pasien->provinsi }}" selected>{{ $pasien->provinsi }}</option>
                        @endif
                    </select>
                    <input type="hidden" name="nama_provinsi" id="nama_provinsi" value="{{ $pasien->provinsi ?? '' }}">

                </div>

                <div class="mb-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select id="kabupaten" class="form-control" name="kabupaten" style="width: 100%;"
                        {{ isset($pasien->kabupaten) ? 'disabled' : '' }}>
                        <option value="" disabled {{ !isset($pasien->kabupaten) ? 'selected' : '' }}>-- Pilih
                            Kab/Kota --</option>
                        @if (isset($pasien->kabupaten))
                            <option value="{{ $pasien->kabupaten }}" selected>{{ $pasien->kabupaten }}</option>
                        @endif
                    </select>
                    <input type="hidden" name="nama_kabupaten" id="nama_kabupaten" value="{{ $pasien->kabupaten ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kecamatan</label>
                    <select id="kecamatan" class="form-control" name="kecamatan" style="width: 100%;"
                        {{ isset($pasien->kecamatan) ? 'disabled' : '' }}>
                        <option value="" disabled {{ !isset($pasien->kecamatan) ? 'selected' : '' }}>-- Pilih
                            Kecamatan --</option>
                        @if (isset($pasien->kecamatan))
                            <option value="{{ $pasien->kecamatan }}" selected>{{ $pasien->kecamatan }}</option>
                        @endif
                    </select>
                    <input type="hidden" name="nama_kecamatan" id="nama_kecamatan" value="{{ $pasien->kecamatan ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Desa/Kelurahan</label>
                    <select id="kelurahan" class="form-control" name="kelurahan" style="width: 100%;"
                        {{ isset($pasien->kelurahan) ? 'disabled' : '' }}>
                        <option value="" disabled {{ !isset($pasien->kelurahan) ? 'selected' : '' }}>-- Pilih
                            Kelurahan --</option>
                        @if (isset($pasien->kelurahan))
                            <option value="{{ $pasien->kelurahan }}" selected>{{ $pasien->kelurahan }}</option>
                        @endif
                    </select>
                    <input type="hidden" name="nama_kelurahan" id="nama_kelurahan"
                        value="{{ $pasien->kelurahan ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" {{ $isDisabled ? 'disabled' : '' }}>{{ $pasien->alamat ?? '' }}</textarea>
                    <div class="invalid-feedback" id="error-alamat"></div>
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success" {{ $isDisabled ? 'disabled' : '' }}>Simpan</button>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Aktifkan select2
            $('#provinsi, #kabupaten, #kecamatan, #kelurahan').select2({
                // placeholder: "-- Pilih --",
                allowClear: true,
                width: "100%"
            });

            // Ambil daftar provinsi
            $.getJSON("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json", function(data) {
                console.log("Data Provinsi didapat:", data); // DEBUG 1

                $('#provinsi').empty().append(
                    '<option value="" disabled selected>-- Pilih Provinsi --</option>'
                );

                $.each(data, function(i, provinsi) {
                    console.log("Tambah provinsi:", provinsi.id, provinsi.name); // DEBUG 2
                    $('#provinsi').append('<option value="' + provinsi.id + '">' + provinsi.name +
                        '</option>');
                });

                console.log("Semua provinsi ditambahkan ke select"); // DEBUG 3
            });

            // Ketika provinsi dipilih
            $('#provinsi').on('change', function() {
                var provId = $(this).val();
                var provText = $('#provinsi option:selected').text();
                $('#nama_provinsi').val(provText); // simpan nama provinsi

                $('#kabupaten').empty().append(
                    '<option value="" disabled selected>-- Pilih Kab/Kota --</option>');
                $('#kecamatan').empty().append(
                    '<option value="" disabled selected>-- Pilih Kecamatan --</option>');
                $('#kelurahan').empty().append(
                    '<option value="" disabled selected>-- Pilih Kelurahan --</option>');

                if (provId) {
                    $.getJSON("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + provId +
                        ".json",
                        function(data) {
                            $.each(data, function(i, kabupaten) {
                                $('#kabupaten').append('<option value="' + kabupaten.id + '">' +
                                    kabupaten.name + '</option>');
                            });
                        });
                }
            });

            // Ketika kabupaten dipilih
            $('#kabupaten').on('change', func~tion() {
                var kabId = $(this).val();
                var kabText = $('#kabupaten option:selected').text();
                $('#nama_kabupaten').val(kabText); // simpan nama kabupaten

                $('#kecamatan').empty().append(
                    '<option value="" disabled selected>-- Pilih Kecamatan --</option>');
                $('#kelurahan').empty().append(
                    '<option value="" disabled selected>-- Pilih Kelurahan --</option>');

                if (kabId) {
                    $.getJSON("https://www.emsifa.com/api-wilayah-indonesia/api/districts/" + kabId +
                        ".json",
                        function(data) {
                            $.each(data, function(i, kecamatan) {
                                $('#kecamatan').append('<option value="' + kecamatan.id + '">' +
                                    kecamatan.name + '</option>');
                            });
                        });
                }
            });

            // Ketika kecamatan dipilih
            $('#kecamatan').on('change', function() {
                var kecId = $(this).val();
                var kecText = $('#kecamatan option:selected').text();
                $('#nama_kecamatan').val(kecText); // simpan nama kecamatan

                $('#kelurahan').empty().append(
                    '<option value="" disabled selected>-- Pilih Kelurahan --</option>');

                if (kecId) {
                    $.getJSON("https://www.emsifa.com/api-wilayah-indonesia/api/villages/" + kecId +
                        ".json",
                        function(data) {
                            $.each(data, function(i, kelurahan) {
                                $('#kelurahan').append('<option value="' + kelurahan.id + '">' +
                                    kelurahan.name + '</option>');
                            });
                        });
                }
            });

            // Ketika kelurahan dipilih
            $('#kelurahan').on('change', function() {
                var kelText = $('#kelurahan option:selected').text();
                $('#nama_kelurahan').val(kelText); // simpan nama kelurahan
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // ... script select2 tetap ...
            const csrfToken = $('#csrf-token').val(); // ambil dari hidden input

            $('#form-pasien').submit(function(e) {
                e.preventDefault();

                let formData = {
                    nama: $('input[name="nama"]').val(),
                    jenis_kelamin: $('input[name="jenis_kelamin"]').val(),
                    tempat_lahir: $('input[name="tempat_lahir"]').val(),
                    tanggal_lahir: $('input[name="tanggal_lahir"]').val(),
                    no_telp: $('input[name="no_telp"]').val(),
                    email: $('input[name="email"]').val(),
                    nama_provinsi: $('#nama_provinsi').val(),
                    nama_kabupaten: $('#nama_kabupaten').val(),
                    nama_kecamatan: $('#nama_kecamatan').val(),
                    nama_kelurahan: $('#nama_kelurahan').val(),
                    alamat: $('textarea[name="alamat"]').val(),
                    _token: $('#csrf-token').val(),
                };

                $.ajax({
                    url: '{{ url('/api/resepsionis-tambah-pasien') }}', // sesuaikan dengan route API kamu
                    method: 'POST',
                    data: formData,
                    success: function(res) {
                        alert('Berhasil menambahkan pasien dengan No RM: ' + res.data.no_rm);
                        location.href = '/resepsionis-tambah-kesehatan/' + res.data.id_pasien;
                    },
                    error: function(xhr) {
                        $('input, textarea, select').removeClass('is-invalid');
                        $('.invalid-feedback').text('');

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Loop untuk tampilkan error di setiap field
                            for (let field in errors) {
                                const inputField = $('[name="' + field + '"]');
                                const errorMessage = errors[field][0];

                                inputField.addClass('is-invalid');
                                $('#error-' + field).text(errorMessage);
                            }
                        } else {
                            let message = "Terjadi kesalahan tidak terduga.";

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message += "\nPesan Server: " + xhr.responseJSON.message;
                            } else if (xhr.responseText) {
                                message += "\nDetail: " + xhr.responseText;
                            }

                            alert(message);
                        }

                    }
                });
            });
        });
    </script>

@endsection
