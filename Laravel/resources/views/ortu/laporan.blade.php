@extends('ortu.layout.main')

@section('title', 'Laporan Akademik - EDUTRACK')

@section('content')
<div class="laporan">
  <h2 class="page-title">Laporan Akademik</h2>

  <!-- Form Filter -->
  <div class="card shadow p-4 mb-3">
    <p><b>LAPORAN AKADEMIK SISWA</b></p>

    <form method="GET" action="{{ route('ortu.laporan') }}">
      <div style="display:flex; flex-direction:column; gap:12px; width:100%;">

        <div style="display:flex; align-items:center; gap:12px;">
          <label for="tahun" style="min-width:140px;">Tahun Akademik :</label>
          <select class="select" id="tahun" name="tahun_akademik_id">
            <option value="">-- Pilih Tahun Akademik --</option>
            @foreach($tahunList as $t)
              <option value="{{ $t->id }}" {{ request('tahun_akademik_id') == $t->id ? 'selected' : '' }}>
                {{ $t->id_tahun }}
              </option>
            @endforeach
          </select>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <label for="semester" style="min-width:140px;">Semester :</label>
          <select class="select" id="semester" name="semester_id">
            <option value="">-- Pilih Semester --</option>
            @foreach($semesterList as $s)
              <option value="{{ $s->id }}" {{ request('semester_id') == $s->id ? 'selected' : '' }}>
                {{ ucfirst($s->semester) }}
              </option>
            @endforeach
          </select>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:12px;">
          <button type="submit" class="btn btn-success">Tampilkan</button>
        </div>

      </div>
    </form>
  </div>

  <!-- Tabel Nilai -->
  @if(request('tahun_akademik_id') && request('semester_id'))
  <div id="tabelNilai" class="card shadow p-4" style="margin-top:20px;">
    <h4><b>Hasil Nilai</b></h4>

    <p>
      Nama: <b>{{ $siswa->name }}</b> |
      Kelas: <b>{{ $siswa->kelas->class }}{{ $siswa->kelas->subclass }}</b>
    </p>

    <table class="table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#0d6efd; color:white;">
        <tr>
          <th>No</th>
          <th>Mata Pelajaran</th>
          <th>Nilai Rata-rata</th>
          <th>Grade</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($nilai as $i => $n)
          @php
            $avg = round(($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6);
            $grade = $avg >= 90 ? 'A' : ($avg >= 80 ? 'B' : 'C');
          @endphp

          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $n->mapel->name }}</td>
            <td>{{ $avg }}</td>
            <td>{{ $grade }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-danger fw-bold py-3">
              Belum ada nilai untuk filter tersebut.
            </td>
          </tr>
        @endforelse
      </tbody>

    </table>
              <div class="text-end mt-3">
      <a href="{{ route('ortu.laporan.pdf', ['tahun_akademik_id' => request('tahun_akademik_id'), 'semester_id' => request('semester_id')]) }}"
         class="btn btn-primary" target="_blank">Cetak PDF</a>
    </div>
  </div>
  @endif

</div>
@endsection
