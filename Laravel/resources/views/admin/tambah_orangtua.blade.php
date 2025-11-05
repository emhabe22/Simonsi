@extends('admin.layout.main')

@section('title', 'Tambah Orang Tua - EDUTRACK')

@section('content')
<div class="content">
  <h2>Tambah Data Orang Tua</h2>
  <div class="card">

    <form action="#" method="POST">
      @csrf

      <div class="form-group mb-2">
        <label for="nama">Nama Orang Tua</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama orang tua" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="no">Nomor Telepon</label>
        <input type="text" id="no" name="no" placeholder="Masukkan nomor telepon" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat" required class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="jk">Jenis Kelamin</label>
        <select class="select" id="jk" name="jk" required class="text-input">
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="anak">Nama Anak</label>
        <input type="text" id="anak" name="anak" placeholder="Masukkan nama anak" required class="text-input">
      </div>
<div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
    <a href="{{ route('admin.data_orangtua') }}" class="btn btn-danger">Batal</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>

    </form>
  </div>
</div>
@endsection