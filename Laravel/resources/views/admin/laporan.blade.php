@extends('admin.layout.main')

@section('title', 'Laporan Akademik - EDUTRACK')

@section('content')
<div class="laporan">
  <h2 class="page-title">Laporan Akademik</h2>

  <div class="card shadow p-4 mb-3">
    <p><b>LAPORAN AKADEMIK SISWA</b></p>

    {{-- Form pencarian laporan --}}
    <form action="{{ route('admin.laporan') }}" method="GET">
      @csrf
      <div style="display:flex; flex-direction:column; gap:12px; width:100%;">

        {{-- Pilih Kelas --}}
        <div style="display:flex; align-items:center; gap:12px;">
          <label style="min-width:140px;">Pilih Kelas :</label>
          <select class="select" name="kelas_id" id="kelas_id">
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
              <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                {{ $k->class . ' ' . $k->subclass }}

              </option>
            @endforeach
          </select>
        </div>

        {{-- Pilih Siswa --}}
        <div style="display:flex; align-items:center; gap:12px;">
          <label style="min-width:140px;">Nama Siswa :</label>
          <select class="select" name="siswa_id" id="siswa_id">
            <option value="">-- Pilih Siswa --</option>
          </select>
        </div>

        {{-- Pilih Tahun Akademik --}}
        <div style="display:flex; align-items:center; gap:12px;">
          <label style="min-width:140px;">Tahun Akademik :</label>
          <select class="select" name="tahun_akademik_id">
            <option value="">-- Pilih Tahun Akademik --</option>
            @foreach($tahunAkademik as $t)
              <option value="{{ $t->id }}" {{ request('tahun_akademik_id') == $t->id ? 'selected' : '' }}>
                {{ $t->id_tahun }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Pilih Semester --}}
        <div style="display:flex; align-items:center; gap:12px;">
          <label style="min-width:140px;">Semester :</label>
          <select class="select" name="semester_id">
            <option value="">-- Pilih Semester --</option>
            @foreach($semester as $smt)
              <option value="{{ $smt->id }}" {{ request('semester_id') == $smt->id ? 'selected' : '' }}>
                {{ ucfirst($smt->semester) }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Tombol --}}
        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:12px;">
          <a href="{{ route('admin.laporan') }}" class="btn btn-danger">Reset</a>
          <button type="submit" class="btn btn-success">Tampilkan Laporan</button>
        </div>

      </div>
    </form>
  </div>

  {{-- Jika ada data nilai --}}
  @if($nilaiData->count() > 0)
  <div class="card shadow p-4" style="margin-top:20px;">
    <h2>Hasil Nilai</h2>
    <p>
      <b>Nama: </b>{{ $siswa->name ?? '-' }} |
      <b>Kelas: </b>{{ $siswa->kelas->class ?? '-' }} {{ $siswa->kelas->subclass ?? '' }}

    </p>

    <table class="table table-bordered table-striped" style="width:100%;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Nilai Rata-rata</th>
        </tr>
      </thead>
      <tbody>
        @foreach($nilaiData as $i => $n)
          @php
            $rata = ($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6;
          @endphp
          <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $n->mapel->name }}</td>
            <td>{{ number_format($rata, 2) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  <div style="text-align: right; margin-top: 16px;">
    <a href="{{ route('admin.laporan.pdf', request()->all()) }}" target="_blank" class="btn btn-primary">
        Cetak PDF
    </a>
</div>
  
  </div>
  @endif


</div>
@endsection

@push('scripts')
<script>
  // Semua data siswa dikirim dari controller
  const semuaSiswa = @json($semuaSiswa);

  const kelasSelect = document.getElementById('kelas_id');
  const siswaSelect = document.getElementById('siswa_id');

  // Event saat kelas dipilih
  kelasSelect.addEventListener('change', function() {
      const kelasId = this.value;
      siswaSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>'; // reset

      if (kelasId) {
          const siswaKelas = semuaSiswa.filter(s => s.kelas_id == kelasId);
          siswaKelas.forEach(s => {
              const option = document.createElement('option');
              option.value = s.id;
              option.textContent = s.name;
              siswaSelect.appendChild(option);
          });
      }
  });

  // Saat halaman reload, tampilkan siswa otomatis kalau kelas sudah dipilih
  @if(request('kelas_id'))
      const kelasAwal = "{{ request('kelas_id') }}";
      const siswaAwal = "{{ request('siswa_id') }}";
      const siswaKelas = semuaSiswa.filter(s => s.kelas_id == kelasAwal);
      siswaKelas.forEach(s => {
          const option = document.createElement('option');
          option.value = s.id;
          option.textContent = s.name;
          if (s.id == siswaAwal) option.selected = true;
          siswaSelect.appendChild(option);
      });
  @endif
</script>
@endpush
