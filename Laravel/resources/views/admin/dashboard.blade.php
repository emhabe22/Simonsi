@extends('admin.layout.main')

@section('title', 'Dashboard - EDUTRACK')

@section('content')
<h1 class="page-title">Selamat Datang, Admin!</h1>

<!-- Statistics Cards -->
<div class="dashboard-cards">
    <div class="dashboard-card">
        <h3>Total Guru</h3>
        <div class="number">{{ $totalGuru ?? 15 }}</div>
    </div>
    <div class="dashboard-card">
        <h3>Total Orang Tua</h3>
        <div class="number">{{ $totalOrangTua ?? 185 }}</div>
    </div>
    <div class="dashboard-card">
        <h3>Total Siswa</h3>
        <div class="number">{{ $totalSiswa ?? 213 }}</div>
    </div>
</div>

<!-- Information Card -->
<div class="info-card">
    <h3>Informasi Terkini</h3>
    <p>Selamat datang di sistem monitoring dan absensi siswa (EDUTRACK). Gunakan menu di samping untuk mengelola data siswa, nilai, dan laporan pembelajaran.</p>
</div>

@endsection