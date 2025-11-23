<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h3 style="text-align:center;">LAPORAN AKADEMIK SISWA</h3>

    <p>
        <b>Nama:</b> {{ $siswa->name }} <br>
        <b>Kelas:</b> {{ $siswa->kelas->class }} {{ $siswa->kelas->subclass }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Pelajaran</th>
                <th>Nilai Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaiData as $i => $n)
                @php
                    $rata = ($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6;
                @endphp
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $n->mapel->name }}</td>
                    <td>{{ number_format($rata, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
