@extends('guru.layout.main')

@section('title', 'Nilai Siswa - EDUTRACK')

@section('content')
<style>
  .nilai { font-family: 'Poppins', sans-serif; color: #222; }
  .nilai label { font-weight: 500; }
  .nilai .controls { display: flex; align-items: center; gap: 12px; margin-bottom: 6px; }
  .btn-action { display: inline-block; margin-right: 6px; }
</style>

<div class="content nilai">
  <h2 class="page-title">Nilai Siswa</h2>

  <!-- Filter Kelas -->
  <div class="card p-3 mb-3">
    <form method="GET" action="{{ route('guru.nilai') }}" class="controls">
      <label for="kelas_id" style="min-width:130px;">Kelas:</label>
      <select class="form-select" id="kelas_id" name="kelas_id" onchange="this.form.submit()">
        <option value="">Pilih Kelas Siswa</option>
        @foreach($kelas as $k)
          <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
            {{ $k->class }}{{ $k->subclass }}
          </option>
        @endforeach
      </select>
    </form>
  </div>

  <!-- Tabel Siswa -->
  <div class="table-wrapper">
    <table class="table table-bordered table-striped" style="width:100%;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Nama Orang Tua</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($siswa as $i => $s)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->ortu->name ?? '-' }}</td> {{-- Nama ortu dari tabel ortu --}}
            <td>
              <a href="{{ route('guru.cek_nilai', ['id' => $s->id]) }}" class="btn btn-sm btn-success btn-action">
                <i class="fas fa-eye"></i> Cek Nilai
              </a>
              <a href="{{ route('guru.input_nilai', ['siswa_id' => $s->id, 'kelas_id' => $s->kelas_id]) }}"
                 class="btn btn-sm btn-primary btn-action">
                <i class="fas fa-edit"></i> Input Nilai
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Pilih kelas untuk melihat siswa.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
