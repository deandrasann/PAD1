@extends('footerheader.navbar-pmo')
@section('content')
<div class="d-flex align-items-start mb-4">
    <a href="{{ route('daftar-obat-pasien') }}">
        <img src="{{ asset('images/ic_round-navigate-next.png') }}" alt="Back" class="me-2">
    </a>
    <h2 class="fw-bold text-center mb-4 flex-grow-1" style="color:black">Atur Jadwal Minum Obat Anda</h2>
</div>

<form id="formAturJadwal">
    @csrf {{-- Penting untuk Laravel, untuk keamanan --}}
    <input type="hidden" id="obatIdHidden" name="obat_id">
    <input type="hidden" id="tipeObatHidden" name="tipe_obat">
    <input type="hidden" id="resepDetailIdHidden" name="resep_detail_id"> {{-- Tambahan penting --}}

    <div class="mb-3 text-dark me-4">
        <strong>Aturan pakai</strong><br>
        <span id="aturanPakaiText">Memuat...</span>
    </div>
    <hr>

    <div id="waktuMinumInputs">
        {{-- Input waktu akan di-generate oleh JavaScript di sini --}}
        <p>Memuat input waktu...</p>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="isiOtomatis">
        <label class="form-check-label" for="isiOtomatis">
            Isi Otomatis
        </label>
    </div>

    <hr>

    <div class="mb-3 text-dark">
        <label for="tanggalMulai" class="form-label">Mulai Tanggal</label>
        <div class="input-group">
            <input type="date" class="form-control bg-light border-0 px-3 py-2 rounded-start" id="tanggalMulai" name="tanggal_mulai">
            <span class="input-group-text bg-light border-0 rounded-end"></span>
        </div>
    </div>
    <hr>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="kirim_notifikasi" value="1" id="kirimNotifikasi">
        <label class="form-check-label" for="kirimNotifikasi">
            Kirim notifikasi saat waktu minum
        </label>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <a class="btn btn-light border border-dark" href="{{route('daftar-obat-pasien')}}">Batal</a>
        <button type="submit" class="btn btn-resep" id="saveJadwalBtn">Simpan</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Fungsi untuk mendapatkan parameter dari URL
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    function extractDosis(aturanPakai) {
        const doses = aturanPakai.split('x').map(d => d.trim());
        return parseInt(doses[0]) || 0;
    }

    function getValidIntFromSignatura(jumlah) {
      const matches = jumlah.match(/^\d+/);

      if (matches && matches.length > 0) {
        const nilai = parseInt(matches[0], 10);

        return nilai;
      } else {
        return null;
      }
    }

    function fetchProfileData() {
        $.ajax({
            url: '{{ route('api.pasien.profile') }}',
            method: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    const profile = response.data;
                    $('#sidebar_norm').text(profile.no_rm || '-');
                    $('#sidebar_nama').text(profile.nama || '-');
                    $('#sidebar_jeniskelamin').text(profile.jenis_kelamin || '-');
                    $('#sidebar_tanggallahir').text(profile.tanggal_lahir || '-');
                    $('#sidebar_notelp').text(profile.no_telp || '-');
                    $('#sidebar_alamat').text(profile.alamat || '-');
                } else {
                    console.error('Gagal mengambil data profil:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error fetching profile:", status, error, xhr.responseText);
            }
        });
    }
    fetchProfileData()

    const obatId = '{{ request()->route('id') }}';
    const tipeObat = getUrlParameter('tipe_obat');

    if (!obatId || !tipeObat) {
        alert('ID obat atau tipe obat tidak ditemukan di URL.');
        window.location.href = '{{ route('daftar-obat-pasien') }}';
        return;
    }

    $('#obatIdHidden').val(obatId);
    $('#tipeObatHidden').val(tipeObat);

    function fetchObatDetail(id, type) {
        $.ajax({
            url: `/api/pasien/obat-detail/${id}?tipe_obat=${type}`, 
            method: 'GET',
            success: function(response) {
                if (response.status === 'success' && response.data) {
                    const selectedObat = response.data;
                    console.log("Detail Obat untuk Jadwal:", selectedObat);

                    $('#resepDetailIdHidden').val(selectedObat.id_resep_detail || '');

                    let aturanPakaiText = '';
                    let jumlahKaliMinum = 0;
                    if (selectedObat.tipe_obat === 'racikan') {
                        aturanPakaiText = `${selectedObat.detail_obat.takaran_obat || '-'} | ${selectedObat.detail_obat.instruksi_pemakaian || '-'}`;
                        jumlahKaliMinum = extractDosis(selectedObat.detail_obat.takaran_obat || '3x sehari'); 
                    } else if (selectedObat.tipe_obat === 'non_racikan') {
                        aturanPakaiText = `${selectedObat.detail_obat.signatura || '-'}`;
                        jumlahKaliMinum = getValidIntFromSignatura(selectedObat.detail_obat.signatura || '3x sehari');
                    }
                    $('#aturanPakaiText').text(aturanPakaiText);

                    let waktuInputsHtml = '';
                    if (jumlahKaliMinum > 0) {
                        for (let i = 1; i <= jumlahKaliMinum; i++) {
                            waktuInputsHtml += `
                                <div class="mb-3 text-dark">
                                    <label for="waktuMinum${i}" class="form-label">Waktu ${i}</label>
                                    <div class="input-group">
                                        <input type="time" class="form-control waktu-input-jadwal" id="waktuMinum${i}" name="waktu_minum[]" placeholder="Masukkan waktu minum obat">
                                    </div>
                                </div>
                            `;
                        }
                    } else {
                        waktuInputsHtml = `<p>Jumlah kali minum tidak ditentukan untuk obat ini. Harap hubungi apoteker.</p>`;
                    }
                    $('#waktuMinumInputs').html(waktuInputsHtml);

                    const today = new Date().toISOString().split('T')[0];
                    $('#tanggalMulai').val(today);

                    $('#isiOtomatis').prop('checked', false);
                    $('#kirimNotifikasi').prop('checked', false);

                } else {
                    alert('Gagal mengambil detail obat: ' + response.message);
                    console.error('API Error:', response.message);
                    window.location.href = '{{ route('daftar-obat-pasien') }}';
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error fetching detail:", status, error, xhr.responseText);
                alert('Terjadi kesalahan saat mengambil detail obat.');
                // window.location.href = '{{ route('daftar-obat-pasien') }}';
            }
        });
    }

    fetchObatDetail(obatId, tipeObat);

    $('#isiOtomatis').off('change').on('change', function () {
        const inputs = $('#waktuMinumInputs .waktu-input-jadwal');
        const totalInputs = inputs.length;

        if (this.checked) {
            const interval = Math.floor(24 / totalInputs);
            let jam = 6; // Waktu awal jam 6 pagi

            inputs.each(function(index, input) {
                let hours = (jam + index * interval) % 24;
                let formatted = `${hours.toString().padStart(2, '0')}:00`;
                $(input).val(formatted);
                $(input).removeAttr("placeholder");
            });

        } else {
            inputs.each(function(index, input) {
                $(input).val("");
                $(input).attr("placeholder", "Masukkan waktu minum obat");
            });
        }
    });

    // Handle Form Submission Jadwal Minum dengan AJAX
    $('#formAturJadwal').off('submit').on('submit', function(e) {
        e.preventDefault(); // Mencegah form submit biasa

        const form = $(this);
        const formData = new FormData(form[0]); // Ambil semua data form

        // Ambil semua waktu minum
        const waktuMinumArray = [];
        $('.waktu-input-jadwal').each(function() {
            if ($(this).val()) {
                waktuMinumArray.push($(this).val());
            }
        });
        // Ubah array waktu minum menjadi string JSON agar mudah dikirim melalui FormData
        formData.set('waktu_minum', JSON.stringify(waktuMinumArray)); 
        
        // Pastikan resep_detail_id sudah ada di formData dari hidden input
        // Jika belum ada atau kosong, tambahkan logika validasi di sini atau di backend

        $.ajax({
            url: '{{ route('api.pasien.simpan-jadwal-minum') }}', // Endpoint API untuk menyimpan jadwal
            method: 'POST',
            data: formData,
            processData: false, // Penting saat menggunakan FormData
            contentType: false, // Penting saat menggunakan FormData
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Pastikan ada meta tag CSRF di layout Anda
            },
            beforeSend: function() {
                $('#saveJadwalBtn').prop('disabled', true).text('Menyimpan...');
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert('Jadwal minum berhasil disimpan!');
                    window.location.href = '{{ route('daftar-obat-pasien') }}'; // Kembali ke daftar obat
                } else {
                    alert('Gagal menyimpan jadwal: ' + response.message);
                    console.error('API Error:', response.message, response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error saving schedule:", status, error, xhr.responseText);
                let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                try {
                    const errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.message) {
                        errorMessage = errorResponse.message;
                    }
                    if (errorResponse.errors) {
                        for (const key in errorResponse.errors) {
                            errorMessage += `\n${key}: ${errorResponse.errors[key].join(', ')}`;
                        }
                    }
                } catch (e) {
                    // ignore
                }
                alert(errorMessage);
            },
            complete: function() {
                $('#saveJadwalBtn').prop('disabled', false).text('Simpan');
            }
        });
    });
});
</script>
@endpush