@extends('ortu.layout.main')

@section('title', 'Laporan Akademik - EDUTRACK')

@section('content')
<div class="laporan">
  <h2 class="page-title">Laporan Akademik</h2>

  <div class="card shadow p-4 mb-3">
    <p><b>LAPORAN AKADEMIK SISWA</b></p>

    <form id="formLaporan">
      <div style="display:flex; flex-direction:column; gap:12px; width:100%;">

        <div style="display:flex; align-items:center; gap:12px;">
          <label for="tahun" style="min-width:140px;">Tahun Akademik :</label>
          <select class="select" id="tahun" name="tahun">
            <option value="">-- Pilih Tahun Akademik --</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
          </select>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <label for="semester" style="min-width:140px;">Semester :</label>
          <select class="select" id="semester" name="semester">
            <option value="">-- Pilih Semester --</option>
            <option value="ganjil">Ganjil</option>
            <option value="genap">Genap</option>
          </select>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:12px;">
          <button type="submit" class="btn btn-success">Cetak Laporan</button>
        </div>

      </div>
    </form>
  </div>

  <!-- Tabel nilai (disembunyikan dulu dengan d-none) -->
  <div id="tabelNilai" class="card shadow p-4 d-none" style="margin-top:20px;">
    <h2>Hasil Nilai</h2>
    <p id="infoSiswa">Nama: Siswa Contoh | Kelas: 1A | Tahun: 2025 | Semester: Ganjil</p>
    <table class="table table-bordered table-striped" style="width:100%;">
      <thead style="background-color:#0d6efd; color:white;">
        <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Nilai</th>
          <th>Grade</th>
        </tr>
      </thead>
      <tbody id="tbodyNilai">
        <!-- Data akan diisi oleh JavaScript -->
      </tbody>
    </table>
    <p><b>Catatan : Sukses</b></p>
  </div>
</div>

{{-- JavaScript --}}
<script>
  const dataNilai = {
    "Matematika": 88,
    "IPA": 90,
    "Bahasa Indonesia": 85
  };

  const formLaporan = document.getElementById("formLaporan");
  const tabelNilaiDiv = document.getElementById("tabelNilai");
  const tbodyNilai = document.getElementById("tbodyNilai");
  const infoSiswa = document.getElementById("infoSiswa");

  function hitungGrade(nilai) {
    if (nilai >= 90) return "A";
    if (nilai >= 80) return "B";
    return "C";
  }

  formLaporan.addEventListener("submit", function(e) {
    e.preventDefault();

    const tahun = document.getElementById("tahun").value;
    const semester = document.getElementById("semester").value;

    if (!tahun || !semester) {
      alert("Harap lengkapi Tahun Akademik dan Semester!");
      return;
    }

    // Update info siswa
    infoSiswa.textContent = `Nama: Siswa Contoh | Kelas: 1A | Tahun: ${tahun} | Semester: ${semester}`;

    // Isi tabel nilai
    tbodyNilai.innerHTML = "";
    let i = 1;
    for (const mapel in dataNilai) {
      const nilai = dataNilai[mapel];
      const grade = hitungGrade(nilai);
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${i++}</td>
        <td>${mapel}</td>
        <td>${nilai}</td>
        <td>${grade}</td>
      `;
      tbodyNilai.appendChild(tr);
    }

    // Tampilkan tabel
    tabelNilaiDiv.classList.remove("d-none");
  });
</script>
@endsection
