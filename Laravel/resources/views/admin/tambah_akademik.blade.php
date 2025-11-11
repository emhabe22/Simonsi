@extends('admin.layout.main')

@section('title', 'Tambah Tahun Akademik - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Tahun Akademik</h2>
  <div class="card">
    <form action="{{ route('admin.simpan_akademik') }}" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="akademik">Tahun Akademik</label>
        <input type="text" id="akademik" name="akademik" placeholder="Masukkan Tahun Akademik" required class="text-input">
      </div>

      <div class="form-buttons mt-3 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.data_akademik') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
