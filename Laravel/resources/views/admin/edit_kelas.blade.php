@extends('admin.layout.main')

@section('title', 'Edit Kelas - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Kelas</h2>
  <div class="card p-4">

    <form action="{{ route('admin.update_kelas', $kelas->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-3">
        <label for="kelas">Kelas</label>
        <select id="kelas" name="kelas" class="form-control" required>
          <option value="">-- Pilih Kelas --</option>
          @for ($i = 1; $i <= 6; $i++)
            <option value="{{ $i }}" {{ $kelas->class == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
          @endfor
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="subclass">Subclass</label>
        <select id="subclass" name="subclass" class="form-control" required>
          @foreach(['A','B','C','D','E'] as $sub)
            <option value="{{ $sub }}" {{ $kelas->subclass == $sub ? 'selected' : '' }}>{{ $sub }}</option>
          @endforeach
        </select>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_kelas') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>

  </div>
</div>
@endsection
