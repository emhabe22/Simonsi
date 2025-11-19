<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Siswa;

class GuruController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/guru/dashboard",
     *     summary="Menampilkan ringkasan data dashboard guru",
     *     tags={"Guru"},
     *     security={{"bearerAuth":{}}},
     * )
     */
    public function dashboard(Request $request)
    {
        $guru = $request->user;  // dari middleware role

        $data = [
            'nama_guru'      => $guru->name ?? 'Guru Tanpa Nama',
            'email'          => $guru->email,
            'kelas'          => $guru->guru?->kelas?->class ?? '-', 
            'mata_pelajaran' => $guru->guru?->mapel?->name ?? '-',
        ];

        return response()->json($data);
    }

    /**
     * @OA\Put(
     *     path="/api/guru/absensi/{id}",
     *     summary="Guru mengedit status absensi siswa",
     *     tags={"Guru"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function updateAbsensi(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|string|in:Hadir,Sakit,Izin,Kosong'
        ]);

        $absensi = Absensi::find($id);

        if (!$absensi) {
            return response()->json(['message' => 'Data absensi tidak ditemukan.'], 404);
        }

        $absensi->status = $request->status === 'Kosong' ? null : $request->status;
        $absensi->save();

        return response()->json([
            'message' => 'Absensi berhasil diperbarui.',
            'data' => $absensi
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/guru/siswa-nilai",
     *     summary="Menampilkan daftar siswa di dalam kelas yang diampu oleh guru",
     *     tags={"Guru"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function getSiswaUntukNilai(Request $request)
    {
        $guru = $request->user->guru;  

        if (!$guru || !$guru->kelas_id) {
            return response()->json(['message' => 'Guru tidak memiliki kelas yang diampu.'], 404);
        }

        $siswa = Siswa::with('ortu')
            ->where('kelas_id', $guru->kelas_id)
            ->get();

        $data = $siswa->map(function ($s) {
            return [
                'id_siswa'   => $s->id,
                'nama_siswa' => $s->nama,
                'nama_ortu'  => $s->ortu?->nama ?? '-',
                'kelas'      => $s->kelas?->class ?? '-',
            ];
        });

        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/api/guru/nilai-siswa",
     *     summary="Menampilkan daftar nilai siswa berdasarkan tahun akademik dan semester",
     *     tags={"Guru"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function getNilaiSiswa(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
        ]);

        $nilai = Nilai::where('id_siswa', $request->siswa_id)
            ->where('semester', $request->semester)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->get();

        if ($nilai->isEmpty()) {
            return response()->json(['message' => 'Data nilai belum tersedia.']);
        }

        return response()->json([
            'siswa' => $nilai->first()->siswa->nama,
            'tahun_akademik' => $request->tahun_akademik,
            'semester' => $request->semester,
            'nilai' => $nilai->map(function ($n) {
                return [
                    'mata_pelajaran' => $n->mapel?->name ?? '-',
                    'nilai' => $n->rata_rata,
                ];
            }),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/guru/nilai",
     *     summary="Guru menginput nilai lengkap untuk siswa",
     *     tags={"Guru"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function inputNilai(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'kelas' => 'required|string',
            'proses_1' => 'required|numeric|min:0|max:100',
            'proses_2' => 'required|numeric|min:0|max:100',
            'proses_3' => 'required|numeric|min:0|max:100',
            'proses_4' => 'required|numeric|min:0|max:100',
            'uts' => 'required|numeric|min:0|max:100',
            'uas' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
        ]);

        $rata = round((
            $request->proses_1 +
            $request->proses_2 +
            $request->proses_3 +
            $request->proses_4 +
            $request->uts +
            $request->uas
        ) / 6, 2);

        $nilai = Nilai::create([
            'id_siswa' => $request->id_siswa,
            'kelas' => $request->kelas,
            'proses_1' => $request->proses_1,
            'proses_2' => $request->proses_2,
            'proses_3' => $request->proses_3,
            'proses_4' => $request->proses_4,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'rata_rata' => $rata,
            'catatan' => $request->catatan,
            'semester' => $request->semester,
            'tahun_akademik' => $request->tahun_akademik,
        ]);

        return response()->json([
            'message' => 'Nilai siswa berhasil disimpan.',
            'rata_rata' => $rata,
            'data' => $nilai
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/guru/laporan-akademik",
     *     summary="Menampilkan laporan akademik siswa",
     *     tags={"Guru"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function laporanAkademik(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
        ]);

        $nilai = Nilai::where('id_siswa', $request->siswa_id)
            ->where('semester', $request->semester)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->get();

        if ($nilai->isEmpty()) {
            return response()->json(['message' => 'Laporan belum tersedia.']);
        }

        $siswa = $nilai->first()->siswa;

        return response()->json([
            'kelas' => $siswa->kelas?->class ?? '-',
            'nama_siswa' => $siswa->nama,
            'tahun_akademik' => $request->tahun_akademik,
            'semester' => $request->semester,
            'nilai' => $nilai->map(function ($n) {
                return [
                    'mata_pelajaran' => $n->mapel?->name ?? '-',
                    'nilai' => $n->rata_rata,
                ];
            }),
            'catatan' => $nilai->first()->catatan ?? '',
        ]);
    }
}
