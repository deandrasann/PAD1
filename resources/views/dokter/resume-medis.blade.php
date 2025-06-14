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

        /* Warna dan padding untuk stepwizard */
        .stepwizard-step p {
            margin-top: 10px;
        }

        .btn-resep {
            background-color: #20587a;
            color: white;
            width: 40px;
            height: 40px;
            padding: 0;
        }

        .btn-resep:hover {
            background-color: #1c4d6d;
            color: white;
        }

        .setup-panel .stepwizard-step {
            display: inline-block;
            margin-top: 40px;
            margin-right: 70px;
        }

        .table-borderless th,
        .table-borderless td {
            border: none !important;
        }

        .form-control,
        .input-group-text {
            border-radius: 8px !important;
        }

        .table {
            margin-bottom: 0;
        }

        hr {
            border-top: 2px solid #ccc;
        }
    </style>

    <nav class="nav">
        <a class="nav-link {{ request()->routeIs('resume-medis') ? 'active' : '' }}"
            href="{{ route('resume-medis', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}">
            Isi Resume Medis
        </a>

        <a class="nav-link {{ request()->routeIs('riwayat-konsultasi-pasien') ? 'active' : '' }}"
            href="{{ route('riwayat-konsultasi-pasien', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}">
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

        <div class="stepwizard col-md-offset-3">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-resep">1</a>
                    <p>Pemeriksaan</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-light" disabled="disabled">2</a>
                    <p>Assesment</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-light" disabled="disabled">3</a>
                    <p class="px-4">Resep</p>
                </div>
            </div>
        </div>

        <form role="form"
            action="{{ route('simpan-pemeriksaan', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}"
            method="POST">
            @csrf
            <div class="row setup-content" id="step-1">
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
                                                <input type="hidden" name="id_pemeriksaan_awal"
                                                    value="{{ $kunjungan->id_pemeriksaan_awal }}">
                                                <div class="col-md-6">
                                                    <label class="my-2">Merokok?</label><br>
                                                    @php
                                                        $merokok = $kunjungan->merokok ?? null;
                                                    @endphp
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="merokok"
                                                            id="merokokYa" value="Ya"
                                                            {{ $merokok == 'Ya' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="merokokYa">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="merokok"
                                                            id="merokokTidak" value="Tidak"
                                                            {{ $merokok == 'Tidak' ? 'checked' : '' }}>
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
                                                            {{ $hamilMenyusuiValue == 'Hamil' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="hamil">Hamil</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="hamil_menyusui"
                                                            id="menyusui" value="Menyusui"
                                                            {{ $hamilMenyusuiValue == 'Menyusui' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="menyusui">Menyusui</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="hamil_menyusui"
                                                            id="tidak_keduanya" value="Tidak Keduanya"
                                                            {{ $hamilMenyusuiValue == 'Tidak Keduanya' ? 'checked' : '' }}>
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
                        <button class="btn btn-submit nextBtn btn-lg pull-right btn-success" type="button">Next
                            ></button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
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
                                <td colspan="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="my-2">Anamnesa</label>
                                            <div class="input-group w-100 mb-4">
                                                <textarea type="text" name="anamnesa" class="form-control"></textarea>
                                            </div>
                                            <div class="mb-4 mt-4">
                                                <label class="mb-2">Diagnosis</label><br>
                                                <input type="text" name="diagnosis" class="form-control"></input>
                                            </div>
                                            <div id="icd-wrapper">
                                                <div class="icd-group mb-3">
                                                    <label class="mb-2">ICD 11 (2019)</label>
                                                    <div class="d-flex">
                                                        <select name="icd_codes[]" class="form-control icd-select"
                                                            id="kodeicd" style="width: 100%;">
                                                            <option></option>
                                                            @foreach ($data_icd as $item)
                                                                <option value="{{ $item->kode_icd }}">
                                                                    {{ $item->kode_icd }} - {{ $item->deskripsi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button"
                                                            class="btn btn-danger ms-2 btn-remove-icd">x</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" id="btn-add-icd"
                                                class="btn btn-primary m-2">Tambah</button>


                                        </div>
                                    </div>
                                </td>
                                </tr>

                            </tbody>

                        </table>
                        <button class="btn btn-submit nextBtn btn-lg pull-right btn-success mt-3"
                            type="button">Next></button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <table class="table table-borderless border">

                            <tbody>
                                <td colspan="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="my-2">Resep</label>

                                            <hr>
                                            {{-- <button type="button" class="btn btn-tambah ms-3 mb-2 btn-primary rounded-3"
                                                data-bs-toggle="modal" data-bs-target="#tambahObatModal">
                                                <strong><a href="{{ route('tambah-obat-dokter') }}"
                                                        style="color: white; text-decoration:none">+ Tambah Obat </a>
                                                </strong>
                                            </button> --}}
                                            <div class="mb-4 mt-4">
                                                <label class="mb-2">Pilih Obat</label><br>
                                                <select class="form-control" id="namaObat" name="kode_obat"
                                                    style="width: 100%;">
                                                    <option value="" disabled selected>-- Pilih Nama Obat --</option>
                                                    @foreach ($data_obat as $item)
                                                        <option value="{{ $item->kode_obat }}">
                                                            {{ $item->nama_obat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-4 mt-4">
                                                <label class="mb-2">Medikamentosa</label><br>
                                                <input type="text" name="medikamentosa" class="form-control"></input>
                                            </div>
                                            <div class="mb-4 mt-4">
                                                <label class="mb-2">Non-Medikamentosa</label><br>
                                                <input type="text" name="non_medikamentosa"
                                                    class="form-control"></input>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>

                            </tbody>

                        </table>
                        <button class="btn btn-success btn-lg pull-right btn-submit" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            // Inisialisasi awal
            $('.icd-select').select2({
                placeholder: '-- Pilih ICD 11 (2019) --',
                allowClear: true,
                width: '100%'
            });

            // Tambah field ICD
            $('#btn-add-icd').on('click', function() {
                // Ambil elemen pertama dan hapus select2-nya
                const original = $('.icd-group').first();

                // Hapus Select2 instance sebelum cloning
                const originalSelect = original.find('select');
                originalSelect.select2('destroy');

                // Clone elemen
                const newICD = original.clone();

                // Re-inisialisasi select2 di elemen awal
                originalSelect.select2({
                    placeholder: '-- Pilih ICD 11 (2019) --',
                    allowClear: true,
                    width: '100%'
                });

                // Reset value select dan append
                newICD.find('select').val('');
                $('#icd-wrapper').append(newICD);

                // Inisialisasi select2 untuk select baru
                newICD.find('select').select2({
                    placeholder: '-- Pilih ICD 11 (2019) --',
                    allowClear: true,
                    width: '100%'
                });
            });

            // Hapus field ICD
            $('#icd-wrapper').on('click', '.btn-remove-icd', function() {
                if ($('.icd-group').length > 1) {
                    $(this).closest('.icd-group').remove();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#namaObat").select2({
                placeholder: '-- Pilih Nama Obat --', // Samain placeholder
                allowClear: true, // (Optional) Biar bisa hapus pilihan
            });
        });
    </script>


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

    <script>
        $(document).ready(function() {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function(e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-resep').addClass('btn-light');
                    $item.addClass('btn-resep');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function() {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
                    .children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-resep').trigger('click');
        });
    </script>
@endsection
