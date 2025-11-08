@extends('admin.layout.main')

@section('title', 'Data Kelas - EDUTRACK')

@section('content')
<div class="content">
  <h2 class="page-title">Data Kelas</h2>
  <div class="card p-4 shadow-sm">

    {{-- Tombol Tambah --}}
    <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
      <a href="{{ route('admin.tambah_kelas') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Kelas
      </a>
    </div>

    {{-- Tabel Data Kelas --}}
    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db; color:white;">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:10px;">Kelas</th>
          <th style="padding:10px;">Subclass</th>
          <th style="padding:10px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kelasList as $index => $kelas)
        <tr>
          <td style="padding:10px;">{{ $index + 1 }}</td>
          <td style="padding:10px;">{{ $kelas->class }}</td>
          <td style="padding:10px;">{{ $kelas->subclass }}</td>
          <td style="padding:10px;">

            {{-- Tombol Edit --}}
            <a href="{{ route('admin.edit_kelas', $kelas->id) }}" class="btn btn-primary btn-sm ms-2">
              <i class="fa fa-pen"></i> Edit
            </a>

            {{-- Tombol Hapus --}}
            <form id="delete-form-{{ $kelas->id }}" 
                  action="{{ route('admin.hapus_kelas', $kelas->id) }}" 
                  method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="button" 
                      class="btn btn-danger btn-sm ms-2" 
                      onclick="confirmDelete({{ $kelas->id }})">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" style="text-align:center; padding:20px;">Belum ada data kelas.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Include SweetAlert --}}
@include('admin.components.sweetalert')

@endsection
