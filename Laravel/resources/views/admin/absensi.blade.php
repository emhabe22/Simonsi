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

    .form-card p b {
        color: #1e293b;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 520px;
    }

    .form-row {
        display: flex;
        align-items: center;
    }

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
    <form action="#" method="POST" id="absensiForm">
        @csrf
        <div class="form-group">
            <div class="form-row">
                <label for="kelas">Kelas:</label>
                <select class="select" id="kelas" name="kelas" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas ?? [] as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                    <!-- Default options jika data belum ada -->
                    @if(!isset($kelas) || count($kelas) == 0)
                        <option value="1A">Kelas 1A</option>
                        <option value="1B">Kelas 1B</option>
                        <option value="2A">Kelas 2A</option>
                        <option value="2B">Kelas 2B</option>
                        <option value="3A">Kelas 3A</option>
                        <option value="3B">Kelas 3B</option>
                        <option value="4A">Kelas 4A</option>
                        <option value="4B">Kelas 4B</option>
                        <option value="5A">Kelas 5A</option>
                        <option value="5B">Kelas 5B</option>
                        <option value="6A">Kelas 6A</option>
                        <option value="6B">Kelas 6B</option>
                    @endif
                </select>
            </div>
            <div class="form-row">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
            </div>
        </div>
    </form>
</div>

<!-- Tabel Absensi -->
<div class="table-card">
    <table class="biodata-table table table-bordered table-striped" style="width:100%;">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th>Nama Siswa</th>
                <th style="width: 300px;">Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswa ?? [] as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>
                    <div class="status-group">
                        <input type="checkbox" name="siswa[{{ $s->id }}][checked]" id="check_{{ $s->id }}" checked>
                        <select name="siswa[{{ $s->id }}][status]" form="absensiForm">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpa">Alpa</option>
                        </select>
                    </div>
                </td>
            </tr>
            @empty
            <!-- Data dummy jika belum ada siswa -->
            <tr>
                <td>1</td>
                <td>Alice</td>
                <td>
                    <div class="status-group">
                        <input type="checkbox" name="siswa[1][checked]" checked>
                        <select name="siswa[1][status]" form="absensiForm">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpa">Alpa</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Bob</td>
                <td>
                    <div class="status-group">
                        <input type="checkbox" name="siswa[2][checked]" checked>
                        <select name="siswa[2][status]" form="absensiForm">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpa">Alpa</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Charlie</td>
                <td>
                    <div class="status-group">
                        <input type="checkbox" name="siswa[3][checked]" checked>
                        <select name="siswa[3][status]" form="absensiForm">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpa">Alpa</option>
                        </select>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="button-group">
        <button type="button" class="btn btn-danger" onclick="window.location='{{ route('admin.dashboard') }}'">Batal</button>
        <button type="submit" form="absensiForm" class="btn btn-success">Simpan</button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Script untuk handle checkbox jika diperlukan
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const select = this.parentElement.querySelector('select');
if (this.checked) {
    select.disabled = false;
    select.value = 'hadir';
} else {
    select.disabled = true;
    select.value = 'alpa';
}

            });
        });
    });
</script>
@endpush