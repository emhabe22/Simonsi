<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Models\TahunAkademik;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class GuruController extends Controller
{
        public function dashboard()
    {
       
        return view('guru.dashboard');
    }

public function nilai(Request $request)
{
    $kelas = Kelas::all();
    $siswa = collect();

    if ($request->kelas_id) {
        $siswa = Siswa::with('ortu') // <--- ini penting
            ->where('kelas_id', $request->kelas_id)
            ->get();
    }

    return view('guru.nilai', compact('kelas', 'siswa'));
}


        public function input_nilai($siswa_id, $kelas_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $kelas = Kelas::findOrFail($kelas_id);
        $mapel = Mapel::all();
        $tahun_akademik = TahunAkademik::all();
        $semester = Semester::all();

        return view('guru.input_nilai', compact('siswa', 'kelas', 'mapel', 'tahun_akademik', 'semester'));
    }

    // Simpan Nilai
    public function simpan_nilai(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
            'semester_id' => 'required|exists:semesters,id',
            'proses1' => 'nullable|numeric|min:0|max:100',
            'proses2' => 'nullable|numeric|min:0|max:100',
            'uts' => 'nullable|numeric|min:0|max:100',
            'proses3' => 'nullable|numeric|min:0|max:100',
            'proses4' => 'nullable|numeric|min:0|max:100',
            'uas' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'nullable|string|max:255',
        ]);

        Nilai::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'guru_id' => 1,
            'proses1' => $request->proses1 ?? 0,
            'proses2' => $request->proses2 ?? 0,
            'uts' => $request->uts ?? 0,
            'proses3' => $request->proses3 ?? 0,
            'proses4' => $request->proses4 ?? 0,
            'uas' => $request->uas ?? 0,
            'catatan' => $request->catatan,
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'semester_id' => $request->semester_id,
        ]);

        return redirect()->route('guru.nilai')->with('success', 'Nilai berhasil disimpan!');
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
public function cek_nilai($id)
{
    // Ambil data siswa berdasarkan ID
    $siswa = Siswa::findOrFail($id);

    // Ambil semua data dropdown
    $tahunAkademik = TahunAkademik::all();
    $semester = Semester::all();
    $mapel = Mapel::all();

    // Ambil semua nilai siswa dari tabel 'nilai'
    $nilai = Nilai::where('siswa_id', $id)
        ->with(['mapel', 'semester', 'tahunAkademik'])
        ->get();

    // Kirim ke view
    return view('guru.cek_nilai', compact('siswa', 'tahunAkademik', 'semester', 'mapel', 'nilai'));
}
public function laporan(Request $request)
{
    $kelas = Kelas::all();
    $tahunAkademik = TahunAkademik::all();
    $semester = Semester::all();

    // Ambil semua siswa sekaligus
    $semuaSiswa = Siswa::select('id', 'name', 'kelas_id')->get();

    $nilaiData = collect();
    $siswa = null;
    $rataRataKelas = collect();

    if ($request->kelas_id && $request->siswa_id && $request->tahun_akademik_id && $request->semester_id) {
        $siswa = Siswa::find($request->siswa_id);

        $nilaiData = Nilai::with('mapel')
            ->where('kelas_id', $request->kelas_id)
            ->where('siswa_id', $request->siswa_id)
            ->where('tahun_akademik_id', $request->tahun_akademik_id)
            ->where('semester_id', $request->semester_id)
            ->get();

        $rataRataKelas = Nilai::select('mapel_id', DB::raw('AVG((proses1 + proses2 + uts + proses3 + proses4 + uas)/6) as rata_rata'))
            ->where('kelas_id', $request->kelas_id)
            ->where('tahun_akademik_id', $request->tahun_akademik_id)
            ->where('semester_id', $request->semester_id)
            ->groupBy('mapel_id')
            ->with('mapel')
            ->get();
    }

    return view('guru.laporan', compact(
        'kelas', 'tahunAkademik', 'semester', 'siswa',
        'nilaiData', 'rataRataKelas', 'semuaSiswa'
    ));
}

}
