@extends('admin.layout.main')

@section('title', 'Data Mata Pelajaran - EDUTRACK')

@section('content')
<div class="content">
    <h2 class="page-title">Data Mata Pelajaran</h2>

    <div class="card p-4 shadow-sm">

        <div class="add-btn-container mb-3" style="display:flex; justify-content:flex-end; width:100%;">
            <a href="{{ route('admin.tambah_mapel') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Tambah Mata Pelajaran
            </a>
        </div>

        <table class="biodata-table table table-bordered table-striped" style="width:100%;">
            <thead style="background-color:#f1f5f9;">
                <tr>
                    <th style="padding:10px;">No</th>
                    <th style="padding:10px;">Mata Pelajaran</th>
                    <th style="padding:10px;">Jenjang Kelas</th>
                    <th style="padding:10px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mapelList as $index => $mapel)
                    <tr>
                        <td style="padding:10px;">{{ $index + 1 }}</td>
                        <td style="padding:10px;">{{ $mapel->name }}</td>
                        <td style="padding:10px;">
                            {{ $mapel->kelas ? 'Kelas ' . $mapel->kelas->class : '-' }}
                        </td>
                        <td style="padding:10px;">
                            <a href="{{ route('admin.edit_mapel', $mapel->id) }}" class="btn btn-primary btn-sm ms-2">
                                <i class="fa fa-pen"></i> Edit
                            </a>

                            <form id="delete-form-{{ $mapel->id }}"
                                  action="{{ route('admin.hapus_mapel', $mapel->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn btn-danger btn-sm ms-2"
                                        onclick="confirmDelete({{ $mapel->id }})">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
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
