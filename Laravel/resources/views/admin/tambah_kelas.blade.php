@extends('admin.layout.main')

@section('title', 'Tambah Kelas - EDUTRACK')

@section('content')
<div class="content">
  <h2 class="page-title">Tambah Data Kelas</h2>

  <div class="card p-4 shadow-sm">
    {{-- Form Tambah Kelas --}}
    <form action="{{ route('admin.simpan_kelas') }}" method="POST">
      @csrf

      <p class="mb-3">Pilih jenjang kelas dan subclass yang tersedia di bawah ini.</p>

      {{-- Pilihan Kelas --}}
      <div class="form-group mb-3">
        <label for="kelas" class="form-label fw-bold">Kelas</label>
        <select class="form-select" id="kelas" name="kelas" required>
          <option value="">-- Pilih Kelas --</option>
          <option value="1">Kelas 1</option>
          <option value="2">Kelas 2</option>
          <option value="3">Kelas 3</option>
          <option value="4">Kelas 4</option>
          <option value="5">Kelas 5</option>
          <option value="6">Kelas 6</option>
        </select>

        @error('kelas')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      {{-- Checkbox Subclass --}}
      <div class="form-group mb-3">
        <label class="form-label fw-bold">Subclass</label>
        <div class="d-flex flex-wrap gap-3">
          <label><input type="checkbox" name="tipe[]" value="A"> A</label>
          <label><input type="checkbox" name="tipe[]" value="B"> B</label>
          <label><input type="checkbox" name="tipe[]" value="C"> C</label>
          <label><input type="checkbox" name="tipe[]" value="D"> D</label>
          <label><input type="checkbox" name="tipe[]" value="E"> E</label>
        </div>

        @error('tipe')
          <small class="text-danger d-block">{{ $message }}</small>
        @enderror
      </div>

      {{-- Tombol --}}
      <div class="form-buttons mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.data_kelas') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
