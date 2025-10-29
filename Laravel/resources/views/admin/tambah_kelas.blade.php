@extends('admin.layout.main')

@section('title', 'Tambah Kelas - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Kelas</h2>
  <div class="card">

    <form action="#" method="POST">
      @csrf
<p>Pilih jenjang kelas dan tipe kelas yang tersedia di bawah ini.</p>

            <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
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
        <!-- Checkbox Tipe Kelas -->
            <div class="form-group">
                <label>Subclass</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="tipe[]" value="A"> A</label>
                    <label><input type="checkbox" name="tipe[]" value="B"> B</label>
                    <label><input type="checkbox" name="tipe[]" value="C"> C</label>
                    <label><input type="checkbox" name="tipe[]" value="D"> D</label>
                    <label><input type="checkbox" name="tipe[]" value="E"> E</label>
                </div>
            </div>

      

<div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
    <a href="{{ route('admin.data_kelas') }}" class="btn btn-danger">Batal</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>

    </form>
  </div>
</div>
@endsection