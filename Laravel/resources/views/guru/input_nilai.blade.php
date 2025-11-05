@extends('guru.layout.main')

@section('title', 'Input Nilai - EDUTRACK')

@section('content')
<div>
    <h1 class="page-title">Input Nilai</h1>

    <div class="card shadow p-4">
        <p class="mb-3">Nama Siswa: <strong>Popol Kupa</strong></p>

        <form>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <select class="select">
                        <option value="">Pilih Kelas</option>
                        <option value="1A">1A - IPA</option>
                        <option value="1B">1B - IPS</option>
                    </select>
                </div>
            </div>

            @php
                $fields = ['Proses 1', 'Proses 2', 'UTS', 'Proses 3', 'Proses 4', 'UAS'];
            @endphp

            @foreach($fields as $field)
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">{{ $field }}</label>
                    <div class="col-sm-10">
                        <input type="number" class="text-input" min="0" max="100" step="1" value="0">
                    </div>
                </div>
            @endforeach

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
                    <input type="text" class="text-input" placeholder="Tulis catatan di sini...">
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('guru.nilai') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-success me-2">Simpan</button>

            </div>
        </form>
    </div>
</div>
@endsection
