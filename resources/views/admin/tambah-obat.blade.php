@extends('footerheader.navbar')

@section('content')
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-4">TAMBAH OBAT</h3>
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namaObat" class="form-label">Nama Obat</label>
                        <input type="text" class="form-control" id="namaObat" placeholder="Nama Obat">
                    </div>
                    <div class="col-md-6">
                        <label for="waktuMinum" class="form-label">Waktu Minum</label>
                        <select class="form-select" id="waktuMinum">
                            <option selected>Setelah Makan</option>
                            <option>Sebelum Makan</option>
                            <option>Ketika Sakit</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dosis" class="form-label">Dosis</label>
                        <input type="text" class="form-control" id="dosis" placeholder="Dosis">
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" placeholder="--Pilih Keterangan--">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="aturanPakai" class="form-label">Aturan Pakai</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="aturanPakai" placeholder="Jumlah">
                            <span class="input-group-text">Kali Sehari</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="jumlahObat" class="form-label">Jumlah Obat</label>
                        <input type="text" class="form-control" id="jumlahObat" placeholder="Jumlah Obat">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="takaranMinum" class="form-label">Takaran Minum</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="takaranMinum" placeholder="Takaran">
                            <select class="form-select">
                                <option selected>tablet</option>
                                <option>kapsul</option>
                                <option>sendok</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="jumlahKaliMinum" class="form-label">Jumlah Kali Minum</label>
                        <input type="text" class="form-control" id="jumlahKaliMinum" placeholder="Jumlah Kali Minum">
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
