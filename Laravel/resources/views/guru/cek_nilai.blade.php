@extends('guru.layout.main')

@section('title', 'Cek Nilai - EDUTRACK')

@section('content')
<div>
  <h2 class="page-title">Cek Nilai</h2>

  <div class="card shadow-sm mb-4 p-4">
    <p>Nama Siswa: <b>Joko Nico</b></p>

    <form method="POST" action="#">
      @csrf
      <div class="row mb-3">
        <label for="tahun" class="col-sm-3 col-form-label">Tahun Akademik:</label>
        <div class="col-sm-9">
          <select id="tahun" name="tahun" class="form-select">
            <option value="">Pilih Tahun Akademik</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <label for="semester" class="col-sm-3 col-form-label">Semester:</label>
        <div class="col-sm-9">
          <select id="semester" name="semester" class="form-select">
            <option value="">Pilih Semester</option>
            <option value="ganjil">Ganjil</option>
            <option value="genap">Genap</option>
          </select>
        </div>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-success me-2">Simpan</button>
        <a href="{{ route('guru.nilai') }}" class="btn btn-danger">Kembali</a>
      </div>
    </form>
  </div>

  <div class="card shadow-sm p-3">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th style="width: 60px;">No</th>
          <th>Nama Mata Pelajaran</th>
          <th style="width: 200px; text-align:center;">Nilai</th> <!-- Lebar kolom diperlebar -->
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Matematika</td>
          <td class="text-center">89</td>
        </tr>
        <tr>
          <td>2</td>
          <td>IPA</td>
          <td class="text-center">90</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
