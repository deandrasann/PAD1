@extends('footerheader.navbar')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                style="position: absolute; right: 10px; top: 10px;"></button>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-3">
        <h2>DATA PENGAWAS</h2>

        <a type="button" class="btn btn-resep my-4" href="{{ route('tambah-pengawas') }}">
            + Tambah Pengawas
        </a>

        <!-- Search Bar -->
        <form action="{{ route('jumlah-pengawas') }}" method="GET">
        <div class="search-bar mb-3 d-flex">
            <input type="text" class="form-control" placeholder="Cari apoteker" name="search" value="{{ request("search") }}" autocomplete="off">
            <button class="btn btn-link">
                <img src="{{ asset('images/search icon.png') }}" alt="Search Icon">
            </button>
        </div>
    </form>
        <!-- Tabel Data Apoteker -->
        <div class="card p-4 table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th style="width:250px">Username</th>
                        <th style="width:250px">Nama Pengawas</th>
                        <th style="width:400px">Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pengawas as $index => $item)
                        <tr>
                            <td>{{ $data_pengawas->firstItem() + $index }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->nama_pengawas }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <!-- Edit Button -->
                                <button class="btn btn-success editPengawas p-2 px-3 mx-2"
                                    onclick="openEditPengawasModal({{ $item->id_pengawas }})"
                                    id="editPengawas{{ $item->id_pengawas }}">
                                    <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                                </button>


                                <!-- Delete Button -->
                                <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#hapusPengawasModal{{ $item->id_pengawas }}">
                                    <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginate d-flex justify-content-center">
                {{ $data_pengawas->links() }}
            </div>
        </div>

        <!-- Pagination -->
       
    <!-- Modals -->

    <!-- Hapus Obat Modal -->
    @foreach ($data_pengawas as $key)
        <div class="modal fade" id="hapusPengawasModal{{ $key->id_pengawas }}" tabindex="-1"
            aria-labelledby="hapusPengawasModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="HapusPengawasModalLabel">Hapus Pengawas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                        <p>Anda yakin ingin menghapus pengawas ini?</p>
                        <form action="{{ route('pengawas.destroy', $key->id_pengawas) }}" method="POST">
                            <div class="d-flex justify-content-around mt-3">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">TIDAK</button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4">YA</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
          </div>
          @endforeach

    <div class="modal fade" id="editPengawasModal" tabindex="-1" aria-labelledby="editPengawasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPengawasModalLabel">Edit Pengawas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formedit">
                    @csrf
                    <div class="modal-body">
                        <form>
                            <!-- Nama Obat -->
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label">Username</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="usernameedit" name="username">
                                </div>
                            </div>

                            <!-- Bentuk Obat -->
                            <div class="row mb-3">
                                <label for="nama" class="col-md-4 col-form-label">Nama Pengawas</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="nama" name="nama_pengawas">
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-resep ms-auto">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

@endsection

<script>
    function openEditPengawasModal(id) {
        // document.getElementById('editObatModal').style.visibility="true";
        $('#editPengawasModal').modal('show');
        var editButton = document.getElementById("editPengawas" + id);
        var row = editButton.closest("tr");
        var data = row.getElementsByTagName('td');

        document.getElementById("formedit").action = "{{ route('pengawas.update', '') }}/" + id;
        document.getElementById("usernameedit").value = data[1].innerText;
        document.getElementById("nama").value = data[2].innerText;
        // document.getElementById("editCategoryDescription").value = data[1].innerText;  
        // document.getElementById("editCategoryDescription").value = data[2].innerText;  
        // console.log(data);

    }
</script>
