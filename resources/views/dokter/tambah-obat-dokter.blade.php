@extends('footerheader.navbar-pmo')
@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px;
            /* Sesuaikan dengan input form yang lain */
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Hilangkan garis bawah tambahan dari Select2 */
        .select2-selection__rendered {
            line-height: 24px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            /* Agar sejajar panah dropdown-nya */
            top: 1px;
        }

        .jumlah-obat-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .jumlah-obat-wrapper .form-text {
            margin-top: 4px;
            font-size: 0.875em;
        }
    </style>
    <div class="container mt-5">
        <h2>Buat Resep</h2>

        <div class="border p-3 mb-4">
            <h5>OBAT NON - RACIKAN</h5>
            <!-- WRAPPER OBAT -->
            <div id="wrapper-obat">
                <div class="item-obat border p-3 mb-3">
                    <!-- Form Obat pertama, copy dari template tapi tanpa id, pakai class -->
                    <form id="form-resep">
                        <input type="hidden" id="id_pemeriksaan_akhir" value="{{ $kunjungan->id_pemeriksaan_akhir }}">
                        <input type="hidden" id="id_dokter" value="{{ $kunjungan->id_dokter }}">
                        <input type="hidden" id="id_pasien" value="{{ $kunjungan->id_pasien }}">
                        <template id="template-obat">
                            <div class="item-obat border p-3 mb-3">
                                <div class="row align-items-end g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Cari Nama Obat</label>
                                        <select class="form-control select-obat" style="width: 100%;">
                                            <option></option>
                                            @foreach ($data_obat as $item)
                                                <option value="{{ $item->kode_obat }}">{{ $item->nama_obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex flex-column justify-content-end">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" class="form-control jumlah-obat" placeholder="Jumlah">
                                        <small class="text-muted mt-1 kekuatan-sediaan"></small>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Bentuk Sediaan</label>
                                        <select name="bentuk_obat" class="form-select bentuk-obat">
                                            <option value="tablet">Tablet</option>
                                            <option value="kapsul">Kapsul</option>
                                            <option value="puyer">Puyer</option>
                                            <option value="sirup">Sirup</option>
                                            <option value="suspensi">Suspensi</option>
                                            <option value="eliksir">Eliksir</option>
                                            <option value="tetes">Tetes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Harga Satuan:</label>
                                        <p class="mb-0 fw-bold text-primary harga-satuan">Rp -</p>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Harga Total:</label>
                                        <p class="mb-0 fw-bold text-primary harga-total">Rp -</p>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-link text-danger btn-hapus-obat"
                                            title="Hapus">
                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col mb-2">
                                        <p><strong>Signatura (Keterangan)</strong></p>
                                        <input type="text" class="form-control signa"
                                            placeholder="example: 3 dd 1 tab pc">
                                    </div>
                                    <div class="col mb-2">
                                        <p><strong>Signatura Label</strong></p>
                                        <input type="text" class="form-control signa-label"
                                            placeholder="example: Minum 1 tablet 3 kali sehari setelah makan">
                                    </div>
                                </div>
                            </div>
                        </template>
                        <button type="button" id="btn-tambah-obat"
                            style="color: #2DA3F9; background:none; border:none">+Tambah Obat</button>
                </div>
            </div>
        </div>

        {{-- <h5>OBAT RACIKAN</h5>
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
                </div> --}}

        {{-- Konten ini harusnya hidden kalau data masih kosong, apabila ada data tombol "+Tambah Racikan yang di hidden" --}}
        {{-- <p class="mt-4"> <strong>Buat Obat Racik</strong> </p>
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
        </div> --}}

        <div class="border p-4 rounded mb-4">
            <h5 class="mb-4">OBAT RACIKAN</h5>
            <form id="form-obat-racikan">
                <!-- Pencarian Nama Racikan dan Tombol Tambah -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="searchracikan" class="form-control" placeholder="Cari Nama Racikan">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" id="btnBuatRacikan" class="btn btn-primary">Buat Obat Racik</button>
                    </div>
                </div>

                <!-- Wadah untuk banyak form racikan -->
                <div id="formRacikanContainer"></div>
                <!-- Form Racikan -->
                {{-- <div class="p-3 ">
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Nama racikan :</label>
                <input type="text" class="form-control" placeholder="Contoh: Puyer Demam">
            </div>
            <div class="col-md-3">
                <label>Dosis :</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="number" class="form-control" placeholder="3">
                    <span>X</span>
                    <input type="number" class="form-control" placeholder="1">
                </div>
            </div>
            <div class="col-md-3">
                <label>Bentuk Sediaan :</label>
                <select class="form-select">
                    <option>Puyer</option>
                    <option>Tablet</option>
                    <option>Kapsul</option>
                    <option>Sirup</option>
                    <option>Suspensi</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Instruksi Pemakaian</label>
                <input type="text" class="form-control" placeholder="mis. sesudah makan">
            </div>
            <div class="col-md-6">
                <label>Instruksi Racikan</label>
                <input type="text" class="form-control" placeholder="mis. dibuat puyer sebanyak 10 pcs">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-2">
                <label>Jumlah</label>
                <input type="number" class="form-control" placeholder="10">
            </div>
            <div class="col-md-4">
                <label>Kemasan</label>
                <select class="form-select">
                    <option>Kertas puyer</option>
                    <option>Kapsul</option>
                    <option>Botol</option>
                </select>
            </div>
        </div>

        <!-- Daftar Obat dalam Racikan -->
        <div class=" p-3  mb-3 ">
            <div class="row align-items-center mb-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" value="Paracetamol">
                </div>
                <div class="col-md-2">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" value="250">
                </div>
                <div class="col-md-2">
                    <label>Kekuatan Sediaan</label>
                    <select class="form-select">
                        <option>mg</option>
                        <option>ml</option>
                    </select>
                </div>
                <div class="col-md-2 text-end">
                    <p class="mb-0">Harga Satuan<br><strong>Rp 50</strong></p>
                </div>
                <div class="col-md-1 text-end">
                    <p class="mb-0">Harga Total<br><strong>Rp 12.500</strong></p>
                </div>
                <div class="col-md-1 text-end">
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-4">
                    <input type="text" class="form-control" value="CTM (Chlorpheniramine Maleate)">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" value="2">
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option>mg</option>
                        <option>ml</option>
                    </select>
                </div>
                <div class="col-md-2 text-end">
                    <p class="mb-0">Rp 200</p>
                </div>
                <div class="col-md-1 text-end">
                    <p class="mb-0">Rp 400</p>
                </div>
                <div class="col-md-1 text-end">
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah Obat -->
        <button class="btn btn-link text-primary">+ Tambah Obat</button> --}}

                {{-- TEMPLATE --}}
                <template>
                    <div class=" p-3  mb-3 ">
                        <div class="row align-items-center mb-2 obat-row">
                            <div class="col-md-4">
                                <select class="form-select nama-obat-select" style="width: 100%;"></select>
                            </div>
                            <div class="col-md-2">
                                <label>Jumlah</label>
                                <input type="number" class="form-control jumlah-obat" value="1" min="1">
                            </div>
                            <div class="col-md-2">
                                <label>Kekuatan Sediaan</label>
                                <input type="text" class="form-control kekuatan-sediaan" readonly>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="mb-0">Harga Satuan<br><strong class="harga-satuan">Rp 0</strong></p>
                            </div>
                            <div class="col-md-1 text-end">
                                <p class="mb-0">Harga Total<br><strong class="harga-total">Rp 0</strong></p>
                            </div>
                            <div class="col-md-1 text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-obat">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </template>

        </div>
        {{-- kode ini sampai yang bawah jangan diubah --}}
        <div class="text-end">
            <button type="button" class="btn btn-secondary">
                <a href="{{ route('resume-medis', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}"
                    style="color: white; text-decoration:none">Kembali Ke Resume Medis</a>
            </button>
            <button type="submit" class="btn btn-resep" id="btnSimpanRacikan">Simpan</button>
        </div>
        </form>

        {{-- jangan ubah js nya. kalau mau make js mending bikin script baru biar ga tabrakan --}}
        <script>
            $(document).ready(function() {
                $('#select-obat').select2({
                    placeholder: 'Pilih Obat',
                    allowClear: true
                });

                let hargaSatuan = 0;

                $('#select-obat').on('change', function() {
                    var kodeObat = $(this).val();

                    if (kodeObat) {
                        $.ajax({
                            url: '/get-obat/' + kodeObat,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                $('#kekuatan-sediaan').text('Sisa: ' + response.kekuatan_sediaan);
                                hargaSatuan = parseInt(response.harga_satuan);
                                $('#harga-satuan').text('Rp ' + formatRupiah(hargaSatuan));
                                hitungTotal();
                            },
                            error: function() {
                                $('#kekuatan-sediaan').text('Data kekuatan tidak tersedia');
                                $('#harga-satuan').text('Rp -');
                                $('#harga-total').text('Rp -');
                                hargaSatuan = 0;
                            }
                        });
                    } else {
                        $('#kekuatan-sediaan').text('');
                        $('#harga-satuan').text('Rp -');
                        $('#harga-total').text('Rp -');
                        hargaSatuan = 0;
                    }
                });
                $('#jumlah-obat').on('input', function() {
                    hitungTotal();
                });

                function hitungTotal() {
                    let jumlah = parseInt($('#jumlah-obat').val());
                    if (!isNaN(jumlah) && hargaSatuan > 0) {
                        let total = jumlah * hargaSatuan;
                        $('#harga-total').text('Rp ' + formatRupiah(total));
                    } else {
                        $('#harga-total').text('Rp -');
                    }
                }

                function formatRupiah(angka) {
                    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                $('#btn-tambah-obat').on('click', function() {
                    let template = $('#template-obat').html();
                    let newItem = $(template);

                    // Tambahkan ke wrapper
                    $('#wrapper-obat').append(newItem);

                    // Inisialisasi select2 di elemen baru
                    newItem.find('.select-obat').select2({
                        placeholder: 'Pilih Obat',
                        allowClear: true
                    });

                    // Harga satuan lokal
                    let hargaSatuanBaru = 0;

                    // Event ketika select obat berubah
                    newItem.find('.select-obat').on('change', function() {
                        let selectElem = $(this);
                        let parent = selectElem.closest('.item-obat');
                        let kekuatanElem = parent.find('.kekuatan-sediaan');
                        let hargaSatuanElem = parent.find('.harga-satuan');
                        let hargaTotalElem = parent.find('.harga-total');
                        let jumlahInput = parent.find('.jumlah-obat');

                        let kodeObat = selectElem.val();

                        if (kodeObat) {
                            $.ajax({
                                url: '/get-obat/' + kodeObat,
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    kekuatanElem.text('Sisa: ' + response.kekuatan_sediaan);
                                    hargaSatuanBaru = parseInt(response.harga_satuan);
                                    hargaSatuanElem.text('Rp ' + formatRupiah(
                                        hargaSatuanBaru));
                                    hitungTotalItem();
                                },
                                error: function() {
                                    kekuatanElem.text('Data kekuatan tidak tersedia');
                                    hargaSatuanElem.text('Rp -');
                                    hargaTotalElem.text('Rp -');
                                    hargaSatuanBaru = 0;
                                }
                            });
                        } else {
                            kekuatanElem.text('');
                            hargaSatuanElem.text('Rp -');
                            hargaTotalElem.text('Rp -');
                            hargaSatuanBaru = 0;
                        }

                        function hitungTotalItem() {
                            let jumlah = parseInt(jumlahInput.val());
                            if (!isNaN(jumlah) && hargaSatuanBaru > 0) {
                                let total = jumlah * hargaSatuanBaru;
                                hargaTotalElem.text('Rp ' + formatRupiah(total));
                            } else {
                                hargaTotalElem.text('Rp -');
                            }
                        }

                        jumlahInput.off('input').on('input', function() {
                            hitungTotalItem();
                        });
                    });

                    // Event hapus
                    newItem.find('.btn-hapus-obat').on('click', function() {
                        $(this).closest('.item-obat').remove();
                    });
                });
            });
        </script>
        {{-- jangan ubah js nya. kalau mau make js mending bikin script baru biar ga tabrakan --}}
        <script>
            $('#form-resep').on('submit', function(e) {
                e.preventDefault();

                let dataNonRacikan = [];

                $('#wrapper-obat .item-obat').each(function() {
                    let item = $(this);
                    let nama_obat = item.find('.select-obat').val();
                    let jml_obat = parseInt(item.find('.jumlah-obat').val()) || 0;
                    let bentuk_obat = item.find('.bentuk-obat').val();
                    let harga_satuan = parseFloat(item.find('.harga-satuan').text().replace('Rp ', '').replace(
                        /\./g, '').replace(',', '.')) || 0;
                    let harga_total = parseFloat(item.find('.harga-total').text().replace('Rp ', '').replace(
                        /\./g, '').replace(',', '.')) || 0;
                    let signatura = item.find('.signa').val();
                    let signatura_label = item.find('.signa-label').val();

                    if (nama_obat && jml_obat && bentuk_obat) {
                        dataNonRacikan.push({
                            nama_obat,
                            jml_obat,
                            bentuk_obat,
                            harga_satuan,
                            harga_total,
                            signatura,
                            signatura_label
                        });
                    }
                });

                let dataRacikan = [];

                $('#formRacikanContainer > .p-3').each(function() {
                    const $racikan = $(this);
                    const nama = $racikan.find('input[placeholder="Contoh: Puyer Demam"]').val();
                    const dosis1 = $racikan.find('input[placeholder="3"]').val();
                    const dosis2 = $racikan.find('input[placeholder="1"]').val();
                    const bentuk = $racikan.find('select').eq(0).val();
                    const instruksi_pemakaian = $racikan.find('input[placeholder="mis. sesudah makan"]').val();
                    const instruksi_racikan = $racikan.find(
                        'input[placeholder="mis. dibuat puyer sebanyak 10 pcs"]').val();
                    const jumlah_kemasan = $racikan.find('input[placeholder="10"]').val();
                    const kemasan = $racikan.find('select').eq(1).val();

                    const obatList = [];

                    $racikan.find('.obat-row').each(function() {
                        const $row = $(this);
                        const kode_obat = $row.find('.nama-obat-select').val();
                        const jumlah = $row.find('.jumlah-obat').val();
                        const kekuatan = $row.find('.kekuatan-sediaan').val();
                        const hargaSatuan = $row.data('harga-satuan') || 0;

                        if (kode_obat) {
                            obatList.push({
                                kode_obat,
                                jumlah,
                                kekuatan_sediaan: kekuatan,
                                harga_satuan: hargaSatuan
                            });
                        }
                    });

                    dataRacikan.push({
                        nama_racikan: nama,
                        bentuk_obat: bentuk,
                        kemasan_obat: kemasan,
                        instruksi_pemakaian,
                        instruksi_racikan,
                        jumlah_kemasan,
                        takaran_obat: `${dosis1}x${dosis2}`,
                        dosis: `${dosis1}x${dosis2}`,
                        obat: obatList
                    });
                });


                let id_pemeriksaan_akhir = `{{ $kunjungan->id_pemeriksaan_akhir ?? '' }}`;
                let id_dokter = `{{ $kunjungan->id_dokter ?? '' }}`;
                let id_pasien = `{{ $kunjungan->id_pasien ?? '' }}`;

                if (!id_pemeriksaan_akhir || !id_dokter || !id_pasien) {
                    alert('Error: Data kunjungan tidak lengkap. Gagal mengirim resep.');
                    return;
                }

                $.ajax({
                    url: '/simpan-resep',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_pemeriksaan_akhir,
                        id_dokter,
                        id_pasien,
                        non_racikan: dataNonRacikan,
                        racikan: dataRacikan
                    },
                    success: function(response) {
                        alert(response.message || 'Data resep berhasil disimpan!');
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Validasi gagal:\n';
                            for (const key in errors) {
                                errorMessage += `- ${errors[key][0]}\n`;
                            }
                            alert(errorMessage);
                        } else {
                            alert('Terjadi kesalahan. Gagal menyimpan data resep.');
                            console.log(xhr.responseText);
                        }
                    }
                });
            });
        </script>


        <script>
            let racikanCounter = 0;

            // Fungsi: Format angka jadi Rupiah
            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Fungsi: Hitung ulang total harga obat
            function updateHargaTotal($row) {
                const jumlah = parseInt($row.find('.jumlah-obat').val()) || 0;
                const hargaSatuan = parseInt($row.data('harga-satuan')) || 0;
                const total = jumlah * hargaSatuan;
                $row.find('.harga-total').text('Rp ' + formatRupiah(total));
            }

            // Fungsi: Inisialisasi Select2 untuk select obat
            function initSelect2Obat($select) {
                $select.select2({
                    placeholder: 'Pilih Obat',
                    allowClear: true,
                    ajax: {
                        url: '/api/obat-stocked',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: data.map(function(item) {
                                    return {
                                        id: item.kode_obat,
                                        text: item.nama_obat
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            }

            // Tambah racikan baru
            document.getElementById("btnBuatRacikan").addEventListener("click", function() {
                racikanCounter++;
                const container = document.getElementById("formRacikanContainer");

                const racikanHTML = `
        <div class="p-3 border rounded mb-4" id="formRacikan_${racikanCounter}">
            <h5 class="mb-3">Form Racikan #${racikanCounter}</h5>
            <!-- Form racikan detail (input dosis, instruksi, dll) -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Nama racikan :</label>
                    <input type="text" class="form-control" placeholder="Contoh: Puyer Demam">
                </div>
                <div class="col-md-3">
                    <label>Dosis :</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="number" class="form-control" placeholder="3">
                        <span>X</span>
                        <input type="number" class="form-control" placeholder="1">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Bentuk Sediaan :</label>
                    <select class="form-select">
                        <option>Puyer</option>
                        <option>Tablet</option>
                        <option>Kapsul</option>
                        <option>Sirup</option>
                        <option>Suspensi</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Instruksi Pemakaian</label>
                    <input type="text" class="form-control" placeholder="mis. sesudah makan">
                </div>
                <div class="col-md-6">
                    <label>Instruksi Racikan</label>
                    <input type="text" class="form-control" placeholder="mis. dibuat puyer sebanyak 10 pcs">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-2">
                    <label>Jumlah</label>
                    <input type="number" class="form-control jumlah_kemasan" placeholder="10">
                </div>
                <div class="col-md-4">
                    <label>Kemasan</label>
                    <select class="form-select">
                        <option>Kertas puyer</option>
                        <option>Kapsul</option>
                        <option>Botol</option>
                    </select>
                </div>
            </div>

            <!-- Obat-obat racikan -->
            <div class="p-3 mb-3 bg-light daftar-obat-racikan">
                <!-- Baris obat dinamis akan ditambahkan di sini -->
            </div>

            <button type="button" class="btn btn-link text-primary btn-tambah-obat">+ Tambah Obat</button>
        </div>`;

                container.insertAdjacentHTML("beforeend", racikanHTML);
            });

            // Fungsi menambah satu baris obat dalam racikan
            function buatBarisObat() {
                return `
      <div class="row g-2 align-items-center obat-row mb-2">
    <div class="col-md-4">
        <label class="form-label mb-1">Nama Obat</label>
        <select class="form-select nama-obat-select" style="width: 100%;"></select>
    </div>
    <div class="col-md-2">
        <label class="form-label mb-1">Jumlah</label>
        <input type="number" class="form-control jumlah-obat" value="1" min="1">
    </div>
    <div class="col-md-2">
        <label class="form-label mb-1">Kekuatan Sediaan</label>
        <input type="text" class="form-control kekuatan-sediaan" readonly>
    </div>
    <div class="col-md-2">
        <label class="form-label mb-1">Harga Satuan</label>
        <p class="form-control-plaintext mb-0 harga-satuan text-dark fw-semibold">Rp 0</p>
    </div>
    <div class="col-md-1">
        <label class="form-label mb-1">Total</label>
        <p class="form-control-plaintext mb-0 harga-total text-dark fw-semibold">Rp 0</p>
    </div>
    <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-obat">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</div>`;

            }

            // Tambahkan baris obat saat tombol "+ Tambah Obat" ditekan
            $(document).on('click', '.btn-tambah-obat', function() {
                const $racikanForm = $(this).closest('.p-3');
                const $daftarObat = $racikanForm.find('.daftar-obat-racikan');
                const $baris = $(buatBarisObat());
                $daftarObat.append($baris);

                initSelect2Obat($baris.find('.nama-obat-select'));
            });

            // Handle ketika Select2 memilih obat
            $(document).on('select2:select', '.nama-obat-select', function(e) {
                const kodeObat = e.params.data.id;
                const $row = $(this).closest('.obat-row');

                if (kodeObat) {
                    $.ajax({
                        url: `/get-obat-racikan/${kodeObat}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $row.find('.kekuatan-sediaan').val(`Sisa: ${data.kekuatan_sediaan}`);
                            $row.find('.harga-satuan').text(`Rp ${formatRupiah(data.harga_satuan)}`);
                            $row.data('harga-satuan', data.harga_satuan);
                            updateHargaTotal($row);
                        },
                        error: function() {
                            $row.find('.kekuatan-sediaan').val('Data tidak tersedia');
                            $row.find('.harga-satuan').text('Rp -');
                            $row.find('.harga-total').text('Rp -');
                            $row.data('harga-satuan', 0);
                        }
                    });
                }
            });

            // Hapus baris obat
            $(document).on('click', '.btn-hapus-obat', function() {
                $(this).closest('.obat-row').remove();
            });

            // Update harga total saat jumlah obat diubah
            $(document).on('input', '.jumlah-obat', function() {
                const $row = $(this).closest('.obat-row');
                updateHargaTotal($row);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('searchRacikan');
                input.addEventListener('keyup', function() {
                    const query = input.value;

                    fetch(`/cari-racikan?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // bisa diganti dengan tampilkan di UI
                            // tampilkan hasil pencarian di dropdown atau list di bawah input
                            // misalnya render hasilnya di bawah input
                        })
                        .catch(err => console.error(err));
                });
            });
        </script>
    @endsection
