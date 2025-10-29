@extends('ortu.layout.main')

@section('title', 'Nilai Siswa - EDUTRACK')

@section('content')
<div>
    <h2 class="page-title">Daftar Nilai Siswa</h2>

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 100%;">
        <div class="mb-3">
            <label for="tahun" class="form-label fw-semibold">Tahun Akademik:</label>
            <select id="tahun" class="form-select">
                <option value="">Pilih Tahun Akademik</option>
                <option value="2023/2024">2023/2024</option>
                <option value="2024/2025">2024/2025</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label fw-semibold">Semester:</label>
            <select id="semester" class="form-select">
                <option value="">Pilih Semester</option>
                <option value="1">Ganjil</option>
                <option value="2">Genap</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mapel" class="form-label fw-semibold">Mata Pelajaran:</label>
            <select id="mapel" class="form-select">
                <option value="">Pilih Mata Pelajaran</option>
                <option value="matematika">Matematika</option>
                <option value="ipa">IPA</option>
            </select>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button id="resetBtn" class="btn btn-danger px-4">Reset</button>
            <button id="tampilkanBtn" class="btn btn-success px-4">Tampilkan</button>
        </div>
    </div>

    <!-- Container tabel nilai -->
    <div id="nilaiContainer" class="mt-4" style="display: none;">
        <!-- Matematika -->
        <div class="card shadow-sm p-4 mb-4 mapel" id="matematika">
            <h4 class="fw-bold mb-3">Matematika</h4>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
        <th style="background-color: #0d6efd; color: white;">Proses</th>
        <th style="background-color: #0d6efd; color: white;">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Proses 1</td><td>80</td></tr>
                    <tr><td>Proses 2</td><td>82</td></tr>
                    <tr><td>UTS</td><td>85</td></tr>
                    <tr><td>Proses 3</td><td>83</td></tr>
                    <tr><td>Proses 4</td><td>83</td></tr>
                    <tr><td>UAS</td><td>88</td></tr>
                    <tr class="fw-semibold table-light"><td>Nilai Rata-Rata</td><td>85.9</td></tr>
                </tbody>
            </table>
            <p class="mb-0">Catatan: kiw kiw</p>
        </div>

        <!-- IPA -->
        <div class="card shadow-sm p-4 mb-4 mapel" id="ipa">
            <h4 class="fw-bold mb-3">IPA</h4>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
        <th style="background-color: #0d6efd; color: white;">Proses</th>
        <th style="background-color: #0d6efd; color: white;">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Proses 1</td><td>79</td></tr>
                    <tr><td>Proses 2</td><td>81</td></tr>
                    <tr><td>UTS</td><td>83</td></tr>
                    <tr><td>Proses 3</td><td>83</td></tr>
                    <tr><td>Proses 4</td><td>82</td></tr>
                    <tr><td>UAS</td><td>86</td></tr>
                    <tr class="fw-semibold table-light"><td>Nilai Rata-Rata</td><td>85.9</td></tr>
                </tbody>
            </table>
            <p class="mb-0">Catatan: kiw kiw</p>
        </div>
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
            document.getElementById(mapel).style.display = "block";
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
