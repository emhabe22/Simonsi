@extends('admin.layout.main')

@section('title', 'Tambah Siswa - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Siswa</h2>
  <div class="card">

    <form action="#" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="nama">Nama Siswa</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama siswa" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="nis">NIS</label>
        <input type="text" id="nis" name="nis" placeholder="Masukkan NIS siswa" required class="text-input">
      </div>

            <div class="form-group mb-2">
        <label for="kelas">Kelas</label>
        <select class="select" id="kelas" name="kelas">
          <option value="">-- Pilih Kelas --</option>
          <option value="1B">1B</option>
          <option value="2A">2A</option>
        </select>
      </div>
      <div class="form-group mb-2">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat siswa" required class="text-input">
      </div>
            <div class="form-group mb-2">
        <label for="lahir">Tanggal Lahir</label>
        <input type="text" id="lahir" name="lahir" placeholder="Masukkan tanggal lahir siswa" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="jk">Jenis Kelamin</label>
        <select class="select" id="jk" name="jk">
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

<div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
    <a href="{{ route('admin.data_siswa') }}" class="btn btn-danger">Batal</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>

    </form>
  </div>
</div>
@endsection