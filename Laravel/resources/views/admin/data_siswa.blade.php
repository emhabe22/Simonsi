@extends('admin.layout.main')

@section('title', 'Data Siswa - EDUTRACK')

@section('content')
<div class="content">
      <h2 class="page-title">Data Siswa</h2>
  <div class="card p-4 shadow-sm">

    <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
      <a href="{{route('admin.tambah_siswa')}}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Siswa
      </a>
    </div>

    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db !important; color:#fff !important;">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:10px;">Nama</th>
          <th style="padding:10px;">NIS</th>
          <th style="padding:10px;">Kelas</th>
          <th style="padding:10px;">Alamat</th>
          <th style="padding:10px;">Tanggal Lahir</th>
          <th style="padding:10px;">Jenis Kelamin</th>
          <th style="padding:10px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($siswaList as $index => $siswa)
        <tr>
          <td style="padding:10px;">{{ $index + 1 }}</td>
          <td style="padding:10px;">{{ $siswa->nama }}</td>
          <td style="padding:10px;">{{ $siswa->nis }}</td>
          <td style="padding:10px;">{{ $siswa->kelas }}</td>
          <td style="padding:10px;">{{ $siswa->alamat }}</td>
          <td style="padding:10px;">{{ $siswa->tgl_lahir }}</td>
          <td style="padding:10px;">{{ $siswa->jk }}</td>
          <td style="padding:10px;">
            <a href="#" class="btn btn-primary btn-sm ms-2">
              <i class="fa fa-pen"></i> Edit
            </a>
            <a href="#" class="btn btn-danger btn-sm ms-2">
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
