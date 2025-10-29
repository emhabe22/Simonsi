@extends('admin.layout.main')

@section('title', 'Data Guru - EDUTRACK')

@section('content')
<div class="content">
      <h2 class="page-title">Data Guru</h2>

  <div class="card p-4 shadow-sm">

<div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
  <a href="{{route('admin.tambah_guru')}}" class="btn btn-success">
    <i class="fa fa-plus"></i> Tambah Guru
  </a>
</div>


    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#f1f5f9;">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:10px;">Nama Guru</th>
          <th style="padding:10px;">Mata Pelajaran</th>
          <th style="padding:10px;">NIP</th>
          <th style="padding:10px;">Kelas</th>
          <th style="padding:10px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($guruList as $index => $guru)
        <tr>
          <td style="padding:10px;">{{ $index + 1 }}</td>
          <td style="padding:10px;">{{ $guru->nama }}</td>
          <td style="padding:10px;">{{ $guru->mapel }}</td>
          <td style="padding:10px;">{{ $guru->nip }}</td>
          <td style="padding:10px;">{{ $guru->kelas }}</td>
          <td style="padding:10px;">
            <!-- Tombol aksi dummy -->
            <a href="#" class="btn btn-primary btn-sm ms-2">
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
