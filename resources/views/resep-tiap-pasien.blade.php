@extends('footerheader.navbar')

@section('content')
    <div class="container mt-4">
        <h2>Data Resep Obat <span id="pasien-nama-resep"></span></h2>

        <div class="d-flex justify-content-between align-items-center">
            <div class="card my-4" style="width: 26rem;">
                <div class="card-body" id="resep-info-card">
                    {{-- Data resep dan pasien akan diisi oleh JavaScript --}}
                    <div class="row" id="status-resep">
                        
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>No Resep</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5" id="resep-no"></div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Tanggal Resep</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5" id="resep-tgl"></div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Nama</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5" id="pasien-nama"></div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Jenis Kelamin</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5" id="pasien-jk"></div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>No Telepon</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5" id="pasien-telp"></div>
                    </div>
                    <div class="row">
                        <div class="col-5"><strong>Alamat</strong></div>
                        <div class="col-1">:</div>
                        <div class="col-5" id="pasien-alamat"></div>
                    </div>
                    <div id="no-resep-alert" class="alert alert-warning d-none" role="alert">
                        Tidak ada data resep yang ditemukan.
                    </div>
                </div>
            </div>

            {{-- Link cetak resep akan diisi oleh JavaScript --}}
            <a href='#' id="print-resep-link" class="container-row-2 p-4 mb-4" target="_blank">
                <img src="{{ asset('images/printer.png') }}">
            </a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form id="search-form" method="GET">
                <div class="search-bar mb-3">
                    <input type="text" class="form-control" placeholder="Cari Obat Dalam Resep" name="search"
                        value="{{ request('search') }}" autocomplete="off" id="search-input">
                    <button class="btn btn-link" type="submit">
                        <img src="{{ asset('images/search icon.png') }}">
                    </button>
                </div>
            </form>

            <button type="button" class="btn btn-resep mb-3 px-4 py-3" data-bs-toggle="modal"
                data-bs-target="#ubahStatusPenyerahanModal">
                <img src="{{ asset('images/edit icon.png') }}" class="me-2">Ubah Status Penyerahan
            </button>
        </div>

        <div class="table-data table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th style="width:400px">Nama Obat/Racikan</th>
                        <th style="width:400px">Tipe Obat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="resep-obat-table-body">
                    {{-- Data resep obat akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div class="paginate d-flex justify-content-center" id="pagination-links">
                {{-- Pagination akan diisi oleh JavaScript --}}
            </div>
            <div id="no-obat-alert" class="alert alert-warning d-none" role="alert">
                Tidak ada data obat dalam resep ini.
            </div>
        </div>

        <div class="modal fade" id="detailObatModal" tabindex="-1" aria-labelledby="detailObatModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailObatModalLabel">Detail Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody id="detail-modal-body">
                                {{-- Konten detail obat akan diisi oleh JavaScript --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-resep" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahStatusPenyerahanModal" tabindex="-1" aria-labelledby="ubahStatusPenyerahanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahStatusPenyerahanModalLabel">Ubah Status Penyerahan Resep</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Status penyerahan resep saat ini: <strong id="current-status-penyerahan"></strong></p>
                <div class="mb-3">
                    <label for="newStatusPenyerahan" class="form-label">Pilih Status Baru:</label>
                    <select class="form-select" id="newStatusPenyerahan">
                        <option value="belum_diserahkan">Belum Diserahkan</option>
                        <option value="diserahkan">Diserahkan</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveStatusPenyerahanBtn">Simpan Perubahan</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const pasienId = {{ request()->route('id') }}; // Mendapatkan ID pasien dari URL
            let currentPage = 1; // Menyimpan halaman saat ini
            let currentSearchTerm = ''; // Menyimpan istilah pencarian saat ini
            let currentResepStatus = ''; // Menyimpan status resep saat ini

            function formatRupiah(angka, prefix) {
                var number_string = angka ? angka.toString().replace(/[^,\d]/g, '') : '0',
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            // Fungsi untuk memuat data dari API
            function loadResepData(pasienId, searchTerm = '', page = 1) {
                const apiUrl = `/api/resep/pasien/${pasienId}?search=${searchTerm}&page=${page}`;

                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            const data = response.data;
                            const dataResep = data.data_resep;
                            const dataObatResep = data.dataObatResep;
                            const dataPasien = data.data_pasien;
                            const paginationLinks = data.links;
                            const paginationMeta = data.meta;

                            // Mengisi data pasien dan resep di card
                            if (dataResep && dataPasien) {
                                $('#pasien-nama-resep').text(dataPasien.nama);
                                $('#resep-no').text(dataResep.no_resep || '-');
                                $('#resep-tgl').text(dataResep.tgl_resep ? new Date(dataResep.tgl_resep).toLocaleDateString('id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                }) : '-');
                                $('#pasien-nama').text(dataPasien.nama || '-');
                                $('#pasien-jk').text(dataPasien.jenis_kelamin || '-');
                                $('#pasien-telp').text(dataPasien.no_telp || '-');
                                $('#pasien-alamat').text(dataPasien.alamat || '-');
                                $('#no-resep-alert').addClass('d-none');
                                $('#print-resep-link').attr('href', `/detail-resep-obat/${pasienId}`);

                                // Perbarui status resep
                                currentResepStatus = dataResep.status_diserahkan; // Simpan status saat ini
                                $('#current-status-penyerahan').text(currentResepStatus === 'diserahkan' ? 'Diserahkan' : 'Belum Diserahkan');
                                $('#newStatusPenyerahan').val(currentResepStatus); // Set nilai default di modal
                                updateStatusDisplay(currentResepStatus); // Perbarui tampilan status

                            } else {
                                $('#resep-info-card').html(
                                    '<div class="alert alert-warning" role="alert">Tidak ada data resep yang ditemukan.</div>'
                                );
                                $('#pasien-nama-resep').text('');
                                $('#print-resep-link').removeAttr('href');
                                $('#status-resep').empty(); // Kosongkan tampilan status jika tidak ada resep
                            }

                            // Mengisi tabel resep obat
                            const tableBody = $('#resep-obat-table-body');
                            tableBody.empty();

                            if (dataObatResep && dataObatResep.length > 0) {
                                $('#no-obat-alert').addClass('d-none');
                                $.each(dataObatResep, function(index, item) {
                                    let namaObat = '';
                                    if (item.tipe_obat === 'racikan') {
                                        namaObat = item.detail_obat.nama_racikan;
                                    } else if (item.tipe_obat === 'non_racikan') {
                                        namaObat = item.detail_obat.nama_obat;
                                    }

                                    const row = `
                                        <tr>
                                            <td>${paginationMeta.from + index}</td>
                                            <td>${namaObat || '-'}</td>
                                            <td>${item.tipe_obat === 'racikan' ? 'Racikan' : 'Non-Racikan'}</td>
                                            <td>
                                                <button class="btn btn-resep mb-3 px-3 py-2 detail-btn"
                                                    data-bs-toggle="modal" data-bs-target="#detailObatModal"
                                                    data-obat-index="${index}"
                                                    data-tipe-obat="${item.tipe_obat}"><img src="{{ asset('images/detail icon.png') }}" class="me-2">Detail</button>
                                            </td>
                                        </tr>
                                    `;
                                    tableBody.append(row);
                                });

                                // Event listener untuk tombol detail (harus ada setelah tabel diisi)
                                $('.detail-btn').off('click').on('click', function() {
                                    const obatIndex = $(this).data('obat-index');
                                    const selectedObat = dataObatResep[obatIndex];
                                    const modalBody = $('#detail-modal-body');
                                    modalBody.empty();

                                    let detailHtml = '';
                                    if (selectedObat.tipe_obat === 'racikan') {
                                        detailHtml = `
                                            <tr><td><strong>Nama Racikan</strong></td><td>:</td><td>${selectedObat.detail_obat.nama_racikan || '-'}</td></tr>
                                            <tr><td><strong>Bentuk Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.bentuk_obat || '-'}</td></tr>
                                            <tr><td><strong>Kemasan Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.kemasan_obat || '-'}</td></tr>
                                            <tr><td><strong>Instruksi Pemakaian</strong></td><td>:</td><td>${selectedObat.detail_obat.instruksi_pemakaian || '-'}</td></tr>
                                            <tr><td><strong>Instruksi Racikan</strong></td><td>:</td><td>${selectedObat.detail_obat.instruksi_racikan || '-'}</td></tr>
                                            <tr><td><strong>Jumlah Kemasan</strong></td><td>:</td><td>${selectedObat.detail_obat.jumlah_kemasan || '-'}</td></tr>
                                            <tr><td><strong>Takaran Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.takaran_obat || '-'}</td></tr>
                                            <tr><td><strong>Dosis</strong></td><td>:</td><td>${selectedObat.detail_obat.dosis || '-'}</td></tr>
                                        `;
                                    } else if (selectedObat.tipe_obat === 'non_racikan') {
                                        detailHtml = `
                                            <tr><td><strong>Nama Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.nama_obat || '-'}</td></tr>
                                            <tr><td><strong>Jumlah Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.jml_obat || '-'}</td></tr>
                                            <tr><td><strong>Bentuk Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.bentuk_obat || '-'}</td></tr>
                                            <tr><td><strong>Harga Satuan</strong></td><td>:</td><td>${formatRupiah(selectedObat.detail_obat.harga_satuan, 'Rp. ')}</td></tr>
                                            <tr><td><strong>Harga Total</strong></td><td>:</td><td>${formatRupiah(selectedObat.detail_obat.harga_total, 'Rp. ')}</td></tr>
                                            <tr><td><strong>Signatura</strong></td><td>:</td><td>${selectedObat.detail_obat.signatura || '-'}</td></tr>
                                            <tr><td><strong>Signatura Label</strong></td><td>:</td><td>${selectedObat.detail_obat.signatura_label || '-'}</td></tr>
                                            <tr><td><strong>Takaran Minum</strong></td><td>:</td><td>${selectedObat.detail_obat.takaran_minum || '-'}</td></tr>
                                            <tr><td><strong>Jumlah Kali Minum</strong></td><td>:</td><td>${selectedObat.detail_obat.jml_kali_minum || '-'}</td></tr>
                                            <tr><td><strong>Jumlah Obat Per Minum</strong></td><td>:</td><td>${selectedObat.detail_obat.jml_obat_per_minum || '-'}</td></tr>
                                            <tr><td><strong>Kemasan Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.kemasan_obat || '-'}</td></tr>
                                            <tr><td><strong>Aturan Pakai</strong></td><td>:</td><td>${selectedObat.detail_obat.aturan_pakai || '-'}</td></tr>
                                            <tr><td><strong>Golongan Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.golongan_obat || '-'}</td></tr>
                                            <tr><td><strong>Jumlah Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.jumlah_obat || '-'}</td></tr>
                                            <tr><td><strong>Waktu Minum</strong></td><td>:</td><td>${selectedObat.detail_obat.waktu_minum || '-'}</td></tr>
                                            <tr><td><strong>Keterangan</strong></td><td>:</td><td>${selectedObat.detail_obat.keterangan || '-'}</td></tr>
                                            <tr><td><strong>Kontraindikasi</strong></td><td>:</td><td>${selectedObat.detail_obat.kontraindikasi || '-'}</td></tr>
                                            <tr><td><strong>Pola Makan</strong></td><td>:</td><td>${selectedObat.detail_obat.pola_makan || '-'}</td></tr>
                                            <tr><td><strong>Interaksi Obat</strong></td><td>:</td><td>${selectedObat.detail_obat.interaksi_obat || '-'}</td></tr>
                                            <tr><td><strong>Petunjuk Penyimpanan</strong></td><td>:</td><td>${selectedObat.detail_obat.petunjuk_penyimpanan || '-'}</td></tr>
                                            <tr><td><strong>Kekuatan Sediaan</strong></td><td>:</td><td>${selectedObat.detail_obat.kekuatan_sediaan || '-'}</td></tr>
                                            <tr><td><strong>Informasi Tambahan</strong></td><td>:</td><td>${selectedObat.detail_obat.informasi_tambahan || '-'}</td></tr>
                                            <tr><td><strong>Efek Samping</strong></td><td>:</td><td>${selectedObat.detail_obat.efek_samping || '-'}</td></tr>
                                            <tr><td><strong>Indikasi</strong></td><td>:</td><td>${selectedObat.detail_obat.indikasi || '-'}</td></tr>
                                            <tr><td><strong>Status Ketersediaan</strong></td><td>:</td><td>${selectedObat.detail_obat.status_ketersediaan_obat || '-'}</td></tr>
                                        `;
                                    }
                                    modalBody.append(detailHtml);
                                });
                            } else {
                                $('#no-obat-alert').removeClass('d-none').text('Tidak ada data obat dalam resep ini.');
                            }

                            // Membangun link pagination
                            const paginationContainer = $('#pagination-links');
                            paginationContainer.empty();

                            if (paginationLinks && paginationLinks.length > 0) {
                                let paginationHtml = '<ul class="pagination">';
                                $.each(paginationLinks, function(index, link) {
                                    const activeClass = link.active ? 'active' : '';
                                    const disabledClass = !link.url ? 'disabled' : '';
                                    const pageLabel = link.label.replace('&laquo; Previous', '<i class="fas fa-angle-left"></i>').replace('Next &raquo;', '<i class="fas fa-angle-right"></i>');

                                    // Gunakan 'null' atau URL aktual untuk data-page
                                    const dataPageValue = link.url ? new URL(link.url).searchParams.get('page') : null;

                                    paginationHtml += `
                                        <li class="page-item ${activeClass} ${disabledClass}">
                                            <a class="page-link" href="#" data-page="${dataPageValue}">${pageLabel}</a>
                                        </li>
                                    `;
                                });
                                paginationHtml += '</ul>';
                                paginationContainer.append(paginationHtml);

                                // Event listener untuk link pagination
                                paginationContainer.find('.page-link').on('click', function(e) {
                                    e.preventDefault();
                                    const newPage = $(this).data('page');
                                    if (newPage) {
                                        currentPage = newPage;
                                        loadResepData(pasienId, currentSearchTerm, currentPage);
                                    }
                                });
                            }

                        } else {
                            console.error('Error fetching data:', response.message);
                            $('#resep-info-card').html(
                                '<div class="alert alert-danger" role="alert">Terjadi kesalahan saat memuat data resep.</div>'
                            );
                            $('#resep-obat-table-body').empty();
                            $('#no-obat-alert').removeClass('d-none').text('Gagal memuat data obat resep.');
                            $('#pagination-links').empty();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                        $('#resep-info-card').html(
                            '<div class="alert alert-danger" role="alert">Gagal terhubung ke API.</div>'
                        );
                        $('#resep-obat-table-body').empty();
                        $('#no-obat-alert').removeClass('d-none').text('Gagal memuat data obat resep.');
                        $('#pagination-links').empty();
                    }
                });
            }

            // Fungsi untuk memperbarui tampilan status resep
            function updateStatusDisplay(status) {
                const statusDiv = $('#status-resep');
                statusDiv.empty();
                if (status === 'diserahkan') {
                    statusDiv.html(`
                        <div class="alert alert-success" role="alert">
                            Resep ini sudah diserahkan kepada pasien.
                        </div>
                    `);
                } else if (status === 'belum_diserahkan') {
                    statusDiv.html(`
                        <div class="alert alert-danger" role="alert">
                            Resep ini belum diserahkan kepada pasien.
                        </div>
                    `);
                }
            }


            // Panggil fungsi saat halaman dimuat
            loadResepData(pasienId);

            // Handle form pencarian
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                currentSearchTerm = $('#search-input').val();
                currentPage = 1; // Reset ke halaman pertama saat melakukan pencarian baru
                loadResepData(pasienId, currentSearchTerm, currentPage);
            });

            // Handle saat modal ubah status penyerahan dibuka
            $('#ubahStatusPenyerahanModal').on('show.bs.modal', function () {
                // Pastikan status_diserahkan diisi dari data resep yang terakhir dimuat
                $('#current-status-penyerahan').text(currentResepStatus === 'diserahkan' ? 'Diserahkan' : 'Belum Diserahkan');
                $('#newStatusPenyerahan').val(currentResepStatus);
            });

            // Handle klik tombol "Simpan Perubahan" di modal ubah status penyerahan
            $('#saveStatusPenyerahanBtn').on('click', function() {
                const newStatus = $('#newStatusPenyerahan').val();

                $.ajax({
                    url: `/api/resep/pasien/status-penyerahan/${pasienId}`,
                    method: 'PUT',
                    data: {
                        status_diserahkan: newStatus,
                        _token: '{{ csrf_token() }}' // Penting untuk Laravel
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#ubahStatusPenyerahanModal').modal('hide');
                            // Muat ulang data resep untuk memperbarui tampilan status
                            loadResepData(pasienId, currentSearchTerm, currentPage);
                        } else {
                            alert('Gagal memperbarui status: ' + response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                        alert('Terjadi kesalahan saat memperbarui status penyerahan.');
                    }
                });
            });
        });
    </script>
@endpush