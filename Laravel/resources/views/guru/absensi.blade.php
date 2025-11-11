@extends('guru.layout.main')

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
    .status-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .status-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #3498db;
    }
    .status-group select {
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
</style>

<h2 class="page-title">Absensi Siswa</h2>

<!-- Form Filter -->
<div class="form-card">
    <p><b>Isi kolom dibawah untuk melanjutkan</b></p>
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
                <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal ?? date('Y-m-d') }}" onchange="document.getElementById('filterForm').submit()" required>
            </div>
        </div>
    </form>
</div>

<!-- Tabel Absensi -->
@if(request('kelas_id'))
<div class="table-card">
    <form action="{{ route('admin.simpan_absensi') }}" method="POST" id="absensiTableForm">
        @csrf
        <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
        <input type="hidden" name="tanggal" value="{{ $tanggal ?? date('Y-m-d') }}">

        <table class="table table-bordered table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Siswa</th>
                    <th>Status Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa ?? [] as $index => $s)
                    @php
                        $statusMap = ['present'=>'hadir','sick'=>'sakit','permission'=>'izin','absent'=>'alpa'];
                        $currentStatus = $statusMap[$s->absensi_status] ?? 'alpa';
                        $isChecked = $currentStatus != 'alpa' ? true : false;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $s->name }}</td>
                        <td>
                            <div class="status-group">
                                <input type="hidden" name="siswa[{{ $s->id }}][checked]" value="0">
                                <input type="checkbox"
                                    name="siswa[{{ $s->id }}][checked]"
                                    id="check_{{ $s->id }}"
                                    value="1"
                                    {{ $isChecked ? 'checked' : '' }}>
                                <select name="siswa[{{ $s->id }}][status]"
                                        id="select_{{ $s->id }}"
                                        {{ $isChecked ? '' : 'disabled' }}>
                                    <option value="hadir" {{ $currentStatus=='hadir'?'selected':'' }}>Hadir</option>
                                    <option value="sakit" {{ $currentStatus=='sakit'?'selected':'' }}>Sakit</option>
                                    <option value="izin" {{ $currentStatus=='izin'?'selected':'' }}>Izin</option>
                                    <option value="alpa" {{ $currentStatus=='alpa'?'selected':'' }}>Alpa</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada siswa di kelas ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(count($siswa ?? []) > 0)
            <div class="button-group">
                <button type="button" class="btn btn-danger" onclick="window.location='{{ route('admin.dashboard') }}'">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Absensi</button>
            </div>
        @endif
    </form>
</div>
@endif

@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="check_"]');

    checkboxes.forEach(checkbox => {
        const select = checkbox.parentElement.querySelector('select');
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                select.disabled = false;
                if (select.value === 'alpa') select.value = 'hadir';
            } else {
                select.value = 'alpa';
                select.disabled = false; // tetap enable supaya terkirim
            }
        });
    });

    const form = document.getElementById('absensiTableForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            checkboxes.forEach(checkbox => {
                const select = checkbox.parentElement.querySelector('select');
                if (select.disabled) {
                    select.disabled = false;
                }
            });

            Swal.fire({
                title: 'Simpan absensi?',
                text: "Data absensi akan disimpan!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}'
        });
    @endif
});
</script>
@endpush
