@extends('admin.layout.main')

@section('title', 'Data Orang Tua - EDUTRACK')

@section('content')
<div class="content">
  <h2 class="page-title">Data Orang Tua</h2>
  <div class="card p-4 shadow-sm">
    

<div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
  <a href="{{route('admin.tambah_orangtua')}}" class="btn btn-success">
    <i class="fa fa-plus"></i> Tambah Orang Tua
  </a>
</div>


    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db;color:#000; ">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:10px;">Nama</th>
          <th style="padding:10px;">No Telp</th>
          <th style="padding:10px;">Alamat</th>
          <th style="padding:10px;">Jenis Kelamin</th>
         <th style="padding:10px;">Nama Anak</th>
          <th style="padding:10px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ortuList as $index => $ortu)
        <tr>
          <td style="padding:10px;">{{ $index + 1 }}</td>
          <td style="padding:10px;">{{ $ortu->nama }}</td>
          <td style="padding:10px;">{{ $ortu->telp }}</td>
          <td style="padding:10px;">{{ $ortu->alamat }}</td>
          <td style="padding:10px;">{{ $ortu->jk }}</td>
          <td style="padding:10px;">{{ $ortu->namaanak }}</td>
          <td style="padding:10px;">
            <!-- Tombol aksi dummy -->
            <a href="{{ route('admin.edit_orangtua', $ortu->id) }}" class="btn btn-primary btn-sm ms-2">
              <i class="fa fa-pen"></i> Edit
            </a>
            <a href="#" class="btn btn-danger btn-sm ms-2" >
              <i class="fa fa-trash"></i> Hapus
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
