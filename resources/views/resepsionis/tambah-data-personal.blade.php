@extends('footerheader.navbar')
@section('content')
  <style>

  </style>
  <!-- Tabs -->
  <div class="mb-4">
        <a href="{{ route('resepsionis-tambah') }}" class="tab-link {{ Route::is('resepsionis-tambah') ? 'active' : '' }}"> Isi Data Personal</a>
        <a href="{{ route('resepsionis-tambah-kesehatan') }}" class="tab-link {{ Route::is('resepsionis-tambah-kesehatan') ? 'active' : '' }}"> Isi Data Kesehatan</a>
  </div>

  <h4 class="text-center mb-4">DATA PERSONAL</h4>

  <form>
    <div class="row">
      <!-- Kiri -->
      <div class="col-md-6">
        <h6>IDENTITAS PRIBADI</h6>

        <div class="mb-3">
          <label class="form-label">No RM</label>
          <input type="text" class="form-control" disabled>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Jenis Kelamin</label>
          <input type="text" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Tempat Lahir</label>
          <input type="text" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Nomor Telepon / Telepon Seluler</label>
          <input type="text" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control">
        </div>
      </div>

      <!-- Kanan -->
      <div class="col-md-6">
        <h6>ALAMAT</h6>

        <div class="mb-3">
          <label class="form-label">Provinsi</label>
          <select class="form-select">
            <option selected>Pilih Data</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Kabupaten/Kota</label>
          <select class="form-select">
            <option selected>Pilih Data</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Kecamatan</label>
          <select class="form-select">
            <option selected>Pilih Data</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Desa/Kelurahan</label>
          <select class="form-select">
            <option selected>Pilih Data</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea class="form-control" rows="3"></textarea>
        </div>
      </div>
    </div>

    <div class="text-end mt-3">
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
  </form>


@endsection
