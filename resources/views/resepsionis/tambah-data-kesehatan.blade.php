@extends('footerheader.navbar')
@section('content')
  <div class="mb-4">
        <a href="{{ route('resepsionis-tambah') }}" class="tab-link {{ Route::is('resepsionis-tambah') ? 'active' : '' }}"> Isi Data Personal</a>
        <a href="{{ route('resepsionis-tambah-kesehatan') }}" class="tab-link {{ Route::is('resepsionis-tambah-kesehatan') ? 'active' : '' }}"> Isi Data Kesehatan</a>
  </div>
<div class="container mt-4">
    <h5 class="text-center fw-bold mb-4">DATA KESEHATAN</h5>

    <!-- Golongan Darah & Merokok -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Golongan Darah</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label d-block">Merokok?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="merokokYa">
                <label class="form-check-label" for="merokokYa">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="merokokTidak">
                <label class="form-check-label" for="merokokTidak">Tidak</label>
            </div>
        </div>
    </div>

    <!-- Berat Badan & Hamil/Menyusui -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Berat Badan</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text">KG</span>
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label d-block">Hamil / Menyusui?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="hamil">
                <label class="form-check-label" for="hamil">Hamil</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="menyusui">
                <label class="form-check-label" for="menyusui">Menyusui</label>
            </div>
        </div>
    </div>

    <!-- Tinggi Badan -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Tinggi Badan</label>
            <div class="input-group">
                <input type="text" class="form-control">
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
        <textarea class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan Alergi Obat <span class="text-danger">*</span></label>
        <input type="text" class="form-control">
    </div>

    <!-- Tanda-Tanda Vital -->
    <div class="mb-3">
        <label class="form-label fw-bold">TANDA - TANDA VITAL</label>
    </div>
    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Suhu Tubuh</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text">°C</span>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Nadi</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text">bpm</span>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Sistole</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text">mmHg</span>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Preferensi Pernapasan</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text">rpm</span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <label class="form-label">Diastole</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text">mmHg</span>
            </div>
        </div>
    </div>

    <!-- Tombol Simpan -->
    <div class="text-end">
        <button class="btn btn-success px-4">Simpan</button>
    </div>
</div>

@endsection
