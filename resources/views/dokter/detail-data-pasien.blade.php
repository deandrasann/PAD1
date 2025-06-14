@extends('footerheader.navbar-pmo')
@section('content')

    <style>
        .nav-link {
            color: #6c757d;
            /* abu-abu default */
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .nav-link.active {
            color: #20587a;
            /* biru */
            font-weight: bold;
            border-bottom: 3px solid #20587a;
        }
    </style>

    <nav class="nav">
        <a class="nav-link {{ request()->routeIs('detail-data-pasien') ? 'active' : '' }}"
            href="{{ route('detail-data-pasien', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}">
            Isi Resume Medis
        </a>

        <a class="nav-link {{ request()->routeIs('riwayat-konsul-done') ? 'active' : '' }}"
            href="{{ route('riwayat-konsul-done', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}">
            Riwayat Konsultasi
        </a>
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
                    <tr>
                        <td><strong>Jadwal</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $kunjungan->nama_dokter ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $kunjungan->spesialis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kunjungan sakit</td>
                    </tr>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
                    </tr>
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
                                        <th class="" colspan="2">
                                            <h4>DATA KESEHATAN</h4>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="my-2">Golongan Darah</label>
                                                    <input type="text" name="golongan_darah" class="form-control w-50"
                                                        @if (!empty($kunjungan->golongan_darah)) value="{{ $kunjungan->golongan_darah }}" data-from-db="true" @endif>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="my-2">Merokok?</label><br>
                                                    @php
                                                        $merokok = $kunjungan->merokok ?? null;
                                                    @endphp
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="merokok"
                                                            id="merokokYa" value="Ya"
                                                            {{ $merokok == 'Ya' ? 'checked' : '' }} disabled>
                                                        <label class="form-check-label" for="merokokYa">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="merokok"
                                                            id="merokokTidak" value="Tidak"
                                                            {{ $merokok == 'Tidak' ? 'checked' : '' }} disabled>
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
                                                        <input type="number" name="berat_badan" class="form-control"
                                                            @if (!empty($kunjungan->berat_badan)) value="{{ $kunjungan->berat_badan }}" data-from-db="true" @endif>
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mt-4 mb-2">Hamil / Menyusui</label><br>
                                                    @php
                                                        $hamilMenyusuiValue = $kunjungan->hamil_menyusui ?? null;
                                                    @endphp
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="hamil_menyusui"
                                                            id="hamil" value="Hamil"
                                                            {{ $hamilMenyusuiValue == 'Hamil' ? 'checked' : '' }} disabled>
                                                        <label class="form-check-label" for="hamil">Hamil</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="hamil_menyusui"
                                                            id="menyusui" value="Menyusui"
                                                            {{ $hamilMenyusuiValue == 'Menyusui' ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="form-check-label" for="menyusui">Menyusui</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="hamil_menyusui"
                                                            id="tidak_keduanya" value="Tidak Keduanya"
                                                            {{ $hamilMenyusuiValue == 'Tidak Keduanya' ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="form-check-label" for="tidak_keduanya">Tidak
                                                            Keduanya</label>
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
                                                        <input type="number" name="tinggi_badan" class="form-control"
                                                            @if (!empty($kunjungan->tinggi_badan)) value="{{ $kunjungan->tinggi_badan }}" data-from-db="true" @endif>
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
                                                    <label class="my-2">Keluhan Awal</label>
                                                    <div class="input-group w-100">
                                                        <input type="text" name="keluhan_awal" class="form-control"
                                                            @if (!empty($kunjungan->keluhan_awal)) value="{{ $kunjungan->keluhan_awal }}" data-from-db="true" @endif>
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
                                                        <input type="number" name="suhu_tubuh" class="form-control"
                                                            @if (!empty($kunjungan->suhu_tubuh)) value="{{ $kunjungan->suhu_tubuh }}" data-from-db="true" @endif>
                                                        <span class="input-group-text">C</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="my-2">Nadi</label>
                                                    <div class="input-group w-50">
                                                        <input type="number" name="nadi" class="form-control"
                                                            @if (!empty($kunjungan->nadi)) value="{{ $kunjungan->nadi }}" data-from-db="true" @endif>
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
                                                        <input type="number" name="sistole" class="form-control"
                                                            @if (!empty($kunjungan->sistole)) value="{{ $kunjungan->sistole }}" data-from-db="true" @endif>
                                                        <span class="input-group-text">mmhg</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="my-2">Preferensi pernafasan</label>
                                                    <div class="input-group w-50">
                                                        <input type="number" name="pernapasan" class="form-control"
                                                            @if (!empty($kunjungan->pernapasan)) value="{{ $kunjungan->pernapasan }}" data-from-db="true" @endif>
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
                                                        <input type="number" name="diastole" class="form-control"
                                                            @if (!empty($kunjungan->diastole)) value="{{ $kunjungan->diastole }}" data-from-db="true" @endif>
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
                                    <th class="mt-2" colspan="2">
                                        <h4>ASSESMENT</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="my-2">Diagnosa</label>
                                                <div class="input-group w-100 mb-4">
                                                    <input type="text" class="form-control" placeholder="Paracetamol"
                                                        @if (!empty($kunjungan->diagnosis)) value="{{ $kunjungan->diagnosis }}" data-from-db="true" @endif></input>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="my-2">ICD 11 (2019)</label>
                                                @if (!empty($data_icd) && $data_icd->count())
                                                    @foreach ($data_icd as $icd)
                                                        <div class="input-group w-100 mb-3">
                                                            <textarea class="form-control" disabled>{{ $icd->kode_icd }} - {{ $icd->deskripsi }}</textarea>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted">Tidak ada data ICD.</p>
                                                @endif
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
                                                <label class="mt-2">
                                                    <h4>Resep</h4>
                                                </label>
                                                <hr>
                                                <button type="button" class="btn btn-resep px-2 py-2 mb-2 mt-4">
                                                    <strong><a href="{{ route('lihat-obat-pasien') }}"
                                                            style="color: white; text-decoration:none">Lihat Detail</a>
                                                    </strong>
                                                </button>

                                                <div class="mb-4 mt-4">
                                                    <label class="mb-2">Medikamentosa</label><br>
                                                    <input type="text" class="form-control" placeholder="Paracetamol"
                                                        @if (!empty($kunjungan->medikamentosa)) value="{{ $kunjungan->medikamentosa }}" data-from-db="true" @endif></input>
                                                </div>
                                                <div class="mb-4 mt-4">
                                                    <label class="mb-2">Non-Medikamentosa</label><br>
                                                    <input type="text" class="form-control"
                                                        placeholder="Anjuran untuk pasien"
                                                        @if (!empty($kunjungan->non_medikamentosa)) value="{{ $kunjungan->non_medikamentosa }}" data-from-db="true" @endif
                                                        disabled></input>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pilih hanya input yang berasal dari database
            const inputsFromDb = document.querySelectorAll('input.form-control[data-from-db="true"]');

            inputsFromDb.forEach(input => {
                // Jika memiliki nilai dari database, disable
                if (input.value.trim() !== '') {
                    input.readOnly = true;
                    input.style.backgroundColor = '#e9ecef';
                }
            });
        });
    </script>

@endsection
