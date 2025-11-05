@extends('admin.layout.main')

@section('title', 'Edit Orang Tua - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Orang Tua</h2>
  <div class="card">

    <form action="{{ route('admin.update_orangtua', $orangtua->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-2">
        <label for="nama">Nama Orang Tua</label>
        <input 
          type="text" 
          id="nama" 
          name="nama" 
          value="{{ old('nama', $orangtua->nama) }}" 
          placeholder="Masukkan nama orang tua" 
          required 
          class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="telp">Nomor Telepon</label>
        <input 
          type="text" 
          id="telp" 
          name="telp" 
          value="{{ old('telp', $orangtua->telp) }}" 
          placeholder="Masukkan nomor telepon" 
          required 
          class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="alamat">Alamat</label>
        <input 
          type="text" 
          id="alamat" 
          name="alamat" 
          value="{{ old('alamat', $orangtua->alamat) }}" 
          placeholder="Masukkan alamat" 
          required 
          class="text-input">
      </div>

      <div class="form-group mb-2">
        <label for="jk">Jenis Kelamin</label>
        <select id="jk" name="jk" required class="select">
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki" {{ old('jk', $orangtua->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ old('jk', $orangtua->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="form-group mb-2">
        <label for="namaanak">Nama Anak</label>
        <input 
          type="text" 
          id="namaanak" 
          name="namaanak" 
          value="{{ old('namaanak', $orangtua->namaanak) }}" 
          placeholder="Masukkan nama anak" 
          required 
          class="text-input">
      </div>

      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('admin.data_orangtua') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>

    </form>
  </div>
</div>
@endsection
