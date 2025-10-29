@extends('admin.layout.main')

@section('title', 'Tambah Guru - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Guru</h2>
  <div class="card">

    <form action="#" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="nama">Nama Guru</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama guru" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="mapel">Mata Pelajaran</label>
        <input type="text" id="mapel" name="mapel" placeholder="Masukkan mata pelajaran" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="nip">NIP</label>
        <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <input type="text" id="kelas" name="kelas" placeholder="Contoh: Kelas 1A" required class="text-input">
      </div>
<div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
    <a href="{{ route('admin.data_guru') }}" class="btn btn-danger">Batal</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>

    </form>
  </div>
</div>
@endsection