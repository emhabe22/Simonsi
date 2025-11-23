  @extends('admin.layout.main')

  @section('title', 'Nilai Siswa - EDUTRACK')

  @section('content')
  <style>
    .nilai { font-family: 'Poppins', sans-serif; color: #222; }
    .nilai label { font-weight: 500; }
    .nilai .controls { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
  </style>

  <div class="content nilai">
    <h2 class="page-title">Nilai Siswa</h2>

    <!-- Filter -->
    <div class="card">
      
      <form method="GET" action="{{ route('admin.nilai') }}">

        <div class="controls">
          <label for="kelas" style="min-width:130px;">Kelas</label>
          <select class="select" id="kelas" name="kelas_id" onchange="this.form.submit()">
            <option value="">Pilih Kelas Siswa</option>
            @foreach($kelas as $k)
              <option value="{{ $k->id }}" 
                {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                {{ $k->class }}{{ $k->subclass }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="controls">
          <label for="tahun" style="min-width:130px;">Tahun Akademik</label>
          <select class="select" id="tahun" name="tahun_akademik_id" onchange="this.form.submit()">
            <option value="">Pilih Tahun Akademik</option>
            @foreach($tahunAkademik as $t)
              <option value="{{ $t->id }}"
                {{ request('tahun_akademik_id') == $t->id ? 'selected' : '' }}>
                {{ $t->id_tahun }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="controls">
          <label for="semester" style="min-width:130px;">Semester</label>
          <select class="select" id="semester" name="semester_id" onchange="this.form.submit()">
            <option value="">Pilih Semester</option>
            @foreach($semester as $s)
              <option value="{{ $s->id }}"
                {{ request('semester_id') == $s->id ? 'selected' : '' }}>
                {{ ucfirst($s->semester) }}
              </option>
            @endforeach
          </select>
        </div>

      </form>

    </div>

    <!-- Tabel -->
    <div class="table-wrapper">
      <table class="biodata-table table table-bordered table-striped" style="width:100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Ortu</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

  @if(request('kelas_id') && request('tahun_akademik_id') && request('semester_id'))
      
      @forelse($siswa as $i => $s)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->ortu->name ?? '-' }}</td>
            <td>
              <a href="{{ route('admin.cek_nilai', $s->id) }}" class="btn btn-success">Cek Nilai</a>
            </td>
          </tr>
      @empty
          <tr>
            <td colspan="4" class="text-center text-danger py-3">Tidak ada siswa.</td>
          </tr>
      @endforelse

  @else
      <tr>
          <td colspan="4" class="text-center text-danger py-3">
              Pilih kelas, tahun akademik, dan semester terlebih dahulu.
          </td>
      </tr>
  @endif


        </tbody>
      </table>
    </div>
  </div>
  @endsection
