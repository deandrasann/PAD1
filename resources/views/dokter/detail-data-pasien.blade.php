@extends('footerheader.navbar-pmo')
@section('content')
<nav class="nav">
    <a class="nav-link" href="{{ route('detail-data-pasien') }}">Resume Medis</a>
    <a class="nav-link" href="{{ route('riwayat-konsultasi-pasien') }}">Riwayat Konsultasi</a>
</nav>

<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-borderless border">
            <thead>
                <tr>
                    <th class="bg-light" colspan="2">DATA KUNJUNGAN</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><strong>Jadwal</strong></td></tr>
                <tr><td>dr. Andi Junaidi</td></tr>
                <tr><td>Poli Umum</td></tr>
                <tr><td>Kunjungan sakit</td></tr>
                <tr><td>24/10/2024</td></tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <form role="form" action="" method="post">
        <div class="row">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col md-12">
                    <div class="table-responsive">
                        <table class="table table-borderless border">
                            <thead>
                                <tr>
                                    <th class="" colspan="2"><h4>DATA KESEHATAN</h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="my-2">Golongan Darah</label>
                                                <input type="text" class="form-control w-50" disabled value="B">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="my-2">Merokok?</label><br>
                                                <div class="form-check form-check-inline ms-2">
                                                    <input class="form-check-input" type="checkbox" id="merokokYa" disabled>
                                                    <label class="form-check-label" for="merokokYa">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="merokokTidak" disabled checked>
                                                    <label class="form-check-label" for="merokokTidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="my-2">Berat Badan</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value=60 disabled>
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-4 mb-2">Hamil / Menyusui</label><br>
                                                <div class="form-check form-check-inline ms-2">
                                                    <input class="form-check-input" type="checkbox" id="hamil" disabled>
                                                    <label class="form-check-label" for="hamil">Hamil</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="menyusui" disabled>
                                                    <label class="form-check-label" for="menyusui">Menyusui</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="my-2">Tinggi Badan</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value="158" disabled>
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <hr>
                                <tr>
                                    <td colspan="1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <h5>Keluhan</h5>
                                                <label class="my-2">Anamnesa</label>
                                                <div class="input-group w-100">
                                                    <input type="text" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <hr>
                                        <h5 class="my-4">TANDA-TANDA VITAL</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="my-2">Suhu tubuh</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value="36" disabled>
                                                    <span class="input-group-text">°C</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="my-2">Nadi</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value="70" disabled>
                                                    <span class="input-group-text">bpm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="my-2">Sistole</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value="100" disabled>
                                                    <span class="input-group-text">mmhg</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="my-2">Preferensi pernafasan</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value="24" disabled>
                                                    <span class="input-group-text">rpm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="my-2">Diastole</label>
                                                <div class="input-group w-50">
                                                    <input type="number" class="form-control" value="70" disabled>
                                                    <span class="input-group-text">mmhg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <table class="table table-borderless border">
                        <thead>
                            <tr>
                                <th class="mt-2" colspan="2"><h4>ASSESMENT</h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="my-2">Diagnosa</label>
                                            <div class="input-group w-100 mb-4">
                                                <textarea type="text" class="form-control" disabled>Demam Ringan</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <table class="table table-borderless border">
                        <tbody>
                            <tr>
                                <td colspan="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="mt-2"><h4>Resep</h4></label>
                                            <hr>
                                            <button type="button" class="btn btn-resep px-2 py-2 mb-2 mt-4">
                                                <strong><a href="{{ route('lihat-obat-pasien') }}" style="color: white; text-decoration:none">Lihat Detail</a> </strong>
                                            </button>

                                            <div class="mb-4 mt-4">
                                                <label class="mb-2">Medikamentosa</label><br>
                                                <input type="text" class="form-control" placeholder="Paracetamol" value="Medikamentosa" disabled></input>
                                            </div>
                                            <div class="mb-4 mt-4">
                                                <label class="mb-2">Non-Medikamentosa</label><br>
                                                <input type="text" class="form-control" placeholder="Anjuran untuk pasien" value="Non-Medikamentosa" disabled></input>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
