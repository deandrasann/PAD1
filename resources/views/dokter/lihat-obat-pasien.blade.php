@extends('footerheader.navbar-pmo')
@section('content')
<div class="container mt-5">
    <div>
        <h5>OBAT NON - RACIKAN</h5>
        <div class="border p-3 mb-3">
            <div class="row mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Obat" value="Amlodipine" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <span>Jumlah : </span>
                    <input type="number" class="form-control" placeholder="Jumlah" value="5" disabled>
                </div>
                <div class="col md-2">
                    <span> Bentuk sediaan : </span>
                    <select class="form-select" placeholder="Pilih Sediaan" disabled>
                        <option selected>Tablet </option>
                        <option>Kapsul</option>
                        <option>Puyer </option>
                        <option>Sirup</option>
                        <option>Suspensi</option>
                        <option>Eliksir</option>
                        <option>Tetes</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <span class="">Harga Satuan: <br><strong>Rp 650</strong> </span>
                </div>

                <div class="col-md-2">
                    <span class="">Harga Total: <br><strong>Rp 3.250</strong> </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col mb-2">
                    <p><strong>Signatura (Keterangan)</strong></p>
                    <input type="text" class="form-control" value="3 dd 1 tab pc" disabled mt-1>
                </div>
                <div class="col mb-2">
                    <p><strong>Signatura Label</strong></p>
                    <input type="text" class="form-control" value="Minum 1 tablet 3 kali sehari setelah makan" disabled mt-1>
                </div>
            </div>
            <hr>
            <div class="row mt-4 mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Obat" value="Amlodipine" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <span>Jumlah : </span>
                    <input type="number" class="form-control" placeholder="Jumlah" value="5" disabled>
                </div>
                <div class="col md-2">
                    <span> Bentuk sediaan : </span>
                    <select class="form-select" placeholder="Pilih Sediaan" disabled>
                        <option selected>Tablet </option>
                        <option>Kapsul</option>
                        <option>Puyer </option>
                        <option>Sirup</option>
                        <option>Suspensi</option>
                        <option>Eliksir</option>
                        <option>Tetes</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <span class="">Harga Satuan: <br><strong>Rp 650</strong> </span>
                </div>

                <div class="col-md-2">
                    <span class="">Harga Total: <br><strong>Rp 3.250</strong> </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col mb-2">
                    <p><strong>Signatura (Keterangan)</strong></p>
                    <input type="text" class="form-control" value="3 dd 1 tab pc" disabled mt-1>
                </div>
                <div class="col mb-2">
                    <p><strong>Signatura Label</strong></p>
                    <input type="text" class="form-control" value="Minum 1 tablet 3 kali sehari setelah makan" disabled mt-1>
                </div>
            </div>
        </div>

    </div>


    <h5 class="mt-4">OBAT RACIKAN</h5>
    <div class="border p-3 mb-4">

        <div class="row ">
            {{-- <p class="mt-4"> <strong>Buat Obat Racik</strong>  </p> --}}
            <div class="row  align-items-end">
                <div class="col-md-4 mb-2">
                    <span>Nama Racikan : </span>
                    <div class="input-group">
                        <input type="text" class="form-control" value="Puyer Demam" disabled>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <span>Dosis</span>
                    <div class="d-flex align-items-center gap-2">
                        <input type="number" class="form-control" value="3" disabled>
                        <span>X</span>
                        <input type="number" class="form-control" value="1" disabled>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <span> Bentuk sediaan : </span>
                    <select class="form-select" placeholder="Pilih Sediaan" disabled>
                        <option>Tablet </option>
                        <option>Kapsul</option>
                        <option selected>Puyer </option>
                        <option>Sirup</option>
                        <option>Suspensi</option>
                        <option>Eliksir</option>
                        <option>Tetes</option>
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col mb-2">
                    <p><strong>Instruksi Pemakaian</strong></p>
                    <input type="text" class="form-control" value="Sesudah Makan" disabled mt-1>
                </div>
                <div class="col mb-2">
                    <p><strong>Instruksi Racikan</strong></p>
                    <input type="text" class="form-control" value="dibuat puyes sebanyak 10 pcs" disabled mt-1>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="merokokTidak" disabled checked>
                    <label class="form-check-label" for="merokokTidak"><strong> Buat Kemasan Baru</strong> </label>
                </div>
            </div>

        </div>
        <div class="row my-2">
            <div class="col-auto">
                <label class="form-label">Jumlah:</label>
                <input type="number" class="form-control form-control-sm" placeholder="Jumlah" value="5" disabled style="width: 120px;">
            </div>
            <div class="col-auto">
                <label class="form-label">Kemasan:</label>
                <select class="form-select form-select-sm" disabled style="width: 120px;">
                    <option selected>Kertas Puyer</option>
                    <option>Kapsul</option>
                    <option>Botol</option>
                    <option>Tube</option>
                </select>
            </div>
        </div>
        <div class="row mb-2 align-items-end">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Nama Obat" value="Amlodipine" disabled>
                </div>
            </div>
            <div class="col-md-2">
                <span>Jumlah : </span>
                <input type="number" class="form-control" placeholder="Jumlah" value="5" disabled>
            </div>
            <div class="col md-2">
                <span> Bentuk sediaan : </span>
                <select class="form-select" placeholder="Pilih Sediaan" disabled>
                    <option selected>Tablet </option>
                    <option>Kapsul</option>
                    <option>Puyer </option>
                    <option>Sirup</option>
                    <option>Suspensi</option>
                    <option>Eliksir</option>
                    <option>Tetes</option>
                </select>
            </div>
            <div class="col-md-2">
                <span class="">Harga Satuan: <br><strong>Rp 650</strong> </span>
            </div>

            <div class="col-md-2">
                <span class="">Harga Total: <br><strong>Rp 3.250</strong> </span>
            </div>
        </div>
        <div class="row mb-2 align-items-end my-4">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Nama Obat" value="Amlodipine" disabled>
                </div>
            </div>
            <div class="col-md-2">
                <span>Jumlah : </span>
                <input type="number" class="form-control" placeholder="Jumlah" value="5" disabled>
            </div>
            <div class="col md-2">
                <span> Bentuk sediaan : </span>
                <select class="form-select" placeholder="Pilih Sediaan" disabled>
                    <option selected>Tablet </option>
                    <option>Kapsul</option>
                    <option>Puyer </option>
                    <option>Sirup</option>
                    <option>Suspensi</option>
                    <option>Eliksir</option>
                    <option>Tetes</option>
                </select>
            </div>
            <div class="col-md-2">
                <span class="">Harga Satuan: <br><strong>Rp 650</strong> </span>
            </div>

            <div class="col-md-2">
                <span class="">Harga Total: <br><strong>Rp 3.250</strong> </span>
            </div>
        </div>


        </div>

    </div>
</div>
@endsection
