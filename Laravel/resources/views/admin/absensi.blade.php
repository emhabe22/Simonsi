@extends('admin.layout.main')

@section('title', 'Absensi Siswa - EDUTRACK')

@section('content')
<style>
    .form-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .form-card p {
        font-size: 15px;
        color: #333;
        margin-bottom: 15px;
    }
    .form-card p b { color: #1e293b; }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 520px;
    }
    .form-row { display: flex; align-items: center; }
    .form-row label {
        width: 120px;
        margin-right: 12px;
        font-weight: 500;
        color: #333;
    }
    .form-row select,
    .form-row input[type="date"] {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }
    .form-row select:focus,
    .form-row input[type="date"]:focus {
        outline: none;
        border-color: #3498db;
    }
    .table-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-transform: capitalize;
    }
    .status-hadir { background: #d1fae5; color: #065f46; }
    .status-sakit { background: #fef3c7; color: #92400e; }
    .status-izin  { background: #bfdbfe; color: #1e40af; }
    .status-alpa  { background: #fee2e2; color: #991b1b; }
</style>

<h2 class="page-title">Absensi Siswa</h2>

<!-- Filter Kelas & Tanggal -->
<div class="form-card">
    <p><b>Isi kolom dibawah untuk melihat absensi</b></p>
    <form action="{{ route('admin.absensi') }}" method="GET" id="filterForm">
        <div class="form-group">
            <div class="form-row">
                <label for="kelas">Kelas:</label>
                <select id="kelas" name="kelas_id" onchange="document.getElementById('filterForm').submit()" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas ?? [] as $k)
                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->class }}{{ $k->subclass }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal"
                    value="{{ $tanggal ?? date('Y-m-d') }}"
                    onchange="document.getElementById('filterForm').submit()" required>
            </div>
        </div>
    </form>
</div>

<!-- Tabel Absensi (Read Only) -->
@if(request('kelas_id'))
<div class="table-card">
    <table class="table table-bordered table-striped" style="width:100%;">
        <thead>
            <tr>
                <th style="width:60px;">No</th>
                <th>Nama Siswa</th>
                <th>Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswa ?? [] as $index => $s)
                @php
                    $statusMap = [
                        'present' => ['label' => 'Hadir', 'class' => 'status-hadir'],
                        'sick' => ['label' => 'Sakit', 'class' => 'status-sakit'],
                        'permission' => ['label' => 'Izin', 'class' => 'status-izin'],
                        'absent' => ['label' => 'Alpa', 'class' => 'status-alpa'],
                    ];
                    $status = $statusMap[$s->absensi_status ?? 'absent'];
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->name }}</td>
                    <td><span class="status-badge {{ $status['class'] }}">{{ $status['label'] }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada siswa di kelas ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endif
@endsection
