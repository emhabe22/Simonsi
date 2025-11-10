@extends('admin.layout.main')

@section('title', 'Data Siswa - EDUTRACK')

@section('content')

<div class="content">
  <h2 class="page-title">Data Siswa</h2>
  <div class="card p-4 shadow-sm">

    {{-- Tombol tambah siswa --}}
    <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
      <a href="{{ route('admin.tambah_siswa') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Siswa
      </a>
    </div>

    {{-- Tabel data siswa --}}
    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#3498db !important; color:#fff !important;">
        <tr>
          <th style="padding:10px;">No</th>
          <th style="padding:7px;">Nama</th>
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
          <td style="padding:7px;">{{ $siswa->name }}</td>
          <td style="padding:10px;">{{ $siswa->nisn }}</td>
          <td style="padding:10px;">
            {{ $siswa->kelas ? $siswa->kelas->class . ' ' . $siswa->kelas->subclass : '-' }}
          </td>
          <td style="padding:10px;">{{ $siswa->address }}</td>
          <td style="padding:10px;">{{ \Carbon\Carbon::parse($siswa->date_of_birth)->format('d-m-Y') }}</td>
          <td style="padding:10px;">
            {{ $siswa->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
          </td>

          {{-- Tombol Edit dan Hapus dengan SweetAlert --}}
          <td style="padding:20px;">
            <div class="d-flex justify-content-center gap-2">
              <a href="{{ route('admin.edit_siswa', $siswa->id) }}" class="btn btn-primary btn-sm d-flex align-items-center">
                <i class="fa fa-pen"></i> <span>Edit</span>
              </a>

              <form id="delete-form-{{ $siswa->id }}" action="{{ route('admin.hapus_siswa', $siswa->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" onclick="confirmDelete({{ $siswa->id }})">
                  <i class="fa fa-trash"></i> <span>Hapus</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Include SweetAlert --}}
@include('admin.components.sweetalert')

@endsection
