@extends('footerheader.navbar')
@section('content')
    <div class="container">
        <h2 class="me-4">RIWAYAT RESEP</h2>

        <!-- Search + Tambah Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Search Bar -->
            <div class="search-bar mt-2">
                <input type="text" class="form-control" placeholder="Cari Resep" name="search" id="searchResep"
                    value="{{ request('search') }}" autocomplete="off">
                <button class="btn btn-link" type="button" id="searchButton">
                    <img src="{{ asset('images/search icon.png') }}">
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nomor</th>
                            <th style="width: 15%">Tanggal Resep</th>
                            <th>Nomor Resep</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jumlah Obat</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="resepTableBody">
                        
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="paginationLinks" class="paginate d-flex justify-content-center mt-3">
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
        $(document).ready(function() {
            // Function to fetch and display obat data
            function fetchResep(page = 1, searchQuery = '') {
                $.ajax({
                    url: '{{ route('api.resep.get') }}',
                    method: 'GET',
                    data: {
                        page: page,
                        search: searchQuery
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            let resepData = response.data.data;
                            let html = '';
                            if (resepData.length > 0) {
                                $.each(resepData, function(index, item) {
                                    html += `
                                   <tr>
                                        <td>${response.data.from + index}</td>
                                        <td>${item.tgl_resep}</td>
                                        <td style="text-align: center;">${item.no_resep}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.tanggal_lahir}</td>
                                        <td>${item.alamat}</td>
                                        <td style="text-align: center;">${item.jumlah_obat}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <!-- Detail Button -->
                                                <a href="/resep-pasien/${item.id_pasien}" class="btn btn-resep btn-sm detail-btn">
                                                    <img src="{{ asset('images/detail icon.png') }}" class="me-1" alt="Detail">Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    `;
                                });
                            } else {
                                html = `<tr><td colspan="7" class="text-center">Tidak Ada Data</td></tr>`;
                            }
                            $('#resepTableBody').html(html);

                            // --- Generasi Pagination ---
                            let paginationHtml = '<ul class="pagination">';
                            $.each(response.data.links, function(index, link) {
                                let activeClass = link.active ? 'active' : '';
                                let disabledClass = link.url === null ? 'disabled' : ''; // Jika URL null, nonaktifkan
                                let pageNumber;

                                // Ekstrak nomor halaman dari URL, atau gunakan label untuk Prev/Next
                                if (link.url) {
                                    const urlParams = new URLSearchParams(new URL(link.url).search);
                                    pageNumber = urlParams.get('page');
                                } else {
                                    // Untuk "Previous" atau "Next" yang disabled, kita perlu logika khusus
                                    // Jika label adalah "Previous" dan URL null, berarti di halaman pertama
                                    // Jika label adalah "Next" dan URL null, berarti di halaman terakhir
                                    if (link.label.includes('Previous') && link.url === null) {
                                        pageNumber = 1; // Tetap di halaman 1 jika di awal dan prev disabled
                                    } else if (link.label.includes('Next') && link.url === null) {
                                        pageNumber = response.data.last_page; // Menuju halaman terakhir
                                    } else {
                                        // Untuk tautan angka, label sudah menjadi nomor halaman
                                        pageNumber = link.label;
                                    }
                                }

                                paginationHtml += `
                                    <li class="page-item ${activeClass} ${disabledClass}">
                                        <a class="page-link" href="#" data-page="${pageNumber}">${link.label}</a>
                                    </li>
                                `;
                            });
                            paginationHtml += '</ul>';
                            $('#paginationLinks').html(paginationHtml);

                            // Attach click event to pagination links
                            $('#paginationLinks .page-link').on('click', function(e) {
                                e.preventDefault(); // Mencegah perilaku default tautan
                                const pageNum = $(this).data('page');
                                const currentSearchQuery = $('#searchInput').val(); // Ambil nilai dari input search
                                if (pageNum && !$(this).parent().hasClass('disabled')) { // Pastikan ada pageNum dan tidak disabled
                                    fetchResep(pageNum, currentSearchQuery);
                                }
                            });
                            // --- Akhir Generasi Pagination ---

                        } else {
                            alert('Gagal mengambil data resep: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            }
            // Initial load of data
            fetchResep();
            $('#searchButton').on('click', function() {
                let searchQuery = $('#searchResep').val();
                fetchResep(1, searchQuery); // Reset to page 1 on new search
            });

            // Live search as user types (optional, can be performance intensive on large datasets)
            $('#searchResep').on('keyup', function() {
                let searchQuery = $(this).val();
                fetchResep(1, searchQuery);
            });

            // Pagination links click handler (delegated event)
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let pageUrl = $(this).attr('href');
                let page = new URL(pageUrl).searchParams.get('page');
                let searchQuery = $('#searchResep').val();
                fetchResep(page, searchQuery);
            });
        });
    </script>
@endpush