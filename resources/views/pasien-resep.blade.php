@extends('footerheader.navbar')
@section('content')
    <div class="container">
        <h2 class="me-4">DATA PASIEN</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form id="searchPasienForm" method="GET"> {{-- Memberi ID pada form search --}}
                <div class="search-bar mt-2">
                    <input type="text" class="form-control" placeholder="Cari Pasien" id="searchPasienInput" name="search"
                        value="{{ request('search') }}"> {{-- Memberi ID pada input search --}}
                    <button class="btn btn-link" type="submit" id="searchPasienButton"> {{-- Memberi ID pada tombol search --}}
                        <img src="{{ asset('images/search icon.png') }}">
                    </button>
                </div>
            </form>
        
            @if ($data_pasien->isEmpty())
                <button type="button" class="btn btn-resep px-4 py-3" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
                    <strong>+ Tambah Pasien</strong>
                </button>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center p-4">
        <div class="card p-4 w-100">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">No RM</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">Jenis kelamin</th>
                        <th class="px-4 py-2">Tanggal Lahir</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody  id="pasienTableBody">
                    {{-- <button class="btn btn-resep p-2 px-3 detail-btn" type="submit"
                        onclick="document.location='{{ route('resep-tiap-pasien', $item->id_pasien) }}'">
                        <img src="{{ asset('images/detail icon.png') }}" class="me-2"> Detail
                    </button> --}}
                </tbody>
            </table>

            <!-- Pagination -->
            <div id="paginationLinks" class="paginate d-flex justify-content-center">
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to fetch and display patient data
        function fetchPasienData(page = 1, searchQuery = '') {
            $.ajax({
                url: '{{ route('api.pasien.get') }}',
                method: 'GET',
                data: {
                    page: page,
                    search: searchQuery
                },
                success: function(response) {
                    if (response.status === 'success') {
                        let pasienData = response.data.data;
                        let html = '';
                        if (pasienData.length > 0) {
                            $.each(pasienData, function(index, item) {
                                // Pastikan path foto benar, gunakan default jika kosong
                                let fotoSrc = item.foto ? '{{ asset('storage/') }}/' + item.foto : '{{ asset('avatars/noimage.png') }}';

                                html += `
                                <tr>
                                    <td>${item.no_rm}</td>
                                    <td>${item.nama}</td>
                                    <td>${item.jenis_kelamin}</td>
                                    <td>${item.tanggal_lahir}</td>
                                    <td>${item.alamat}</td>
                                    <td>${item.no_telp}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <button class="btn btn-resep p-2 px-3 detail-btn" type="submit"
                                                onclick="document.location='/resep-pasien/${item.id_pasien}'"'">
                                                <img src="{{ asset('images/detail icon.png') }}" class="me-2"> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                `;
                            });
                        } else {
                            html = `<tr><td colspan="7" class="text-center">Tidak Ada Data</td></tr>`;
                        }
                        $('#pasienTableBody').html(html);

                        // --- Generasi Pagination ---
                        let paginationHtml = '<ul class="pagination">';
                        $.each(response.data.links, function(index, link) {
                            let activeClass = link.active ? 'active' : '';
                            let disabledClass = link.url === null ? 'disabled' : '';
                            let pageNumber;

                            if (link.url) {
                                const urlParams = new URLSearchParams(new URL(link.url).search);
                                pageNumber = urlParams.get('page');
                            } else {
                                if (link.label.includes('Previous') && link.url === null) {
                                    pageNumber = 1;
                                } else if (link.label.includes('Next') && link.url === null) {
                                    pageNumber = response.data.last_page;
                                } else {
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

                        // Attach click event to pagination links (delegated)
                        $('#paginationLinks').off('click', '.page-link').on('click', '.page-link', function(e) {
                            e.preventDefault();
                            const pageNum = $(this).data('page');
                            const currentSearchQuery = $('#searchPasienInput').val();
                            if (pageNum && !$(this).parent().hasClass('disabled')) {
                                fetchPasienData(pageNum, currentSearchQuery);
                            }
                        });

                    } else {
                        alert('Gagal mengambil data pasien: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + error);
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });
        }

        // Initial load of data
        fetchPasienData();

        // Search functionality
        $('#searchPasienForm').on('submit', function(e) { // Listen for form submission
            e.preventDefault(); // Prevent default form submission
            let searchQuery = $('#searchPasienInput').val();
            fetchPasienData(1, searchQuery); // Reset to page 1 on new search
        });
 

    });
</script>
@endpush