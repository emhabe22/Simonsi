@extends('admin.layout.main')

@section('title', 'Edit Mata Pelajaran - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Mata Pelajaran</h2>
  <div class="card">

    <form action="{{ route('admin.update_mapel', $mapel->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-2">
        <label for="mapel">Pilih Mata Pelajaran</label>
        <select class="select" id="mapel" name="mapel">
          <option value="">-- Pilih Mata Pelajaran --</option>
          <option value="Matematika" {{ $mapel->mapel == 'Matematika' ? 'selected' : '' }}>Matematika</option>
          <option value="Bahasa Indonesia" {{ $mapel->mapel == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
          <option value="Bahasa Inggris" {{ $mapel->mapel == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="kelas">Jenjang Kelas</label>
        <select class="select" id="kelas" name="kelas">
          <option value="">-- Pilih Kelas --</option>
          <option value="Kelas 1" {{ $mapel->kelas == 'Kelas 1' ? 'selected' : '' }}>Kelas 1</option>
          <option value="Kelas 2" {{ $mapel->kelas == 'Kelas 2' ? 'selected' : '' }}>Kelas 2</option>
          <option value="Kelas 3" {{ $mapel->kelas == 'Kelas 3' ? 'selected' : '' }}>Kelas 3</option>
          <option value="Kelas 4" {{ $mapel->kelas == 'Kelas 4' ? 'selected' : '' }}>Kelas 4</option>
          <option value="Kelas 5" {{ $mapel->kelas == 'Kelas 5' ? 'selected' : '' }}>Kelas 5</option>
          <option value="Kelas 6" {{ $mapel->kelas == 'Kelas 6' ? 'selected' : '' }}>Kelas 6</option>
        </select>
      </div>

      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_mapel') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>

    </form>
  </div>
</div>
@endsection
