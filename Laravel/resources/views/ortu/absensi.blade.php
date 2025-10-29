@extends('ortu.layout.main')

@section('title', 'Absensi - EDUTRACK')

@section('content')
<div>
    <h1 class="page-title mb-3">Absensi Siswa</h1>

    <!-- Navigasi Bulan -->
    <div class="card shadow mb-3">
  <div class="card-body p-2 text-center">
    <div class="month-navbar d-flex flex-wrap justify-content-center">
      <button class="btn btn-primary active" style="margin: 4px;">Januari</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Februari</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Maret</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">April</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Mei</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Juni</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Juli</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Agustus</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">September</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Oktober</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">November</button>
      <button class="btn btn-outline-primary" style="margin: 4px;">Desember</button>
    </div>
  </div>
</div>


    <!-- Tabel Absensi -->
    <div class="card shadow">
        <div class="card-body p-2">
            <table class="table table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Status Kehadiran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Senin</td>
                        <td>13 Oktober 2025</td>
                        <td class="text-success fw-bold">Hadir</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Selasa</td>
                        <td>14 Oktober 2025</td>
                        <td class="text-success fw-bold">Hadir</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Rabu</td>
                        <td>15 Oktober 2025</td>
                        <td class="text-warning fw-bold">Izin</td>
                        <td>Acara keluarga</td>
                    </tr>
                    <tr>
                        <td>Kamis</td>
                        <td>16 Oktober 2025</td>
                        <td class="text-danger fw-bold">Sakit</td>
                        <td>Demam</td>
                    </tr>
                    <tr>
                        <td>Jumat</td>
                        <td>17 Oktober 2025</td>
                        <td class="text-success fw-bold">Hadir</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script tombol bulan -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.month-navbar button');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => {
                    b.classList.remove('btn-primary', 'active');
                    b.classList.add('btn-outline-primary');
                });
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('btn-primary', 'active');
                console.log("Bulan dipilih:", btn.textContent);
            });
        });
    });
</script>
@endsection
