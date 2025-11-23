@extends('admin.layout.main')

@section('title', 'Tambah Orang Tua - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Orang Tua</h2>
  <div class="card p-4 shadow-sm">

    {{-- Notifikasi sukses --}}
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
    <form action="{{ route('admin.simpan_orangtua') }}" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="name">Nama Orang Tua</label>
        <input type="text" id="name" name="name" class="form-control" required placeholder="Masukkan nama orang tua">
      </div>

      <div class="form-group mb-2">
        <label for="phone">Nomor Telepon</label>
        <input type="text" id="phone" name="phone" class="form-control" required placeholder="Masukkan nomor telepon">
      </div>

      <div class="form-group mb-2">
        <label for="lahir">Tanggal Lahir</label>
        <input type="date" id="lahir" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="form-control">
    </div>

      <div class="form-group mb-2">
        <label for="address">Alamat</label>
        <textarea id="address" name="address" class="form-control" required placeholder="Masukkan alamat"></textarea>
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
        <label for="siswa_id">Nama Anak</label>
        <select id="siswa_id" name="siswa_id" class="form-control" required>
          <option value="">-- Pilih Anak --</option>
          @foreach($siswaList as $siswa)
              <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group mb-2">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control" required placeholder="Masukkan Email">

<div class="form-group mb-2">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan Password">
</div>


      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
          <a href="{{ route('admin.data_orangtua') }}" class="btn btn-danger">Batal</a>
          <button type="submit" class="btn btn-success">Simpan</button>
      </div>

    </form>
  </div>
</div>
@endsection
