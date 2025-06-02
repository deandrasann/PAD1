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
        <form method="POST" action="{{ route('simpan-kesehatan', ['id' => $pasien->id_pasien]) }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Golongan Darah</label>
                    <input type="text" name="golongan_darah" class="form-control">
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
                </div>
            </div>

            <!-- Berat Badan & Hamil/Menyusui -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="input-group">
                        <input type="number" name="berat_badan" class="form-control">
                        <span class="input-group-text">KG</span>
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
                </div>
            </div>

            <!-- Tinggi Badan -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input type="number" name="tinggi_badan" class="form-control">
                        <span class="input-group-text">CM</span>
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
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan Alergi Obat <span class="text-danger">*</span></label>
                <input type="text" name="alergi_obat" class="form-control">
            </div>
                        <!-- Nama Dokter -->
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Pilih Dokter</label>
        <select class="form-select js-dokter-select" name="id_dokter" required>
            <option value="" disabled selected>-- Pilih Dokter --</option>
            @foreach ($dokters as $dokter)
                <option value="{{ $dokter->id_dokter }}">{{ $dokter->nama_dokter }}</option>
            @endforeach
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
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nadi</label>
                    <div class="input-group">
                        <input type="number" name="nadi" class="form-control">
                        <span class="input-group-text">bpm</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sistole</label>
                    <div class="input-group">
                        <input type="number" name="sistole" class="form-control">
                        <span class="input-group-text">mmHg</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Preferensi Pernapasan</label>
                    <div class="input-group">
                        <input type="number" name="pernapasan" class="form-control">
                        <span class="input-group-text">rpm</span>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="form-label">Diastole</label>
                    <div class="input-group">
                        <input type="number" name="diastole" class="form-control">
                        <span class="input-group-text">mmHg</span>
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
@endsection
