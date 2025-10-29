@extends('guru.layout.main')

@section('title', 'Dashboard - EDUTRACK')

@section('content')
<h1 class="page-title">Data Guru</h1>

<!-- Card Biodata Guru -->
<div class="card">
    <h2 style="font-size: 18px; margin-bottom: 10px;">Biodata Guru</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 6px 10px; font-size: 15px;"><strong>Nama</strong></td>
            <td style="padding: 6px 10px; font-size: 15px;">: Bapak Ahmad Suryana</td>
        </tr>
        <tr>
            <td style="padding: 6px 10px; font-size: 15px;"><strong>NIP</strong></td>
            <td style="padding: 6px 10px; font-size: 15px;">: 19800722 201001 1 001</td>
        </tr>
        <tr>
            <td style="padding: 6px 10px; font-size: 15px;"><strong>Mata Pelajaran</strong></td>
            <td style="padding: 6px 10px; font-size: 15px;">: Matematika</td>
        </tr>
        <tr>
            <td style="padding: 6px 10px; font-size: 15px;"><strong>Kelas yang Diampu</strong></td>
            <td style="padding: 6px 10px; font-size: 15px;">: 5A</td>
        </tr>
        <tr>
            <td style="padding: 6px 10px; font-size: 15px;"><strong>Email</strong></td>
            <td style="padding: 6px 10px; font-size: 15px;">: ahmad.suryana@sdn1jawa.sch.id</td>
        </tr>
    </table>
</div>

<!-- Card Informasi Terkini -->
<div class="card">
    <h2 style="font-size: 18px; margin-bottom: 10px;">Informasi Terkini</h2>
    <p>Selamat datang di sistem monitoring dan absensi siswa (EDUTRACK). Gunakan menu di samping untuk mengelola data siswa, nilai, dan laporan pembelajaran.</p>
</div>
@endsection
