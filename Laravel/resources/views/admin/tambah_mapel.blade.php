@extends('admin.layout.main') 
 
@section('title', 'Tambah Mata Pelajaran - EDUTRACK') 
 
@section('content') 
<div class="content"> 
  <h2>Tambah Data Mata Pelajaran</h2> 
  <div class="card"> 
 
    <form action="{{ route('admin.simpan_mapel') }}" method="POST"> 
      @csrf 
 
      <div class="form-group mb-2"> 
        <label for="mapel" style="display:block; margin-bottom: 6px;">Nama Mata Pelajaran</label> 
        <select  
          class="form-control"  
          id="mapel"  
          name="mapel"  
          required> 
          <option value="">-- Pilih Mapel --</option>
          <option value="Matematika">Matematika</option>
          <option value="Bahasa Indonesia">Bahasa Indonesia</option>
          <option value="Bahasa Inggris">Bahasa Inggris</option>
          <option value="IPA">IPA</option>
          <option value="IPS">IPS</option>
          <option value="PPKN">PPKN</option>
          <option value="Agama">Agama</option>
          <option value="PJOK">PJOK</option>
          <option value="Seni Budaya">Seni Budaya</option>
        </select> 
      </div> 
 
      <div class="form-group mb-2"> 
        <label for="kelas_id" style="display:block; margin-bottom: 6px;">Pilih Jenjang Kelas</label> 
        <select class="form-control" id="kelas_id" name="kelas_id" required> 
          <option value="">-- Pilih Kelas --</option> 
          @foreach ($kelasList as $kelas) 
            <option value="{{ $kelas->id }}"> 
              Kelas {{ $kelas->class }} 
            </option> 
          @endforeach 
        </select> 
      </div> 
 
      <div class="form-buttons mt-3" style="display: flex; justify-content: flex-end; gap: 10px;"> 
        <a href="{{ route('admin.data_mapel') }}" class="btn btn-danger">Batal</a> 
        <button type="submit" class="btn btn-success">Simpan</button> 
      </div> 
 
    </form> 
  </div> 
</div> 
@endsection