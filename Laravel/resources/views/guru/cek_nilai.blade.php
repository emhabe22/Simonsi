@extends('guru.layout.main')

@section('title', 'Nilai Siswa - EDUTRACK')

@section('content')
<div>
    <h2 class="page-title">Daftar Nilai Siswa: {{ $siswa->name }}</h2>

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 100%;">
        <div class="mb-3">
            <label for="tahun" class="form-label fw-semibold">Tahun Akademik:</label>
            <select id="tahun" class="form-select">
                <option value="">Pilih Tahun Akademik</option>
                @foreach($tahunAkademik as $t)
                    <option value="{{ $t->id }}">{{ $t->id_tahun }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label fw-semibold">Semester:</label>
            <select id="semester" class="form-select">
                <option value="">Pilih Semester</option>
                @foreach($semester as $s)
                    <option value="{{ $s->id }}">{{ ucfirst($s->semester) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mapel" class="form-label fw-semibold">Mata Pelajaran:</label>
            <select id="mapel" class="form-select">
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button id="resetBtn" class="btn btn-danger px-4">Reset</button>
            <button id="tampilkanBtn" class="btn btn-success px-4">Tampilkan</button>
        </div>
    </div>

    <!-- Container tabel nilai -->
    <div id="nilaiContainer" class="mt-4" style="display: none;">
        @foreach($mapel as $m)
        <div class="card shadow-sm p-4 mb-4 mapel" id="mapel_{{ $m->id }}">
            <h4 class="fw-bold mb-3">{{ $m->nama_mapel }}</h4>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="background-color: #0d6efd; color: white;">Proses</th>
                        <th style="background-color: #0d6efd; color: white;">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nilaiMapel = $nilai->where('mapel_id', $m->id);
                        $rata2 = $nilaiMapel->avg(function($n) {
                            return ($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6;
                        });
                    @endphp

                    @forelse($nilaiMapel as $n)
                        <tr><td>Proses 1</td><td>{{ $n->proses1 }}</td></tr>
                        <tr><td>Proses 2</td><td>{{ $n->proses2 }}</td></tr>
                        <tr><td>UTS</td><td>{{ $n->uts }}</td></tr>
                        <tr><td>Proses 3</td><td>{{ $n->proses3 }}</td></tr>
                        <tr><td>Proses 4</td><td>{{ $n->proses4 }}</td></tr>
                        <tr><td>UAS</td><td>{{ $n->uas }}</td></tr>
                        <tr class="fw-semibold table-light">
                            <td>Nilai Rata-Rata</td>
                            <td>{{ number_format($rata2, 1) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2">Belum ada nilai</td></tr>
                    @endforelse
                </tbody>
            </table>
            <p class="mb-0">Catatan: {{ $nilaiMapel->first()->catatan ?? '-' }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const tampilkanBtn = document.getElementById("tampilkanBtn");
    const resetBtn = document.getElementById("resetBtn");
    const nilaiContainer = document.getElementById("nilaiContainer");
    const mapelCards = document.querySelectorAll(".mapel");

    tampilkanBtn.addEventListener("click", function() {
        const tahun = document.getElementById("tahun").value;
        const semester = document.getElementById("semester").value;
        const mapel = document.getElementById("mapel").value;

        if (tahun && semester && mapel) {
            nilaiContainer.style.display = "block";
            mapelCards.forEach(card => card.style.display = "none");
            document.getElementById("mapel_" + mapel).style.display = "block";
        } else {
            alert("Silakan pilih Tahun Akademik, Semester, dan Mata Pelajaran terlebih dahulu!");
        }
    });

    resetBtn.addEventListener("click", function() {
        document.getElementById("tahun").value = "";
        document.getElementById("semester").value = "";
        document.getElementById("mapel").value = "";
        nilaiContainer.style.display = "none";
    });
</script>
@endpush
