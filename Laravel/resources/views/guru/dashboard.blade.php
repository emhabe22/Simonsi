@extends('guru.layout.main')

@section('title', 'Dashboard - EDUTRACK')

@section('content')
<h1 class="page-title">Bioadata Guru</h1>

<!-- Card Biodata Guru -->
<div class="card">

    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tbody class="align-middle">

                <tr>
                    <th class="fw-semibold" style="width: 200px;">Nama</th>
                    <td class="fw-semibold">{{ $guru->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="fw-semibold">NIP</th>
                    <td class="fw-semibold">{{ $guru->nip ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="fw-semibold">Mata Pelajaran</th>
                    <td class="fw-semibold">{{ $guru->mapel->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="fw-semibold">Kelas yang Diampu</th>
                    <td class="fw-semibold">
                        {{ $guru->kelas->class ?? '-' }}{{ $guru->kelas->subclass ?? '' }}
                    </td>
                </tr>

                <tr>
                    <th class="fw-semibold">Email</th>
                    <td class="fw-semibold">{{ $guru->user->email ?? '-' }}</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<!-- Card Informasi Terkini -->
<div class="card">
    <h2 style="font-size: 18px; margin-bottom: 10px;">Informasi Terkini</h2>
    <p>Selamat datang di sistem monitoring dan absensi siswa (EDUTRACK). Gunakan menu di samping untuk mengelola data siswa, nilai, dan laporan pembelajaran.</p>
</div>
@endsection
