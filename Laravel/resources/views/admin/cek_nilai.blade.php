@extends('admin.layout.main')
@section('title', 'Cek Nilai Siswa - EDUTRACK')

@section('content')
<style>
  /* --- AREA UTAMA HALAMAN CEK NILAI --- */
  .cek-nilai {
    max-width: 100%;
    margin: 40px auto;
    font-family: 'Poppins', sans-serif;
    color: #222;
  }

  .cek-nilai h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 24px;
  }

  /* --- KARTU UNTUK BIODATA DAN TABEL --- */



  /* --- TABEL NILAI --- */
  .cek-nilai table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 6px rgba(0,0,0,0.08);
  }

  .cek-nilai th,
  .cek-nilai td {
    padding: 10px 14px;
    text-align: center;
    border: 1px solid #ccc;
  }

  .cek-nilai th {
    background-color: #f8f8f8;
    font-weight: 600;
  }
</style>

<div class="cek-nilai">
  <h1>Cek Nilai Siswa</h1>

  <!-- Biodata Siswa -->
  <div class="card">
    <p><strong>Nama Siswa :</strong> Michael Joko Nurcipto</p>
    <p><strong>Semester :</strong> Ganjil</p>
    <p><strong>Tahun Akademik :</strong> 2024/2025</p>
  </div>

  <!-- Tabel Nilai -->
  <div class="card">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Nilai</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Matematika</td>
          <td>87</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Bahasa Indonesia</td>
          <td>90</td>
        </tr>
        <tr>
          <td>3</td>
          <td>IPA</td>
          <td>85</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
