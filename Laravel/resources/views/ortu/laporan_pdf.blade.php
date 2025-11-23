<!DOCTYPE html>
<html>
<head>
  <style>
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid black; padding:6px; text-align:center; }
  </style>
</head>
<body>
  <h3 style="text-align:center;">LAPORAN AKADEMIK SISWA</h3>
  <p>Nama : <b>{{ $siswa->name }}</b></p>
  <p>Kelas : <b>{{ $siswa->kelas->class }}{{ $siswa->kelas->subclass }}</b></p>
  <br>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Mata Pelajaran</th>
        <th>Nilai Rata-rata</th>
        <th>Grade</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($nilai as $i => $n)
        @php
          $avg = round(($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6);
          $grade = $avg >= 90 ? 'A' : ($avg >= 80 ? 'B' : 'C');
        @endphp
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $n->mapel->name }}</td>
          <td>{{ $avg }}</td>
          <td>{{ $grade }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
