@extends('guru.layout.main')

@section('title', 'Input Nilai - EDUTRACK')

@section('content')
<div>
    <h1 class="page-title">Input Nilai</h1>

    <div class="card shadow p-4">
        <form action="{{ route('guru.simpan_nilai') }}" method="POST">
            @csrf

            {{-- Nama Siswa --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control text-input" value="{{ $siswa->name }}" readonly>
                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                </div>
            </div>

            {{-- Kelas --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control text-input" value="{{ $kelas->class }}{{ $kelas->subclass }}" readonly>
                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                </div>
            </div>

{{-- Tahun Akademik & Semester (1 baris) --}}
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Tahun Akademik</label>
    <div class="col-sm-4">
        <select name="tahun_akademik_id" class="form-select" required>
            <option value="">Pilih Tahun Akademik</option>
            @foreach($tahun_akademik as $tahun)
                <option value="{{ $tahun->id }}">{{ $tahun->id_tahun }}</option>
            @endforeach
        </select>
    </div>

    <label class="col-sm-2 col-form-label ps-5">Semester</label>

    <div class="col-sm-4">
        <select name="semester_id" class="form-select" required>
            <option value="">Pilih Semester</option>
            @foreach($semester as $s)
                <option value="{{ $s->id }}">{{ ucfirst($s->semester) }}</option>
            @endforeach
        </select>
    </div>
</div>


            {{-- Mata Pelajaran --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                <div class="col-sm-10">
                    <select name="mapel_id" class="form-select" required>
                        <option value="">Pilih Mapel</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Nilai Proses & Ujian --}}
            @php
                $fields = [
                    'proses1' => 'Nilai Proses 1',
                    'proses2' => 'Nilai Proses 2',
                    'uts'     => 'Nilai UTS',
                    'proses3' => 'Nilai Proses 3',
                    'proses4' => 'Nilai Proses 4',
                    'uas'     => 'Nilai UAS',
                ];
            @endphp

            @foreach($fields as $name => $label)
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">{{ $label }}</label>
                    <div class="col-sm-10">
                        <input type="number" name="{{ $name }}" class="form-control"
                               min="0" max="100" step="1" value="{{ old($name, 0) }}">
                    </div>
                </div>
            @endforeach

            {{-- Catatan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
                    <input type="text" name="catatan" class="form-control" placeholder="Tulis catatan di sini...">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="text-end mt-4">
                <a href="{{ route('guru.nilai') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-success me-2">Simpan Nilai</button>
            </div>
        </form>
    </div>
</div>
@endsection
