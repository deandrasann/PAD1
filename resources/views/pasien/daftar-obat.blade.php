@extends('footerheader.navbar-pmo')
@section('content')
<div class="py-2 w-100">
    <div class="d-flex align-items-start mb-4">
        <a href="{{ route('hasil.scan') }}">
            <img src="{{ asset('images/ic_round-navigate-next.png') }}" alt="Back" class="me-2">
        </a>
        <h2 class="fw-bold text-center mb-4 flex-grow-1" style="color:black">Obat Anda</h2>
    </div>

    <!-- Card Obat -->
    <div id="list-obat"></div>

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
@endsection
@push('scripts')
<script>
$(document).ready(function() {
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

        function fetchData() {
            $.ajax({
                url: '{{ route('api.pasien.daftar-obat') }}',
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        let hasilData = response.data;
                        if(hasilData.data_pasien) {
                            $('#sidebar_norm').text(hasilData.data_pasien.no_rm);
                            $('#sidebar_nama').text(hasilData.data_pasien.nama);
                            $('#sidebar_jeniskelamin').text(hasilData.data_pasien.jenis_kelamin);
                            $('#sidebar_tanggallahir').text(hasilData.data_pasien.tanggal_lahir);
                            $('#sidebar_notelp').text(hasilData.data_pasien.no_telp);
                            $('#sidebar_alamat').text(hasilData.data_pasien.alamat);
                        } else {
                            alert('Data pasien tidak ditemukan.');
                        }
                        if(hasilData.data_resep){
                          if(hasilData.data_resep.status_diserahkan == "diserahkan"){
                            if(hasilData.data_obat) {
                                let html = '';
                                hasilData.data_obat.forEach(function(item, index) {
                                    let idObatUntukJadwal = '';
                                    if (item.tipe_obat === "racikan") {
                                        idObatUntukJadwal = item.detail_obat.id_obat_racikan || '';
                                    } else if (item.tipe_obat === "non_racikan") {
                                        idObatUntukJadwal = item.detail_obat.id_obat_non_racikan || '';
                                    }

                                    const aturJadwalUrl = `{{ url('atur-jadwal') }}/${idObatUntukJadwal}?tipe_obat=${item.tipe_obat}`;
                                    let cardData = `
                                    <div class="card mb-3 p-4 card-custom">
                                      <h5 class="fw-bold">${ item.tipe_obat == "racikan" ? item.detail_obat.nama_racikan : item.detail_obat.nama_obat }</h5>
                                      <p class="mb-3">Status: ${ item.detail_obat.status_pengobatan == "proses_pengobatan" ? "Proses Pengobatan" : item.detail_obat == "pengobatan_selesai" ? "Pengobatan Selesai" : "Dihentikan" }</p>
                                      <div class="d-flex gap-2">
                                        <button class="btn btn-resep detail-btn" data-bs-toggle="modal" data-bs-target="#detailObatModal" data-obat-index="${index}">
                                          <i class="fas fa-info-circle"></i> <a href="#" style="color: white; text-decoration:none">Detail Obat</a>
                                        </button>
                                        <button class="btn btn-warning" style="color: white; background-color:#FFA827">
                                          <i class="fas fa-cogs"></i> <a href="${aturJadwalUrl}" style="color: white; text-decoration:none">Atur Jadwal Minum</a>
                                        </button>
                                      </div>
                                    </div>
                                    `;
                                    html += cardData;
                                })
                                $('#list-obat').html(html);

                                $('.detail-btn').off('click').on('click', function() {
                                    const obatIndex = $(this).data('obat-index');
                                    const selectedObat = hasilData.data_obat[obatIndex];
                                    const modalBody = $('#detail-modal-body');
                                    console.log(obatIndex, selectedObat);
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
                                alert('Data obat tidak ditemukan.');
                            }
                          } else {
                            alert('Resep belum diserahkan.');
                          }
                        } else {
                            alert('Data resep tidak ditemukan.');
                        }
                    } else {
                        alert('Gagal mengambil data obat: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + error);
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });
        }
        fetchData();
    });
</script>  
@endpush