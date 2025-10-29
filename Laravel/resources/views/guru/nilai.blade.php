@extends('guru.layout.main')

@section('title', 'Nilai Siswa - EDUTRACK')

@section('content')
<style>
  /* =====================
     STYLE UNTUK HALAMAN NILAI
  ====================== */
  .nilai {
    font-family: 'Poppins', sans-serif;
    color: #222;
  }

  .nilai label {
    font-weight: 500;
  }

  .nilai .controls {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 6px;
  }

  /* Tombol di dalam tabel */
  .btn-action {
    display: inline-block;
    margin-right: 6px;
  }
</style>

<div class="content nilai">
  <h2 class="page-title">Nilai Siswa</h2>

  <!-- Filter -->
  <div class="card">
    <div class="controls">
      <label for="kelas" style="min-width:130px;">Kelas:</label>
      <select class="select" id="kelas" name="kelas">
        <option value="">Pilih Kelas Siswa</option>
        <option value="1A">Kelas 1A</option>
        <option value="1B">Kelas 1B</option>
        <option value="2A">Kelas 2A</option>
        <option value="2B">Kelas 2B</option>
        <option value="3A">Kelas 3A</option>
      </select>
    </div>

   
  </div>

  <!-- Tabel Nilai -->
  <div class="table-wrapper">
    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Nama Ortu</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Alice</td>
          <td>Joko Susilo</td>
          <td>
            <a href="{{ route('guru.cek_nilai') }}" class="btn btn-sm btn-success btn-action">
              <i class="fas fa-eye"></i> Cek Nilai
            </a>
            <a href="{{ route('guru.input_nilai') }}" class="btn btn-sm btn-success btn-action">
              <i class="fas fa-edit"></i> Input Nilai
            </a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Anisa</td>
          <td>Jawara Susila</td>
          <td>
            <a href="{{ route('guru.cek_nilai') }}" class="btn btn-sm btn-success btn-action">
              <i class="fas fa-eye"></i> Cek Nilai
            </a>
            <a href="{{ route('guru.input_nilai') }}" class="btn btn-sm btn-success btn-action">
              <i class="fas fa-edit"></i> Input Nilai
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
