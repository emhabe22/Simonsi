@extends('admin.layout.main')

@section('title', 'Tambah Siswa - EDUTRACK')

@section('content')
<div class="content">
  <h2 class="page-title">Tambah Data Siswa</h2>
  <div class="card p-4 shadow-sm">

    {{-- Notifikasi sukses --}}
    @if(session('success'))
      <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    {{-- Notifikasi error --}}
    @if($errors->any())
      <div class="alert alert-danger mb-3">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.simpan_siswa') }}" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="nama">Nama Siswa</label>
        <input type="text" id="nama" name="name" value="{{ old('name') }}" placeholder="Masukkan nama siswa" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="nisn">NISN</label>
        <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN siswa" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <select name="kelas_id" id="kelas" required class="form-select">
          <option value="">-- Pilih Kelas --</option>
          @foreach($kelasList as $kelas)
            <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
              {{ $kelas->class }} {{ $kelas->subclass }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="address" value="{{ old('address') }}" placeholder="Masukkan alamat siswa" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="lahir">Tanggal Lahir</label>
        <input type="date" id="lahir" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="jk">Jenis Kelamin</label>
        <select name="gender" id="jk" required class="form-select">
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="form-buttons mt-3 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.data_siswa') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>

  </div>
</div>
@endsection
