@extends('admin.layout.main')

@section('title', 'Edit Mata Pelajaran - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Mata Pelajaran</h2>
  <div class="card p-4">

    <form action="{{ route('admin.update_mapel', $mapel->id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Dropdown Mata Pelajaran --}}
      @php
        $mapelOptions = ['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS', 'PPKN', 'Agama', 'PJOK', 'Seni Budaya'];
      @endphp
      <div class="form-group mb-3">
        <label for="mapel" style="display:block; margin-bottom: 6px;">Nama Mata Pelajaran</label>
        <select class="form-control" name="mapel" id="mapel" required>
          <option value="">-- Pilih Mapel --</option>
          @foreach($mapelOptions as $option)
            <option value="{{ $option }}" {{ $mapel->name == $option ? 'selected' : '' }}>{{ $option }}</option>
          @endforeach
        </select>
      </div>

      {{-- Dropdown Kelas --}}
      <div class="form-group mb-3">
        <label for="kelas_id" style="display:block; margin-bottom: 6px;">Pilih Jenjang Kelas</label>
        <select class="form-control" id="kelas_id" name="kelas_id" required>
          <option value="">-- Pilih Kelas --</option>
          @foreach ($kelasList as $kelas)
            <option value="{{ $kelas->id }}" {{ $mapel->kelas_id == $kelas->id ? 'selected' : '' }}>
              Kelas {{ $kelas->class }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Tombol aksi --}}
      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_mapel') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>

    </form>
  </div>
</div>
@endsection
