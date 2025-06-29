@extends('footerheader.navbar-pmo') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- Kolom Konten Obat --}}
            <div class="col-md-9" data-pemeriksaan-id="{{ $pemeriksaanExists->id_pemeriksaan_akhir }}">
                <div class="p-3">
                    <h5>OBAT NON - RACIKAN</h5>
                    <div id="obat-non-racikan-container">
                        <p>Memuat data...</p>
                    </div>

                    <div class="mt-5">
                        <h5>OBAT RACIKAN</h5>
                        <div id="obat-racikan-container">
                            <p>Memuat data...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('[data-pemeriksaan-id]');
            const pemeriksaanId = container.dataset.pemeriksaanId;
            const apiUrl = `/api/lihat-obat-pasien/${pemeriksaanId}`;

            const formatRupiah = (number) => {
                if (isNaN(number) || number === null) return 'Rp 0';
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            };

            const createNonRacikanHtml = (obat) => {
                const hargaTotal = (obat.jml_obat || 0) * (obat.harga_satuan || 0);
                return `<div class="border rounded p-3 mb-3 bg-light">
            <div class="row align-items-end">
                <div class="col-md-4"><label class="form-label small">Nama Obat</label><input type="text" class="form-control" value="${obat.nama_obat || ''}" disabled></div>
                <div class="col-md-2"><label class="form-label small">Jumlah</label><input type="text" class="form-control" value="${obat.jml_obat || ''}" disabled></div>
                <div class="col-md-2"><label class="form-label small">Bentuk</label><input type="text" class="form-control" value="${obat.bentuk_obat || ''}" disabled></div>
                <div class="col-md-2"><label class="form-label small">Harga Satuan</label><input type="text" class="form-control text-end" value="${formatRupiah(obat.harga_satuan)}" disabled></div>
                <div class="col-md-2"><label class="form-label small">Harga Total</label><input type="text" class="form-control text-end" value="${formatRupiah(hargaTotal)}" disabled></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><label class="form-label small">Signatura (Keterangan)</label><input type="text" class="form-control" value="${obat.signatura || ''}" disabled></div>
                <div class="col-md-6"><label class="form-label small">Signatura Label</label><input type="text" class="form-control" value="${obat.signatura_label || ''}" disabled></div>
            </div>
        </div>`;
            };

            const createKomponenHtml = (komponen) => {
                const hargaTotalKomponen = (komponen.jumlah_diperlukan || 0) * (komponen.harga_satuan || 0);
                return `<div class="row mt-2 align-items-end">
            <div class="col-md-4"><input type="text" class="form-control form-control-sm" value="${komponen.nama_obat || ''}" disabled></div>
            <div class="col-md-2"><input type="text" class="form-control form-control-sm" value="${komponen.jumlah_diperlukan || ''}" disabled></div>
            <div class="col-md-2"><input type="text" class="form-control form-control-sm" value="${komponen.bentuk_obat || ''}" disabled></div>
            <div class="col-md-2"><input type="text" class="form-control form-control-sm text-end" value="${formatRupiah(komponen.harga_satuan)}" disabled></div>
            <div class="col-md-2"><input type="text" class="form-control form-control-sm text-end" value="${formatRupiah(hargaTotalKomponen)}" disabled></div>
        </div>`;
            }

            const createRacikanHtml = (racikan) => {
                const dosis = racikan.dosis ? racikan.dosis.split('x') : ['', ''];
                let komponenHtml =
                    '<p class="text-muted small fst-italic mt-2">Tidak ada komponen obat non-racikan dalam resep ini untuk diracik.</p>';
                if (racikan.komponen && racikan.komponen.length > 0) {
                    komponenHtml = racikan.komponen.map(createKomponenHtml).join('');
                }

                return `<div class="border rounded p-3 mb-4">
            <div class="row align-items-end">
                <div class="col-md-4"><label class="form-label small">Nama Racikan</label><input type="text" class="form-control" value="${racikan.nama_racikan || ''}" disabled></div>
                <div class="col-md-3"><label class="form-label small">Dosis</label><div class="input-group"><input type="text" class="form-control" value="${dosis[0] || ''}" disabled><span class="input-group-text">X</span><input type="text" class="form-control" value="${dosis[1] || ''}" disabled></div></div>
                <div class="col-md-3"><label class="form-label small">Bentuk Sediaan</label><input type="text" class="form-control" value="${racikan.bentuk_obat || ''}" disabled></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><label class="form-label small">Instruksi Pemakaian</label><input type="text" class="form-control" value="${racikan.instruksi_pemakaian || ''}" disabled></div>
                <div class="col-md-6"><label class="form-label small">Instruksi Racikan</label><input type="text" class="form-control" value="${racikan.instruksi_racikan || ''}" disabled></div>
            </div>
            <div class="row mt-2 align-items-end">
                 <div class="col-md-3"><label class="form-label small">Jumlah</label><input type="text" class="form-control" value="${racikan.jumlah_kemasan || ''}" disabled></div>
                 <div class="col-md-3"><label class="form-label small">Kemasan</label><input type="text" class="form-control" value="${racikan.kemasan_obat || ''}" disabled></div>
            </div>
            <hr class="my-3">
            <h6 class="mb-0">Komponen Obat</h6>
            <div class="row small text-muted fw-bold mt-2">
                <div class="col-md-4">Nama Obat</div><div class="col-md-2">Jumlah</div><div class="col-md-2">Bentuk</div><div class="col-md-2">Harga Satuan</div><div class="col-md-2">Harga Total</div>
            </div>
            ${komponenHtml}
        </div>`;
            };

            fetch(apiUrl)
                .then(res => res.json())
                .then(res => {
                    if (!res.success) throw new Error(res.message);
                    const {
                        data
                    } = res;
                    const nonRacikanContainer = document.getElementById('obat-non-racikan-container');
                    const racikanContainer = document.getElementById('obat-racikan-container');

                    nonRacikanContainer.innerHTML = data.obat_non_racikan.length > 0 ? data.obat_non_racikan
                        .map(createNonRacikanHtml).join('') : '<p>Tidak ada data obat non-racikan.</p>';
                    racikanContainer.innerHTML = data.obat_racikan.length > 0 ? data.obat_racikan.map(
                        createRacikanHtml).join('') : '<p>Tidak ada data obat racikan.</p>';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    const errorMsg = `<div class="alert alert-danger">Gagal memuat data.</div>`;
                    document.getElementById('obat-non-racikan-container').innerHTML = errorMsg;
                    document.getElementById('obat-racikan-container').innerHTML = errorMsg;
                });
        });
    </script>
    <script>

        $(document).ready(function(){
            function fetchProfileData(id) {
                $.ajax({
                    url: '/api/pasien/get/byPemeriksaanAwal/'+id,
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

            const pasienId = '{{ request()->route('id_pemeriksaan_awal') }}';
            fetchProfileData(pasienId)
        })
    </script>
@endpush
