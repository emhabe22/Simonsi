@extends('admin.layout.main')

@section('title', 'Data Tahun Akademik - EDUTRACK')

@section('content')
<div class="content">
      <h2 class="page-title"">Data Tahun Akademik</h2>
  <div class="card p-4 shadow-sm">

    <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
      <a href="{{route('admin.tambah_akademik')}}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Tahun Akademik
      </a>
    </div>

    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db;">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:10px;">Tahun Akademik</th>
          <th style="padding:10px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tahunList as $index => $tahun)
        <tr>
          <td style="padding:10px;">{{ $index + 1 }}</td>
          <td style="padding:10px;">{{ $tahun->tahun }}</td>
          <td style="padding:10px;">
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
