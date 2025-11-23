@extends('ortu.layout.main')

@section('title', 'Dashboard Orang Tua - EDUTRACK')

@section('content')
<div>
  <h2 class="page-title">Data Siswa</h2>

<div class="card shadow mb-4">
  <div class="card-body p-0">
    <table class="table table-borderless mb-0">
@if($siswa)
  <tr>
    <th>Nama</th>
    <td>{{ $siswa->name }}</td>
  </tr>
  <tr>
    <th>NISN</th>
    <td>{{ $siswa->nisn }}</td>
  </tr>
  <tr>
    <th>Nama Orang Tua</th>
    <td>{{ $ortu->name }}</td>
  </tr>
  <tr>
    <th>Kelas</th>
    <td>{{ $siswa->kelas->class }}{{ $siswa->kelas->subclass }}</td>
  </tr>
  <tr>
    <th>Tahun Akademik</th>
    <td>{{ $akademik->id_tahun}}</td>
  </tr>
  <tr>
    <th>Semester</th>
    <td>{{$semester->semester}}</td>
  </tr>
@else
  <tr>
    <td colspan="2" class="text-center text-danger fw-bold">
      Data siswa belum dihubungkan ke akun orang tua
    </td>
  </tr>
@endif

    </table>
  </div>
</div>


  <!-- Statistik -->
<div class="row text-center mb-4">

  <div class="col-md-4 mb-3">
    <div class="card shadow border-0">
      <div class="card-body p-2">
        <h6 class="text-secondary mb-1">Total Nilai</h6>
        <h2 class="fw-bold text-primary">{{ $totalNilai }}</h2>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card shadow border-0">
      <div class="card-body p-2">
        <h6 class="text-secondary mb-1">Rata-rata Nilai</h6>
        <h2 class="fw-bold text-primary">{{ $rataRata }}</h2>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card shadow border-0">
      <div class="card-body p-2">
        <h6 class="text-secondary mb-1">Kehadiran Bulan Ini</h6>
        <h2 class="fw-bold text-primary">{{ $kehadiran }}%</h2>
      </div>
    </div>
  </div>

</div>


  <!-- Tabel Nilai -->
  <div class="card shadow mb-4">
    <div class="card-body p-2">
      <h4 class="fw-bold mb-3">Data Nilai Terbaru</h4>
<table class="table table-striped align-middle">
  <thead class="table-primary text-center">
    <tr>
      <th>Mata Pelajaran</th>
      <th>Nilai</th>
      <th>Predikat</th>
      <th>Catatan</th>
    </tr>
  </thead>

  <tbody>
    @forelse($nilaiList as $n)
      @php
        $nilaiAkhir = round(($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6);
        $predikat = $nilaiAkhir >= 90 ? 'A' :
                    ($nilaiAkhir >= 80 ? 'B+' :
                    ($nilaiAkhir >= 70 ? 'B' : 'C'));
      @endphp

      <tr>
        <td>{{ $n->mapel->name }}</td>
        <td class="text-center">{{ $nilaiAkhir }}</td>
        <td class="text-center">{{ $predikat }}</td>
        <td>{{ $n->catatan ?? '-' }}</td>
      </tr>
    @empty
      <tr>
        <td colspan="4" class="text-center text-danger fw-bold">
          Tidak ada nilai pada semester dan tahun ini.
        </td>
      </tr>
    @endforelse
  </tbody>
</table>

    </div>
  </div>

</div>
@endsection
