@extends('admin.layout.main')

@section('title', 'Edit Kelas - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Kelas</h2>
  <div class="card">

    <form action="{{ route('admin.update_kelas', $kelas->id) }}" method="POST">
      @csrf
      @method('PUT')

      <p>Perbarui jenjang kelas dan tipe kelas di bawah ini.</p>

      <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <select class="select" id="kelas" name="kelas" required>
          <option value="">-- Pilih Kelas --</option>
          <option value="Kelas 1" {{ $kelas->kelas == 'Kelas 1' ? 'selected' : '' }}>Kelas 1</option>
          <option value="Kelas 2" {{ $kelas->kelas == 'Kelas 2' ? 'selected' : '' }}>Kelas 2</option>
          <option value="Kelas 3" {{ $kelas->kelas == 'Kelas 3' ? 'selected' : '' }}>Kelas 3</option>
          <option value="Kelas 4" {{ $kelas->kelas == 'Kelas 4' ? 'selected' : '' }}>Kelas 4</option>
          <option value="Kelas 5" {{ $kelas->kelas == 'Kelas 5' ? 'selected' : '' }}>Kelas 5</option>
          <option value="Kelas 6" {{ $kelas->kelas == 'Kelas 6' ? 'selected' : '' }}>Kelas 6</option>
        </select>
      </div>

      <!-- Checkbox Tipe Kelas -->
      <div class="form-group">
        <label>Subclass</label>
        <div class="checkbox-group">
          @php
            $selectedTipe = is_array($kelas->tipe) ? $kelas->tipe : explode(',', $kelas->tipe);
          @endphp
          <label><input type="checkbox" name="tipe[]" value="A" {{ in_array('A', $selectedTipe) ? 'checked' : '' }}> A</label>
          <label><input type="checkbox" name="tipe[]" value="B" {{ in_array('B', $selectedTipe) ? 'checked' : '' }}> B</label>
          <label><input type="checkbox" name="tipe[]" value="C" {{ in_array('C', $selectedTipe) ? 'checked' : '' }}> C</label>
          <label><input type="checkbox" name="tipe[]" value="D" {{ in_array('D', $selectedTipe) ? 'checked' : '' }}> D</label>
          <label><input type="checkbox" name="tipe[]" value="E" {{ in_array('E', $selectedTipe) ? 'checked' : '' }}> E</label>
        </div>
      </div>

      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_kelas') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>

    </form>
  </div>
</div>
@endsection
