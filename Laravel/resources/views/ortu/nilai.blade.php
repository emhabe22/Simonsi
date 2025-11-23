@extends('ortu.layout.main')

@section('title', 'Nilai Siswa - EDUTRACK')

@section('content')

<div>
    <h2 class="page-title">Daftar Nilai Siswa</h2>

    <!-- Filter -->
    <form method="GET" action="{{ route('ortu.nilai') }}">
        <div class="card shadow-sm p-4">

            <div class="mb-3">
                <label class="fw-semibold">Tahun Akademik</label>
                <select name="tahun_akademik_id" class="form-select">
                    <option value="">Pilih Tahun</option>
                    @foreach(\App\Models\TahunAkademik::all() as $t)
                        <option value="{{ $t->id }}" {{ request('tahun_akademik_id') == $t->id ? 'selected' : '' }}>
                            {{ $t->id_tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Semester</label>
                <select name="semester_id" class="form-select">
                    <option value="">Pilih Semester</option>
                    @foreach(\App\Models\Semester::all() as $s)
                        <option value="{{ $s->id }}" {{ request('semester_id') == $s->id ? 'selected' : '' }}>
                            {{ ucfirst($s->semester) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Mata Pelajaran</label>
                <select name="mapel_id" class="form-select">
                    <option value="">Pilih Mapel</option>
                    @foreach($mapelList as $m)
                        <option value="{{ $m->id }}" {{ request('mapel_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('ortu.nilai') }}" class="btn btn-danger px-4">Reset</a>
                <button class="btn btn-success px-4">Tampilkan</button>
            </div>

        </div>
    </form>

    <!-- HASIL NILAI -->
    @if($nilai)
    <div class="card shadow-sm p-4 mt-4">

        <h4 class="fw-bold mb-3">{{ $nilai->mapel->name }}</h4>

        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>Proses</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Proses 1</td><td>{{ $nilai->proses1 }}</td></tr>
                <tr><td>Proses 2</td><td>{{ $nilai->proses2 }}</td></tr>
                <tr><td>UTS</td><td>{{ $nilai->uts }}</td></tr>
                <tr><td>Proses 3</td><td>{{ $nilai->proses3 }}</td></tr>
                <tr><td>Proses 4</td><td>{{ $nilai->proses4 }}</td></tr>
                <tr><td>UAS</td><td>{{ $nilai->uas }}</td></tr>

                @php
                    $rata = round(($nilai->proses1 + $nilai->proses2 + $nilai->uts + $nilai->proses3 + $nilai->proses4 + $nilai->uas) / 6, 1);
                @endphp

                <tr class="fw-semibold table-light">
                    <td>Rata-Rata</td>
                    <td>{{ $rata }}</td>
                </tr>
            </tbody>
        </table>

        <p class="mb-0"><strong>Catatan:</strong> {{ $nilai->catatan ?? '-' }}</p>

    </div>
    @elseif(request()->has('mapel_id'))
    <div class="card shadow-sm p-4 mt-4 text-danger fw-bold">
        Nilai belum tersedia.
    </div>
    @endif

</div>
@endsection
