@extends('ortu.layout.main')

@section('title', 'Dashboard Orang Tua - EDUTRACK')

@section('content')
<div>
  <h2 class="page-title">Data Siswa</h2>

  <!-- Biodata Siswa -->
  <div class="card shadow mb-4">
    <div class="card-body p-0">
      <table class="table table-borderless mb-0">
        <tr>
          <th class="col-3">Nama</th>
          <td>Ahmad Dwi Saputra</td>
        </tr>
        <tr>
          <th>NISN</th>
          <td>1234567890</td>
        </tr>
        <tr>
          <th>Nama Orang Tua</th>
          <td>Ibu Rina</td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td>6A</td>
        </tr>
        <tr>
          <th>Tahun Akademik</th>
          <td>2024 / 2025</td>
        </tr>
        <tr>
          <th>Semester</th>
          <td>Ganjil</td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Statistik -->
  <div class="row text-center mb-4">
    <div class="col-md-4 mb-3">
      <div class="card shadow border-0">
        <div class="card-body p-2">
          <h6 class="text-secondary mb-1">Total Nilai</h6>
          <h2 class="fw-bold text-primary">3</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow border-0">
        <div class="card-body p-2">
          <h6 class="text-secondary mb-1">Rata-rata Nilai</h6>
          <h2 class="fw-bold text-primary">85</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow border-0">
        <div class="card-body p-2">
          <h6 class="text-secondary mb-1">Kehadiran Bulan Ini</h6>
          <h2 class="fw-bold text-primary">98%</h2>
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
          <tr>
            <td>Matematika</td>
            <td class="text-center">88</td>
            <td class="text-center">A</td>
            <td>Sudah bagus, pertahankan!</td>
          </tr>
          <tr>
            <td>Bahasa Indonesia</td>
            <td class="text-center">82</td>
            <td class="text-center">B+</td>
            <td>Perlu lebih rajin membaca</td>
          </tr>
          <tr>
            <td>IPA</td>
            <td class="text-center">85</td>
            <td class="text-center">B+</td>
            <td>Baik, tingkatkan lagi eksperimen</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
