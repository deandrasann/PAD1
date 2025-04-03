@extends('footerheader.navbar-pmo')
@section('content')
<div class="container mt-5">
    <h2>Buat Resep</h2>

    <div class="border p-3 mb-4">
        <h5>OBAT NON - RACIKAN</h5>
        <div class="border p-3 mb-3">
            <div class="row mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Obat">
                        <span class="input-group-text">
                            <i class="fas fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <span>Jumlah : </span>
                    <input type="number" class="form-control" placeholder="Jumlah">
                </div>
                <div class="col md-2">
                    <span> Bentuk sediaan : </span>
                    <select class="form-select" placeholder="Pilih Sediaan">
                        <option>Tablet </option>
                        <option>Kapsul</option>
                        <option>Puyer </option>
                        <option>Sirup</option>
                        <option>Suspensi</option>
                        <option>Eliksir</option>
                        <option>Tetes</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <span>Sisa: 250</span>
                </div>
                <div class="col-md-2">
                    <span class="">Harga Total: <br><strong>Rp 3.250</strong> </span>
                </div>
                <div class="col-md-1 p-2">
                    <button class="delete-icon" style=" "><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col mb-2">
                    <p><strong>Signatura (Keterangan)</strong></p>
                    <input type="text" class="form-control" placeholder="3 dd 1 tab pc" mt-1>
                </div>
                <div class="col mb-2">
                    <p><strong>Signatura Label</strong></p>
                    <input type="text" class="form-control" placeholder="Minum 1 tablet 3 kali sehari setelah makan" mt-1>
                </div>
            </div>

        </div>
        <button style="color: #2DA3F9; background:none; border:none">+ Tambah Obat</button>
    </div>

    <div class="border p-3 mb-4">
        <h5>OBAT RACIKAN</h5>
        <div class="row ">
            <div class="col-md-6 mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Nama Racikan">
                    <span class="input-group-text">
                        <i class="fas fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <button class="btn btn-resep">+ Tambah Racikan</button>
            </div>
            {{-- Konten ini harusnya hidden kalau data masih kosong, apabila ada data tombol "+Tambah Racikan yang di hidden" --}}
            <p class="mt-4"> <strong>Buat Obat Racik</strong>  </p>
            <div class="row  align-items-end">
                <div class="col-md-4 mb-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Obat">
                        <span class="input-group-text">
                            <i class="fas fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <span>Dosis</span>
                    <div class="d-flex align-items-center gap-2">
                        <input type="number" class="form-control" placeholder="Jumlah">
                        <span>X</span>
                        <input type="number" class="form-control" placeholder="Jumlah">
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <span> Bentuk sediaan : </span>
                    <select class="form-select" placeholder="Pilih Sediaan">
                        <option>Tablet </option>
                        <option>Kapsul</option>
                        <option>Puyer </option>
                        <option>Sirup</option>
                        <option>Suspensi</option>
                        <option>Eliksir</option>
                        <option>Tetes</option>
                    </select>
                </div>
                <div class="col-md-1 p-2">
                    <button class="delete-icon" style=" "><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
        <button style="color: #2DA3F9; background:none; border:none" class="mt-4">+ Tambah Obat</button>

    </div>

    <div class="text-end">
        <button class="btn btn-secondary">Batal</button>
        <button class="btn btn-resep">Simpan</button>
    </div>
</div>
@endsection
