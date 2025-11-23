@extends('admin.layout.main')
@section('title', 'Cek Nilai Siswa - EDUTRACK')

@section('content')
<style>
  .cek-nilai table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 6px rgba(0,0,0,0.08);
  }

  .cek-nilai th,
  .cek-nilai td {
    padding: 10px 14px;
    text-align: center;
    border: 1px solid #ccc;
  }

  .cek-nilai th {
    background-color: #f8f8f8;
    font-weight: 600;
  }

  .card-footer-right {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
  }
</style>

<div class="cek-nilai">
  <h2 class="page-title">Cek Nilai Siswa</h2>

  <!-- Biodata Siswa -->
  <div class="card p-3">

    <p><strong>Nama Siswa :</strong> <strong>{{ $siswa->name }}</strong></p>

    <p><strong>Kelas :</strong>
      <strong>{{ $siswa->kelas->class }}{{ $siswa->kelas->subclass }}</strong>
    </p>

    @if($nilai->first())
      <p><strong>Semester :</strong>
        <strong>{{ ucfirst($nilai->first()->semester->semester) }}</strong>
      </p>

      <p><strong>Tahun Akademik :</strong>
        <strong>{{ $nilai->first()->tahunAkademik->id_tahun }}</strong>
      </p>
    @else
      <p><strong>Semester :</strong> <strong>-</strong></p>
      <p><strong>Tahun Akademik :</strong> <strong>-</strong></p>
    @endif

    <!-- Tombol kembali di kanan bawah card -->
    <div class="card-footer-right">
      <a href="{{ route('admin.nilai') }}" class="btn btn-danger">
        Kembali
      </a>
    </div>

  </div>

  <!-- Tabel Nilai -->
  <div class="card mt-4">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Nilai</th>
        </tr>
      </thead>

      <tbody>
        @forelse($nilai as $i => $n)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $n->mapel->name }}</td>
          <td>{{ round(($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6) }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center text-danger py-3">
            Belum ada nilai untuk siswa ini.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
