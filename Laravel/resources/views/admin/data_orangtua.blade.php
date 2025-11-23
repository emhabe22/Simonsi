@extends('admin.layout.main')

@section('title', 'Data Orang Tua - EDUTRACK')

@section('content')

<div class="content">
  <h2 class="page-title">Data Orang Tua</h2>
  <div class="card p-4 shadow-sm">

    {{-- Tombol tambah --}}
    <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
      <a href="{{ route('admin.tambah_orangtua') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Orang Tua
      </a>
    </div>

    {{-- Tabel Data --}}
    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db; color:#000;">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:10px;">Nama</th>
          <th style="padding:10px;">No Telp</th>
          <th style="padding:10px;">Tanggal Lahir</th>
          <th style="padding:10px;">Alamat</th>
          <th style="padding:10px;">Jenis Kelamin</th>
          <th style="padding:10px;">Nama Anak</th>
          <th style="padding:10px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($ortuList as $index => $ortu)
          <tr>
            <td style="padding:10px;">{{ $index + 1 }}</td>
            <td style="padding:10px;">{{ $ortu->name }}</td>
            <td style="padding:10px;">{{ $ortu->phone }}</td>
            <td style="padding:10px;">{{ \Carbon\Carbon::parse($ortu->date_of_birth)->format('d-m-Y') }}</td>
            <td style="padding:10px;">{{ $ortu->address }}</td>
            <td style="padding:10px;">
              {{ $ortu->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
            </td>
            <td style="padding:10px;">{{ $ortu->siswa->name ?? '-' }}</td>
            <td style="padding:20px;">
              <div class="d-flex justify-content-center gap-2">

                {{-- Tombol Edit --}}
                <a href="{{ route('admin.edit_orangtua', $ortu->id) }}" 
                   class="btn btn-primary btn-sm d-flex align-items-center">
                  <i class="fa fa-pen"></i>
                  <span class="ms-1">Edit</span>
                </a>

                {{-- Tombol Hapus dengan SweetAlert --}}
                <form id="delete-form-{{ $ortu->id }}" 
                      action="{{ route('admin.hapus_orangtua', $ortu->id) }}" 
                      method="POST" 
                      style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="button" 
                          class="btn btn-danger btn-sm d-flex align-items-center" 
                          onclick="confirmDelete({{ $ortu->id }})">
                    <i class="fa fa-trash"></i>
                    <span class="ms-1">Hapus</span>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center">Belum ada data orang tua</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Include SweetAlert --}}
@include('admin.components.sweetalert')

@endsection
