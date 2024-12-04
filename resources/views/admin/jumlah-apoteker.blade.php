@extends('footerheader.navbar')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; right: 10px; top: 10px;"></button>
</div>
@elseif($message = Session::get('error'))
    <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container mt-3">
    <h2>JUMLAH APOTEKER</h2>

    <a type="button" class="btn btn-resep my-4" href="{{ route('tambah-apoteker') }}">
        + Tambah Apoteker
    </a>

    <!-- Search Bar -->
    <form action="{{ route('jumlah-apoteker') }}" method="GET">
    <div class="search-bar mb-3 d-flex">
        <input type="text" class="form-control" placeholder="Cari apoteker" name="search" value="{{ request("search") }}" autocomplete="off">
        <button class="btn btn-link" type="submit">
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
                    <th style="width:250px">Nama Apoteker</th>
                    <th style="width:400px">Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data_apoteker as $index => $item)
                    <tr>
                        <td>{{ $data_apoteker->firstItem() + $index }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->nama_apoteker }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <!-- Edit Button -->
                            <button class="btn btn-success editPasien p-2 px-3 mx-2" onclick="openEditApotekerModal({{$item->id_apoteker}})" id="editApoteker{{$item->id_apoteker}}">
                                <img src="{{ asset('images/edit icon.png') }}" class="me-2">Edit
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger p-2 px-3 mx-2 delete-btn" data-bs-toggle="modal"
                            data-bs-target="#hapusApotekerModal{{ $item->id_apoteker }}">
                            <img src="{{ asset('images/delete icon.png') }}" class="me-2">Hapus
                        </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="paginate d-flex justify-content-center">
            {{ $data_apoteker->links() }}
        </div>
    </div>

    <!-- Pagination -->



<div class="modal fade" id="editApotekerModal" tabindex="-1" aria-labelledby="editApotekerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editApotekerModalLabel">Edit Apoteker</h5>
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
                  <input type="text" class="form-control" id="usernameedit" name="username" >
                </div>
              </div>

              <!-- Bentuk Obat -->
              <div class="row mb-3">
                <label for="nama" class="col-md-4 col-form-label">Nama Apoteker</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="nama" name="nama_apoteker">
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


<!-- Modals -->
    <!-- Hapus Obat Modal -->
    @foreach ($data_apoteker as $key)
    <div class="modal fade" id="hapusApotekerModal{{ $key->id_apoteker }}" tabindex="-1" aria-labelledby="hapusApotekerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="HapusObatModalLabel">Hapus Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/warning icon.png') }}" alt="Warning">
                    <p>Anda yakin ingin menghapus apotker ini?</p>
                    <form action="{{ route('apoteker.destroy', $key->id_apoteker)}}" method="POST">
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
        @endforeach
    </div>

@endsection


<script>
    function openEditApotekerModal(id) {
   // document.getElementById('editObatModal').style.visibility="true";
   $('#editApotekerModal').modal('show');
   var editButton = document.getElementById("editApoteker"+id);
   var row = editButton.closest("tr");
   var data = row.getElementsByTagName('td');

   document.getElementById("formedit").action = "{{route('apoteker.update', '')}}/" + id;
   document.getElementById("usernameedit").value = data[1].innerText;
   document.getElementById("nama").value = data[2].innerText;
   // document.getElementById("editCategoryDescription").value = data[1].innerText;
   // document.getElementById("editCategoryDescription").value = data[2].innerText;
   // console.log(data);

 }
</script>
