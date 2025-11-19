<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Absensi;

class OrtuController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orangtua/dashboard",
     *     summary="Menampilkan ringkasan data dashboard orang tua",
     *     tags={"Orang Tua"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function dashboard(Request $request)
    {
        $user = $request->user; 
        $ortu = $user->ortu;
        $anak = $ortu->siswa;

        return response()->json([
            'nama_orangtua' => $ortu->nama,
            'email' => $user->email,
            'nama_anak' => $anak->nama ?? '-',
            'kelas_anak' => $anak->kelas->class ?? '-',
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/orangtua/laporan",
     *     summary="Menampilkan laporan akademik anak",
     *     tags={"Orang Tua"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function laporanAkademik(Request $request)
    {
        $user = $request->user;
        $ortu = $user->ortu;
        $anak = $ortu->siswa;

        if (!$anak) {
            return response()->json(['message' => 'Tidak ada data anak.'], 404);
        }

        $nilai = Nilai::where('id_siswa', $anak->id)
            ->with(['mapel'])
            ->get();

        $rekap = [];
        foreach ($nilai as $index => $n) {
            $rata = round((
                $n->proses_1 +
                $n->proses_2 +
                $n->proses_3 +
                $n->proses_4 +
                $n->uts +
                $n->uas
            ) / 6, 2);

            $rekap[] = [
                'no' => $index + 1,
                'mata_pelajaran' => $n->mapel->name ?? '-',
                'nilai_rata_rata' => $rata,
                'catatan' => $n->catatan ?? '-',
            ];
        }

        return response()->json([
            'nama_anak' => $anak->nama,
            'kelas' => $anak->kelas->class ?? '-',
            'tahun_akademik' => $nilai->first()->tahun_akademik ?? '-',
            'semester' => $nilai->first()->semester ?? '-',
            'nilai' => $rekap
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/orangtua/absensi",
     *     summary="Menampilkan data absensi anak",
     *     tags={"Orang Tua"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function absensi(Request $request)
    {
        $user = $request->user;
        $ortu = $user->ortu;
        $anak = $ortu->siswa;

        if (!$anak) {
            return response()->json(['message' => 'Tidak ada data anak.'], 404);
        }

        $absensi = Absensi::where('id_siswa', $anak->id)->get();

        $data = $absensi->map(function ($a) use ($anak) {
            return [
                'nama_anak' => $anak->nama,
                'kelas' => $anak->kelas->class ?? '-',
                'tanggal' => $a->tanggal,
                'status' => ucfirst($a->status),
            ];
        });

        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/api/orangtua/nilai-anak",
     *     summary="Menampilkan nilai akademik anak (detail)",
     *     tags={"Orang Tua"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function getNilaiAnak(Request $request)
    {
        $user = $request->user;
        $ortu = $user->ortu;
        $anak = $ortu->siswa;

        if (!$anak) {
            return response()->json(['message' => 'Tidak ada data anak.'], 404);
        }

        $nilai = Nilai::where('id_siswa', $anak->id)
            ->with('mapel')
            ->get();

        $data = $nilai->map(function ($n) use ($anak) {
            $rata = round((
                $n->proses_1 +
                $n->proses_2 +
                $n->proses_3 +
                $n->proses_4 +
                $n->uts +
                $n->uas
            ) / 6, 2);

            return [
                'nama_anak' => $anak->nama,
                'kelas' => $anak->kelas->class ?? '-',
                'mata_pelajaran' => $n->mapel->name ?? '-',
                'tahun_akademik' => $n->tahun_akademik,
                'semester' => $n->semester,
                'nilai_akhir' => $rata,
                'catatan' => $n->catatan ?? '-',
            ];
        });

        return response()->json($data);
    }
}
