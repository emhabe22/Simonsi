@extends('admin.layout.main')

@section('title', 'Tambah Mata Pelajaran - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Mata Pelajaran</h2>
  <div class="card">

    <form action="#" method="POST">
      @csrf
<div class="form-group mb-2">
    <label for="mapel">Pilih Mata Pelajaran</label>
    <select class="select" id="mapel" name="mapel">
        <option value="">-- Pilih Mata Pelajaran --</option>
        <option value="Matematika">Matematika</option>
        <option value="Bahasa Indonesia">Bahasa Indonesia</option>
        <option value="Bahasa Inggris">Bahasa Inggris</option>
    </select>
</div>

            <div class="form-group mb-2">
        <label for="kelas">Jenjang Kelas</label>
        <select class="select" id="kelas" name="kelas">
          <option value="">-- Pilih Kelas --</option>
          <option value="Kelas 1">Kelas 1</option>
          <option value="Kelas 2">Kelas 2</option>
          <option value="Kelas 3">Kelas 3</option>
          <option value="Kelas 4">Kelas 4</option>
          <option value="Kelas 5">Kelas 5</option>
          <option value="Kelas 6 ">Kelas 6</option>
        </select>
      </div>

<div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
    <a href="{{ route('admin.data_mapel') }}" class="btn btn-danger">Batal</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>

    </form>
  </div>
</div>
@endsection