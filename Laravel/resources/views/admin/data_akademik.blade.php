@extends('admin.layout.main')

@section('title', 'Data Tahun Akademik - EDUTRACK')

@section('content')
<div class="content">
  <h2 class="page-title">Data Tahun Akademik</h2>
  <div class="card p-4 shadow-sm">

    {{-- Tombol Tambah --}}
    <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
      <a href="{{ route('admin.tambah_akademik') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Tahun Akademik
      </a>
    </div>

    {{-- Tabel Data Tahun Akademik --}}
    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db; color:white;">
        <tr>
          <th style="padding:10px; width:50px;">No</th>
          <th style="padding:10px;">Tahun Akademik</th>
          <th style="padding:10px; width:200px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tahunList as $index => $tahun)
        <tr>
          <td style="padding:10px;">{{ $index + 1 }}</td>
          <td style="padding:10px;">{{ $tahun->id_tahun }}</td>
          <td style="padding:10px; ;">
  

            {{-- Tombol Hapus --}}
            <form id="delete-form-{{ $tahun->id }}" 
                  action="{{ route('admin.hapus_akademik', $tahun->id) }}" 
                  method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="button" 
                      class="btn btn-danger btn-sm ms-2" 
                      onclick="confirmDelete({{ $tahun->id }})">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" style="text-align:center; padding:20px;">Belum ada data tahun akademik.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Include SweetAlert --}}
@include('admin.components.sweetalert')

@endsection
