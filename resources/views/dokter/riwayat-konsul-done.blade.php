@extends('footerheader.navbar-pmo')
@section('content')
    <style>
        .nav-link {
            color: #6c757d;
            /* abu-abu default */
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .nav-link.active {
            color: #20587a;
            /* biru */
            font-weight: bold;
            border-bottom: 3px solid #20587a;
        }
    </style>
    <nav class="nav">
        <a class="nav-link {{ request()->routeIs('detail-data-pasien') ? 'active' : '' }}"
            href="{{ route('detail-data-pasien', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}">
            Isi Resume Medis
        </a>

        <a class="nav-link {{ request()->routeIs('riwayat-konsul-done') ? 'active' : '' }}"
            href="{{ route('riwayat-konsul-done', ['id_pemeriksaan_awal' => $kunjungan->id_pemeriksaan_awal]) }}">
            Riwayat Konsultasi
        </a>
    </nav>

    <div class="table-responsive my-4 mx-2">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="px-4 py-2" style="width: fit-content">Tanggal</th>
                    <th class="px-4 py-2 w-25">Nakes</th>
                    <th class="px-4 py-2">Anamnesa</th>
                    <th class="px-4 py-2">Diagnosis</th>
                    <th class="px-4 py-2">Medikamentosa </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($antreanPasien as $item)
                    <tr>
                        <td class="px-4 py-2">
                            <strong>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</strong><br>
                            {{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->format('H:i') }} Asia/Jakarta Timezone
                        </td>
                        <td class="px-4 py-2">
                            <strong>{{ $item->nama_dokter }}</strong><br>{{ $item->spesialis }}
                        </td>
                        <td class="px-4 py-2">{{ $item->anamnesa }}</td>
                        <td class="px-4 py-2">{{ $item->diagnosis ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->medikamentosa ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada riwayat konsultasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
