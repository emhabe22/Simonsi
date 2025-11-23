@extends('admin.layout.main')

@section('title', 'Tambah Guru - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Guru</h2>
  <div class="card p-4 shadow-sm">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.simpan_guru') }}" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="nama">Nama Guru</label>
        <input type="text" id="nama" name="name" placeholder="Masukkan nama guru" value="{{ old('name') }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="lahir">Tanggal Lahir</label>
        <input type="date" id="lahir" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="address">Alamat</label>
        <textarea id="address" name="address" rows="2" placeholder="Masukkan alamat guru" required class="form-control">{{ old('address') }}</textarea>
      </div>

      <div class="form-group mb-2">
        <label for="nip">NIP</label>
        <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}" required class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="mapel">Mata Pelajaran</label>
        <select id="mapel" name="mapel_id" class="form-control" required>
          <option value="">-- Pilih Mata Pelajaran --</option>
          @foreach($mapelList as $mapel)
            <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <select id="kelas" name="kelas_id" class="form-control" required>
          <option value="">-- Pilih Kelas --</option>
          @foreach($kelasList as $kelas)
            <option value="{{ $kelas->id }}">{{ $kelas->class }} {{ $kelas->subclass }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="gender">Jenis Kelamin</label>
        <select id="gender" name="gender" class="form-control" required>
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="male">Laki-laki</option>
          <option value="female">Perempuan</option>
        </select>
      </div>
      <div class="form-group mb-2">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control" required placeholder="Masukkan Email">
</div>

<div class="form-group mb-2">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan Password">
</div>


      <div class="form-buttons mt-3 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.data_guru') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
