@extends('ortu.layout.main')

@section('title', 'Absensi - EDUTRACK')

@section('content')
<div>
    <h1 class="page-title mb-3">Absensi Siswa</h1>

    <!-- Navigasi Bulan -->
    <div class="card shadow mb-3">
        <div class="card-body p-2 text-center">
            <div class="month-navbar d-flex flex-wrap justify-content-center">

                @php
                    $bulanList = [
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ];
                    $currentBulan = request('bulan') ?? date('m');
                @endphp

                @foreach($bulanList as $num => $nama)
                    <a href="?bulan={{ $num }}"
                        class="btn {{ $currentBulan == $num ? 'btn-primary text-white' : 'btn-outline-primary' }}"
                        style="margin:4px;">
                        {{ $nama }}
                    </a>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Tabel Absensi -->
    <div class="card shadow">
        <div class="card-body p-2">
            <table class="table table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Status Kehadiran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($absensi as $a)
                        <tr>
                           <td>{{ \Carbon\Carbon::parse($a->date)->isoFormat('dddd') }}</td>


                            <td>{{ \Carbon\Carbon::parse($a->date)->translatedFormat('d F Y') }}</td>

                            <td class="
                                @if($a->status == 'present') text-success 
                                @elseif($a->status == 'sick') text-danger 
                                @elseif($a->status == 'permission') text-warning 
                                @else text-muted 
                                @endif fw-bold
                            ">
                                @if($a->status == 'present') Hadir
                                @elseif($a->status == 'sick') Sakit
                                @elseif($a->status == 'permission') Izin
                                @else Alpa
                                @endif
                            </td>

                            <td>{{ $a->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger fw-bold py-3">
                                Tidak ada data absensi pada bulan ini.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
