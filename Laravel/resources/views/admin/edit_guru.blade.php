@extends('admin.layout.main')

@section('title', 'Edit Guru - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Guru</h2>
  <div class="card">
<form action="{{ route('admin.update_guru', $guru->id) }}" method="POST">
    @csrf
    @method('PUT')


      <div class="form-group mb-2">
        <label for="nama">Nama Guru</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $guru->nama) }}" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="mapel">Mata Pelajaran</label>
        <input type="text" id="mapel" name="mapel" value="{{ old('mapel', $guru->mapel) }}" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="nip">NIP</label>
        <input type="text" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $guru->kelas) }}" required class="text-input">
      </div>

      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_guru') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>

    </form>
  </div>
</div>
@endsection
