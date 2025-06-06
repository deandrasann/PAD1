@extends('footerheader.navbar')
@section('content')
    @if ($message = Session::get('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <title>Beranda</title>
    <h2>Beranda</h2>

    @can('apoteker')
        <div class="misahin role apoteker">
            <div class="info d-flex flex-wrap justify-content-start">
                <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>0</h2>
                        <p>Resep Baru</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/resep baru.png') }}" class="ms-3">
                    </div>
                </div>

                <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>
                            @if ($data_pasien_baru == null)
                                0
                            @else
                                {{ $data_pasien_baru }}
                            @endif
                        </h2>
                        <p>Pasien Baru</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/pasien baru.png') }}" class="ms-3">
                    </div>
                </div>

                <div class="container-row-3 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-2">
                        <h2>
                            @if ($data_pasien == null)
                                0
                            @else
                                {{ $data_pasien }}
                            @endif
                        </h2>
                        <p>Jumlah Pasien</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                    </div>
                </div>

                <div class="container-row-4 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>
                            @if ($data_obat == null)
                                0
                            @else
                                {{ $data_obat }}
                            @endif
                        </h2>
                        <p>Jumlah obat</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah obat.png') }}" class="ms-3">
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('pengawas')
        <div class="misahin role PMO">
            <div class="info d-flex flex-wrap justify-content-start">
                <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>0</h2>
                        <p>Pasien Baru</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/pasien baru.png') }}" class="ms-3">
                    </div>
                </div>

                <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>0</h2>
                        <p>Pasien Aktif</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/pasien aktif.png') }}" class="ms-3">
                    </div>
                </div>

                <div class="container-row-3 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-2">
                        <h2>
                            @if ($data_pasien == null)
                                0
                            @else
                                {{ $data_pasien }}
                            @endif
                        </h2>
                        <p>Riwayat Pasien</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/riwayat pasien.png') }}" class="ms-3">
                    </div>
                </div>

                <div class="container-row-4 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-3">
                        <h2>
                            @if ($data_pasien == null)
                                0
                            @else
                                {{ $data_pasien }}
                            @endif
                        </h2>
                        <p>Total Pasien</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('admin')
        <div class="misahin role PMO">
            <div class="info d-flex flex-wrap justify-content-start">
                <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>
                            @if ($data_apoteker == null)
                                0
                            @else
                                {{ $data_apoteker }}
                            @endif
                        </h2>
                        <p>Jumlah Apoteker</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah apoteker.png') }}" class="ms-3">
                    </div>
                </div>
                <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>
                            @if ($data_pengawas == null)
                                0
                            @else
                                {{ $data_pengawas }}
                            @endif
                        </h2>
                        <p>Jumlah Pengawas</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                    </div>
                </div>
            </div>
        </div>
    @endcan

@can("dokter")
    <div class="misahin role dokter">
        <div class="info d-flex flex-wrap justify-content-start">
            <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                <div class="me-4">
                    <h2>
                        @if ($totalPasienHariIni == null)
                            0
                        @else
                            {{ $totalPasienHariIni }}
                        @endif
                    </h2>
                    <p>Pasien Hari Ini</p>
                </div>
                <div>
                    <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                </div>
            </div>
            <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                <div class="me-4">
                    <h2>
                        @if ($pasienSelesai == null)
                            0
                        @else
                            {{ $pasienSelesai }}
                        @endif
                    </h2>
                    <p>Sudah Dilayani</p>
                </div>
                <div>
                    <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                </div>
            </div>
            <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                <div class="me-4">
                    <h2>
                        @if ($pasienBelumDipanggil == null)
                            0
                        @else
                            {{ $pasienBelumDipanggil }}
                        @endif
                    </h2>
                    <p>Belum Dilayani</p>
                </div>
                <div>
                    <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                </div>
            </div>
        </div>
    </div>
@endcan

    @can('apoteker')
        @php
            // Ambil data top 5 kode obat yang paling sering digunakan
            $top_kode_obat = DB::table('resep')
                ->join('obat', 'resep.kode_obat', '=', 'obat.kode_obat') // Join dengan tabel obat
                ->select('resep.kode_obat', 'obat.nama_obat', DB::raw('COUNT(*) as jumlah_penggunaan')) // Ambil kode_obat dan nama_obat
                ->groupBy('resep.kode_obat', 'obat.nama_obat') // Kelompokkan berdasarkan kode_obat dan nama_obat
                ->orderByDesc(DB::raw('COUNT(*)')) // Urutkan berdasarkan jumlah_penggunaan terbanyak
                ->limit(5) // Ambil 5 hasil terbanyak
                ->get(); // Ambil data dalam bentuk koleksi
        @endphp
        <div class="table-data table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Obat </th>
                        <th>Jumlah</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($top_kode_obat->isNotEmpty())
                        @foreach ($top_kode_obat as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_obat }}</td>
                                <td>{{ $item->jumlah_penggunaan }} kali</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Tidak ada data obat yang ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endcan

    @can('resepsionis')
        <div class="misahin role PMO">
            <div class="info d-flex flex-wrap justify-content-start">
                <div class="container-row-1 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>
                            @if ($pasienHariIni == null)
                                0
                            @else
                                {{ $pasienHariIni }}
                            @endif
                        </h2>
                        <p>Pasien Hari Ini</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah apoteker.png') }}" class="ms-3">
                    </div>
                </div>
                <div class="container-row-2 py-3 pe-3 my-3 me-3 d-flex justify-content-end align-items-start px-4">
                    <div class="me-4">
                        <h2>
                            @if ($totalPasien == null)
                                0
                            @else
                                {{ $totalPasien }}
                            @endif
                        </h2>
                        <p>Jumlah Pasien</p>
                    </div>
                    <div>
                        <img src="{{ asset('images/beranda/jumlah pasien.png') }}" class="ms-3">
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection
