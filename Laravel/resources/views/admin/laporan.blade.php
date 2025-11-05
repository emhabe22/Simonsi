@extends('admin.layout.main')

@section('title', 'Laporan Akademik - EDUTRACK')

@section('content')
<div class="laporan">
  <h2 class="page-title">Laporan Akademik</h2>

  <div class="card shadow p-4 mb-3">
    <p><b>LAPORAN AKADEMIK SISWA</b></p>

    <form id="formLaporan">
      <div style="display:flex; flex-direction:column; gap:12px; width:100%;">

        <div style="display:flex; align-items:center; gap:12px;">
          <label for="kelas" style="min-width:140px;">Pilih Kelas :</label>
          <select class="select" id="kelas" name="kelas">
            <option value="">-- Pilih Kelas --</option>
            <option value="1A">1A</option>
            <option value="2X">2X</option>
          </select>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <label for="siswa" style="min-width:140px;">Nama Siswa :</label>
          <select class="select" id="siswa" name="siswa">
            <option value="">-- Pilih siswa --</option>
          </select>
        </div>

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
          <a href="#" class="btn btn-danger">Kembali</a>
          <button type="submit" class="btn btn-success">Cetak Laporan</button>
        </div>

      </div>
    </form>
  </div>

  <!-- Tabel nilai (disembunyikan dulu dengan d-none) -->
  <div id="tabelNilai" class="card shadow p-4 d-none" style="margin-top:20px;">
    <h2>Hasil Nilai</h2>
    <p id="infoSiswa"></p>
    <table class="table table-bordered table-striped" style="width:100%;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Nilai</th>
        </tr>
      </thead>
      <tbody id="tbodyNilai"></tbody>
    </table>
    <p><b>Catatan : Sukses</b></p>
  </div>
</div>

{{-- JavaScript --}}
<script>
  const dataSiswa = {
    "1A": ["Budi", "Siti", "Andi", "Dewi"],
    "2X": ["Rina", "Agus", "Tono", "Lia"]
  };

  const dataNilai = {
    "1A": {
      "Budi": { "Matematika": 88, "IPA": 90, "Bahasa Indonesia": 85 },
      "Siti": { "Matematika": 92, "IPA": 93, "Bahasa Indonesia": 91 },
      "Andi": { "Matematika": 80, "IPA": 84, "Bahasa Indonesia": 79 },
      "Dewi": { "Matematika": 95, "IPA": 94, "Bahasa Indonesia": 96 }
    },
    "2X": {
      "Rina": { "Matematika": 89, "IPA": 88, "Bahasa Indonesia": 87 },
      "Agus": { "Matematika": 91, "IPA": 90, "Bahasa Indonesia": 92 },
      "Tono": { "Matematika": 85, "IPA": 86, "Bahasa Indonesia": 84 },
      "Lia": { "Matematika": 93, "IPA": 95, "Bahasa Indonesia": 94 }
    }
  };

  const kelasSelect = document.getElementById("kelas");
  const siswaSelect = document.getElementById("siswa");
  const formLaporan = document.getElementById("formLaporan");
  const tabelNilaiDiv = document.getElementById("tabelNilai");
  const tbodyNilai = document.getElementById("tbodyNilai");
  const infoSiswa = document.getElementById("infoSiswa");

  // Saat kelas berubah, isi daftar siswa
  kelasSelect.addEventListener("change", function () {
    const kelasDipilih = this.value;
    siswaSelect.innerHTML = "<option value=''>-- Pilih siswa --</option>";
    if (dataSiswa[kelasDipilih]) {
      dataSiswa[kelasDipilih].forEach(nama => {
        const option = document.createElement("option");
        option.value = nama;
        option.textContent = nama;
        siswaSelect.appendChild(option);
      });
    }
  });

  // Saat tombol Cetak Laporan diklik
  formLaporan.addEventListener("submit", function (e) {
    e.preventDefault();

    const kelas = kelasSelect.value;
    const siswa = siswaSelect.value;
    const tahun = document.getElementById("tahun").value;
    const semester = document.getElementById("semester").value;

    if (!kelas || !siswa || !tahun || !semester) {
      alert("Harap lengkapi semua pilihan sebelum mencetak laporan!");
      return;
    }

    const nilaiSiswa = dataNilai[kelas]?.[siswa];
    if (!nilaiSiswa) {
      alert("Data nilai tidak ditemukan untuk siswa ini.");
      return;
    }

    // Isi info siswa dan tabel nilai
    infoSiswa.textContent = `Nama: ${siswa} | Kelas: ${kelas} | Tahun: ${tahun} | Semester: ${semester}`;
    tbodyNilai.innerHTML = "";

    let i = 1;
    for (const mapel in nilaiSiswa) {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${i++}</td>
        <td>${mapel}</td>
        <td>${nilaiSiswa[mapel]}</td>
      `;
      tbodyNilai.appendChild(tr);
    }

    // Tampilkan tabel nilai
    tabelNilaiDiv.classList.remove("d-none");
  });
</script>
@endsection
