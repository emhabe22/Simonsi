<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class OrtuController extends Controller
{

public function dashboard(Request $request)
{
   $user = $request->user();

    // Data ortu
    $ortu = \App\Models\Ortu::where('user_id', $user->id)->first();
    $siswa = $ortu ? $ortu->siswa()->with('kelas')->first() : null;

    $akademik = \App\Models\TahunAkademik::orderBy('id_tahun', 'desc')->first();
    $semester = \App\Models\Semester::where('id', 1)->first();

    if (!$siswa) {
        return view('ortu.dashboard', compact('ortu', 'siswa', 'akademik', 'semester'));
    }

    // Ambil nilai siswa
    $nilaiList = \App\Models\Nilai::with('mapel')
        ->where('siswa_id', $siswa->id)
        ->where('tahun_akademik_id', $akademik->id ?? null)
        ->where('semester_id', $semester->id ?? null)
        ->get();

    // Hitung statistik nilai
    $totalNilai = $nilaiList->count();

    $rataRata = $nilaiList->count() > 0
        ? round($nilaiList->avg(function ($n) {
            return ($n->proses1 + $n->proses2 + $n->uts + $n->proses3 + $n->proses4 + $n->uas) / 6;
        }))
        : 0;

    /* ===============================
       HITUNG KEHADIRAN REAL
    =============================== */
    $bulanIni = now()->format('Y-m');

    $absensi = \App\Models\Absensi::where('siswa_id', $siswa->id)
        ->where('date', 'like', $bulanIni . '%')
        ->get();

    $totalHari = $absensi->count();
    $hadir = $absensi->where('status', 'present')->count();

    $kehadiran = $totalHari > 0
        ? round(($hadir / $totalHari) * 100)
        : 0;

    return view('ortu.dashboard', compact(
        'ortu',
        'siswa',
        'akademik',
        'semester',
        'nilaiList',
        'totalNilai',
        'rataRata',
        'kehadiran'
    ));
}
        public function absensi(Request $request)
    {
    $user = $request->user();

    // cari ortu berdasarkan user login
    $ortu = \App\Models\Ortu::where('user_id', $user->id)->first();

    if (!$ortu) {
        return view('ortu.absensi', [
            'absensi' => collect(),
            'siswa' => null
        ]);
    }

    // siswa terkait ortu
    $siswa = $ortu->siswa;

    if (!$siswa) {
        return view('ortu.absensi', [
            'absensi' => collect(),
            'siswa' => null
        ]);
    }

    // bulan yang dipilih
    $bulan = $request->bulan ?? date('m');

    // ambil data absensi dari database
    $absensi = \App\Models\Absensi::where('siswa_id', $siswa->id)
        ->whereMonth('date', $bulan)
        ->orderBy('date', 'asc')
        ->get();

    return view('ortu.absensi', compact('absensi', 'siswa'));
    }
    public function nilai(Request $request)
{
   $user = $request->user();

    $ortu = \App\Models\Ortu::where('user_id', $user->id)->first();
    if (!$ortu) {
        return view('ortu.nilai', ['siswa' => null, 'nilai' => null, 'mapelList' => collect()]);
    }

    $siswa = $ortu->siswa;
    if (!$siswa) {
        return view('ortu.nilai', ['siswa' => null, 'nilai' => null, 'mapelList' => collect()]);
    }

    $tahun    = $request->tahun_akademik_id;
    $semester = $request->semester_id;
    $mapel    = $request->mapel_id;

    // daftar mapel yang pernah ada nilainya
    $mapelList = \App\Models\Nilai::with('mapel')
        ->where('siswa_id', $siswa->id)
        ->get()
        ->pluck('mapel')
        ->unique('id');

    // SATU nilai spesifik (bukan get())
    $nilai = null;

    if ($tahun && $semester && $mapel) {
        $nilai = \App\Models\Nilai::with(['mapel','semester','tahunAkademik'])
            ->where('siswa_id', $siswa->id)
            ->where('mapel_id', $mapel)
            ->where('tahun_akademik_id', $tahun)
            ->where('semester_id', $semester)
            ->first();   // <-- PENTING: first(), JANGAN get()
    }

    return view('ortu.nilai', compact('siswa', 'nilai', 'mapelList'));
}

public function laporan(Request $request)
{
    $user = $request->user();

    // Data ortu
    $ortu = \App\Models\Ortu::where('user_id', $user->id)->first();
    $siswa = $ortu->siswa ?? null;

    // Dropdown
    $tahunList = \App\Models\TahunAkademik::all();
    $semesterList = \App\Models\Semester::all();

    // Jika belum memilih filter
    if (!$request->tahun_akademik_id || !$request->semester_id) {
        return view('ortu.laporan', [
            'siswa' => $siswa,
            'nilai' => collect(),
            'tahunList' => $tahunList,
            'semesterList' => $semesterList,
        ]);
    }

    // Ambil nilai siswa sesuai filter
    $nilai = \App\Models\Nilai::with('mapel')
        ->where('siswa_id', $siswa->id)
        ->where('tahun_akademik_id', $request->tahun_akademik_id)
        ->where('semester_id', $request->semester_id)
        ->get();

    return view('ortu.laporan', [
        'siswa' => $siswa,
        'nilai' => $nilai,
        'tahunList' => $tahunList,
        'semesterList' => $semesterList,
    ]);
}
public function laporan_pdf(Request $request)
{
    $user = $request->user();
    $ortu = \App\Models\Ortu::where('user_id', $user->id)->first();
    $siswa = $ortu->siswa;

    $nilai = \App\Models\Nilai::with('mapel')
        ->where('siswa_id', $siswa->id)
        ->where('tahun_akademik_id', $request->tahun_akademik_id)
        ->where('semester_id', $request->semester_id)
        ->get();

    $pdf = Pdf::loadView('ortu.laporan_pdf', [
        'siswa' => $siswa,
        'nilai' => $nilai
    ]);

    return $pdf->stream('Laporan-Akademik.pdf'); // bisa ->download(...)
}
}
