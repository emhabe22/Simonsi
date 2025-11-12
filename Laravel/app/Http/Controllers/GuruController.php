<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
        public function dashboard()
    {
       
        return view('guru.dashboard');
    }


public function nilai(Request $request)
{
    // Ambil semua kelas untuk dropdown
    $kelas = Kelas::all();

    // Ambil siswa hanya jika kelas dipilih
    $siswa = collect();
    if ($request->kelas_id) {
        $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();
    }

    return view('guru.nilai', compact('kelas', 'siswa'));
}

        public function cek_nilai()
    {
        return view('guru.cek_nilai');
    }
        public function input_nilai()
    {
        return view('guru.input_nilai');
    }
            public function laporan()
    {
        return view('guru.laporan');
    }
    public function absensi(Request $request)
    {
        // Ambil semua kelas untuk dropdown
        $kelas = Kelas::all();

        // Jika ada kelas yang dipilih, ambil siswanya
        $siswa = [];
        $tanggal = $request->tanggal ?? date('Y-m-d');

        if ($request->kelas_id) {
            $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();

            // Load data absensi yang sudah ada untuk tanggal ini
            $absensiData = Absensi::where('date', $tanggal)
                ->whereIn('siswa_id', $siswa->pluck('id'))
                ->get()
                ->keyBy('siswa_id');

            // Tambahkan data absensi ke setiap siswa
            foreach ($siswa as $s) {
                $s->absensi_status = $absensiData->get($s->id)?->status ?? null;
            }
        }

        return view('guru.absensi', compact('kelas', 'siswa', 'tanggal'));
    }

    /**
     * Simpan absensi siswa - DIPERBARUI
     */
    public function simpan_absensi(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
        ]);

        // Ambil guru login (fallback ID 1 jika tidak ada)
        $guruId = Auth::user()->guru->id ?? 1;
        $tanggal = $request->tanggal;

        // Ambil semua siswa di kelas tersebut
        $siswaIds = Siswa::where('kelas_id', $request->kelas_id)->pluck('id');

        foreach ($siswaIds as $siswaId) {
            // Cek apakah siswa ini dicentang
            $isChecked = isset($request->siswa[$siswaId]['checked']);

            if ($isChecked) {
                // Jika dicentang, ambil status yang dipilih
                $statusInput = $request->siswa[$siswaId]['status'] ?? 'hadir';
                $status = match ($statusInput) {
                    'hadir' => 'present',
                    'sakit' => 'sick',
                    'izin'  => 'permission',
                    'alpa'  => 'absent',
                    default => 'present'
                };
            } else {
                // Jika tidak dicentang, otomatis alpa
                $status = 'absent';
            }

            // Simpan atau update absensi
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'date' => $tanggal
                ],
                [
                    'status' => $status,
                    'guru_id' => $guruId
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }
}
