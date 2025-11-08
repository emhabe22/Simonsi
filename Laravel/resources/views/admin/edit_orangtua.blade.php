@extends('admin.layout.main')

@section('title', 'Edit Orang Tua - EDUTRACK')

@section('content')
<div class="content">
  <h2>Edit Data Orang Tua</h2>
  <div class="card p-4 shadow-sm">

    <form action="{{ route('admin.update_orangtua', $orangtua->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-3">
        <label for="name">Nama Orang Tua</label>
        <input type="text" name="name" id="name" 
               class="form-control" 
               value="{{ old('name', $orangtua->name) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="phone">Nomor Telepon</label>
        <input type="text" name="phone" id="phone" 
               class="form-control" 
               value="{{ old('phone', $orangtua->phone) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="address">Alamat</label>
        <input type="text" name="address" id="address" 
               class="form-control" 
               value="{{ old('address', $orangtua->address) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="gender">Jenis Kelamin</label>
        <select name="gender" id="gender" class="form-control" required>
          <option value="">-- Pilih --</option>
          <option value="male" {{ old('gender', $orangtua->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
          <option value="female" {{ old('gender', $orangtua->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="siswa_id">Nama Anak</label>
        <select name="siswa_id" id="siswa_id" class="form-control" required>
          <option value="">-- Pilih Anak --</option>
          @foreach($siswaList as $siswa)
            <option value="{{ $siswa->id }}" {{ old('siswa_id', $orangtua->siswa_id) == $siswa->id ? 'selected' : '' }}>
              {{ $siswa->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="text-end">
        <a href="{{ route('admin.data_orangtua') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
