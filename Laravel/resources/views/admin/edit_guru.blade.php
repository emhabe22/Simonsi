@extends('admin.layout.main')

@section('title', 'Edit Guru - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Guru</h2>
  <div class="card p-4 shadow-sm">

    <form action="{{ route('admin.update_guru', $guru->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-2">
        <label for="nama">Nama Guru</label>
        <input type="text" id="nama" name="name" value="{{ old('name', $guru->name) }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="lahir">Tanggal Lahir</label>
        <input type="date" id="lahir" name="date_of_birth" value="{{ old('date_of_birth', $guru->date_of_birth) }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="address">Alamat</label>
        <textarea id="address" name="address" rows="2" required class="form-control">{{ old('address', $guru->address) }}</textarea>
      </div>

      <div class="form-group mb-2">
        <label for="nip">NIP</label>
        <input type="text" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="mapel">Mata Pelajaran</label>
        <select id="mapel" name="mapel_id" class="form-control" required>
          <option value="">-- Pilih Mata Pelajaran --</option>
          @foreach($mapelList as $mapel)
            <option value="{{ $mapel->id }}" {{ $guru->mapel_id == $mapel->id ? 'selected' : '' }}>
                {{ $mapel->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <select id="kelas" name="kelas_id" class="form-control" required>
          <option value="">-- Pilih Kelas --</option>
          @foreach($kelasList as $kelas)
            <option value="{{ $kelas->id }}" {{ $guru->kelas_id == $kelas->id ? 'selected' : '' }}>
                {{ $kelas->class }} {{ $kelas->subclass }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="gender">Jenis Kelamin</label>
        <select id="gender" name="gender" class="form-control" required>
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="male" {{ $guru->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
          <option value="female" {{ $guru->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_guru') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>

  </div>
</div>
@endsection
