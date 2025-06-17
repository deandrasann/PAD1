@extends('footerheader.navbar')
@section('content')
    <div class="mb-4">
        @isset($pasien)
            @if (isset($pasien->id_pasien))
                <a href="{{ route('resepsionis-tambah-kesehatan', ['id' => $pasien->id_pasien]) }}"
                    class="tab-link {{ Route::is('resepsionis-tambah-kesehatan') ? 'active' : '' }}">
                    Isi Data Kesehatan
                </a>
            @endif
        @endisset
    </div>
    <div class="container mt-4">
        <h5 class="text-center fw-bold mb-4">DATA KESEHATAN</h5>

        <!-- Golongan Darah & Merokok -->
        <form id="form-kesehatan">
            @csrf
            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Golongan Darah</label>
                    <input type="text" name="golongan_darah" class="form-control">
                    <div class="invalid-feedback" id="error-golongan-darah"></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label d-block">Merokok?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="merokok" id="merokokYa" value="ya">
                        <label class="form-check-label" for="merokokYa">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="merokok" id="merokokTidak" value="tidak">
                        <label class="form-check-label" for="merokokTidak">Tidak</label>
                    </div>
                    <div class="invalid-feedback d-block" id="error-merokok"></div>
                </div>
            </div>

            <!-- Berat Badan & Hamil/Menyusui -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="input-group">
                        <input type="number" name="berat_badan" class="form-control">
                        <span class="input-group-text">KG</span>
                        <div class="invalid-feedback" id="error-berat-badan"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label d-block">Hamil / Menyusui?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hamil_menyusui" id="hamil" value="hamil">
                        <label class="form-check-label" for="hamil">Hamil</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hamil_menyusui" id="menyusui"
                            value="menyusui">
                        <label class="form-check-label" for="menyusui">Menyusui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hamil_menyusui" id="tidak_keduanya"
                            value="Tidak Keduanya">
                        <label class="form-check-label" for="tidak_keduanya">Tidak Keduanya</label>
                    </div>
                    <div class="invalid-feedback d-block" id="error-hamil-menyusui"></div>
                </div>
            </div>

            <!-- Tinggi Badan -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input type="number" name="tinggi_badan" class="form-control">
                        <span class="input-group-text">CM</span>
                        <div class="invalid-feedback" id="error-tinggi-badan"></div>
                    </div>
                </div>
            </div>

            <!-- Observasi Awal -->
            <div class="mb-3">
                <label class="form-label fw-bold">OBSERVASI AWAL</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Keluhan Awal <span class="text-danger">*</span></label>
                <textarea class="form-control" name="keluhan_awal" rows="3"></textarea>
                <div class="invalid-feedback" id="error-keluhan-awal"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan Alergi Obat <span class="text-danger">*</span></label>
                <input type="text" name="alergi_obat" class="form-control">
                <div class="invalid-feedback" id="error-alergi-obat"></div>
            </div>
            <!-- Nama Dokter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Pilih Dokter</label>
                    <select class="form-select js-dokter-select" name="id_dokter" required>
                        <option value="" disabled selected>-- Pilih Dokter --</option>
                    </select>
                </div>
            </div>

            <!-- Tanda-Tanda Vital -->
            <div class="mb-3">
                <label class="form-label fw-bold">TANDA - TANDA VITAL</label>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Suhu Tubuh</label>
                    <div class="input-group">
                        <input type="number" name="suhu_tubuh" class="form-control">
                        <span class="input-group-text">°C</span>
                        <div class="invalid-feedback" id="error-suhu-tubuh"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nadi</label>
                    <div class="input-group">
                        <input type="number" name="nadi" class="form-control">
                        <span class="input-group-text">bpm</span>
                        <div class="invalid-feedback" id="error-nadi"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sistole</label>
                    <div class="input-group">
                        <input type="number" name="sistole" class="form-control">
                        <span class="input-group-text">mmHg</span>
                        <div class="invalid-feedback" id="error-sistole"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Preferensi Pernapasan</label>
                    <div class="input-group">
                        <input type="number" name="pernapasan" class="form-control">
                        <span class="input-group-text">rpm</span>
                        <div class="invalid-feedback" id="error-pernapasan"></div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="form-label">Diastole</label>
                    <div class="input-group">
                        <input type="number" name="diastole" class="form-control">
                        <span class="input-group-text">mmHg</span>
                        <div class="invalid-feedback" id="error-diastole"></div>
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="text-end">
                <button type="submit" class="btn btn-success px-4">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-dokter-select').select2({
                placeholder: "-- Pilih Dokter --",
                allowClear: true
            });
        });
    </script>

    <script>
        const pasienId = '{{ $pasien->id_pasien }}'; // Pastikan controller Blade mengoper $id

        $(document).ready(function() {
            $.ajax({
                url: '/api/resepsionis-tambah-kesehatan/' + pasienId,
                method: 'GET',
                success: function(res) {
                    const pasien = res.data.pasien;
                    const dokters = res.data.dokters;

                    $('#id_pasien').val(pasien.id_pasien);
                    $('#isi-kesehatan-link').attr('href', '/resepsionis/tambah/kesehatan/' + pasien
                        .id_pasien);

                    dokters.forEach(function(dokter) {
                        $('.js-dokter-select').append(
                            `<option value="${dokter.id_dokter}">${dokter.nama_dokter}</option>`
                        );
                    });

                    $('.js-dokter-select').select2({
                        placeholder: "-- Pilih Dokter --",
                        allowClear: true
                    });
                },
                error: function() {
                    alert('Gagal memuat data pasien/dokter.');
                }
            });
        });
    </script>

    <script>
        $('#form-kesehatan').submit(function(e) {
            e.preventDefault();

            const pasienId = '{{ $pasien->id_pasien }}'; // pastikan $id tersedia
            const csrfToken = $('#csrf-token').val(); // ambil dari hidden input
            $.ajax({
                url: `/api/resepsionis-tambah-kesehatan/${pasienId}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    id_dokter: $('select[name="id_dokter"]').val(),
                    golongan_darah: $('input[name="golongan_darah"]').val().toUpperCase(),
                    merokok: $('input[name="merokok"]:checked').val(),
                    berat_badan: $('input[name="berat_badan"]').val(),
                    tinggi_badan: $('input[name="tinggi_badan"]').val(),
                    hamil_menyusui: $('input[name="hamil_menyusui"]:checked').val(),
                    keluhan_awal: $('textarea[name="keluhan_awal"]').val(),
                    alergi_obat: $('input[name="alergi_obat"]').val(),
                    suhu_tubuh: $('input[name="suhu_tubuh"]').val(),
                    nadi: $('input[name="nadi"]').val(),
                    sistole: $('input[name="sistole"]').val(),
                    diastole: $('input[name="diastole"]').val(),
                    pernapasan: $('input[name="pernapasan"]').val(),
                },
                success: function(response) {
                    alert(response.message);
                    window.location.href = '/resepsionis'; // arahkan ke halaman lain jika perlu
                },
                error: function(xhr) {
                    $('input, textarea, select').removeClass('is-invalid');
                    $('.invalid-feedback').text('');

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        for (let field in errors) {
                            let errorMessage = errors[field][0];

                            if (field === 'merokok' || field === 'hamil_menyusui') {
                                // Khusus radio button
                                $('input[name="' + field + '"]').addClass('is-invalid');
                                $('#error-' + field).text(errorMessage);
                            } else {
                                let inputField = $('[name="' + field + '"]');

                                // Jika pakai select2
                                if (inputField.hasClass('select2-hidden-accessible')) {
                                    inputField.next('.select2-container').find('.select2-selection')
                                        .addClass('is-invalid');
                                } else {
                                    inputField.addClass('is-invalid');
                                }

                                $('#error-' + field.replaceAll('_', '-')).text(errorMessage);
                            }
                        }
                    } else {
                        alert('Gagal menyimpan data kesehatan.');
                    }
                }
            });
        });
    </script>

@endsection
