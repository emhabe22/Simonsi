<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Nilai;
class GuruController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/guru/dashboard",
 *     summary="Menampilkan ringkasan data dashboard guru",
 *     tags={"Guru"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data dashboard berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="nama_guru", type="string", example="Budi Santoso"),
 *             @OA\Property(property="email", type="string", example="Budi@sdn1.sch.id"),
 *            @OA\Property(property="kelas", type="string", example="5A"),
 *             @OA\Property(property="mata_pelajaran", type="integer", example="Matematika"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function dashboard()
{
    $guru = Auth::user();

    $data = [
        'nama_guru' => $guru->nama ?? 'Budi Santoso',
        'email' => $guru->email,
        'kelas' => $guru->kelas ,
        'mata_pelajaran' => $guru->mata_pelajaran ?? 'Matematika',
    ];

    return response()->json($data);
}


/**
 * @OA\Put(
 *     path="/api/guru/absensi/{id}",
 *     summary="Guru mengedit status absensi siswa",
 *     tags={"Guru"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID absensi yang ingin diperbarui",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"status"},
 *             @OA\Property(
 *                 property="status",
 *                 type="string",
 *                 enum={"Hadir","Sakit","Izin","Kosong"},
 *                 example="Sakit"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Absensi berhasil diperbarui",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Absensi berhasil diperbarui."),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=5),
 *                 @OA\Property(property="id_siswa", type="integer", example=1),
 *                 @OA\Property(property="tanggal", type="string", format="date", example="2025-10-21"),
 *                 @OA\Property(property="status", type="string", example="Sakit")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Data absensi tidak ditemukan"
 *     )
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
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Daftar siswa dan nama orang tua berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id_siswa", type="integer", example=1),
 *                 @OA\Property(property="nama_siswa", type="string", example="Alice"),
 *                 @OA\Property(property="nama_ortu", type="string", example="Joko Susilo"),
 *                 @OA\Property(property="kelas", type="string", example="6A")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function getSiswaUntukNilai()
{
    $guru = Auth::user();

    $data = [
        [
            'id_siswa' => 1,
            'nama_siswa' => 'Alice',
            'nama_ortu' => 'Joko Susilo',
            'kelas' => '6A'
        ],
        [
            'id_siswa' => 2,
            'nama_siswa' => 'Anisa',
            'nama_ortu' => 'Jawara Susila',
            'kelas' => '6A'
        ]
    ];

    return response()->json($data);
}

/**
 * @OA\Get(
 *     path="/api/guru/nilai-siswa",
 *     summary="Menampilkan daftar nilai siswa berdasarkan tahun akademik dan semester",
 *     tags={"Guru"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data nilai siswa berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="nama_siswa", type="string", example="Michael Joko Nurcipto"),
 *             @OA\Property(property="tahun_akademik", type="string", example="2025/2026"),
 *             @OA\Property(property="semester", type="string", example="Genap"),
 *             @OA\Property(
 *                 property="nilai",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="no", type="integer", example=1),
 *                     @OA\Property(property="mata_pelajaran", type="string", example="Matematika"),
 *                     @OA\Property(property="nilai", type="number", example=90)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function getNilaiSiswa(Request $request)
{
    $data = [
        'nama_siswa' => 'Michael Joko Nurcipto',
        'tahun_akademik' => '2025/2026',
        'semester' => 'Genap',
        'nilai' => [
            ['no' => 1, 'mata_pelajaran' => 'Matematika', 'nilai' => 90],
            ['no' => 2, 'mata_pelajaran' => 'IPA', 'nilai' => 99]
        ]
    ];

    return response()->json($data);
}


/**
 * @OA\Post(
 *     path="/api/guru/nilai",
 *     summary="Guru menginput nilai lengkap untuk siswa (Proses, UTS, UAS, dan Catatan)",
 *     tags={"Guru"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id_siswa","kelas","proses_1","proses_2","proses_3","proses_4","uts","uas"},
 *             @OA\Property(property="id_siswa", type="integer", example=1),
 *             @OA\Property(property="kelas", type="string", example="6A"),
 *             @OA\Property(property="proses_1", type="number", example=85),
 *             @OA\Property(property="proses_2", type="number", example=87),
 *             @OA\Property(property="uts", type="number", example=90),
 *             @OA\Property(property="proses_3", type="number", example=88),
 *             @OA\Property(property="proses_4", type="number", example=89),
 *             @OA\Property(property="uas", type="number", example=93),
 *             @OA\Property(property="catatan", type="string", example="Aktif, perlu peningkatan di UTS"),
 *             @OA\Property(property="semester", type="string", example="Genap"),
 *             @OA\Property(property="tahun_akademik", type="string", example="2025/2026")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Nilai siswa berhasil disimpan",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Nilai siswa berhasil disimpan."),
 *             @OA\Property(property="rata_rata", type="number", example=88.7)
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validasi gagal"
 *     )
 * )
 */
public function inputNilai(Request $request)
{
    $request->validate([
        'id_siswa' => 'required|exists:siswa,id',
        'kelas' => 'required|string',
        'proses_1' => 'required|numeric|min:0|max:100',
        'proses_2' => 'required|numeric|min:0|max:100',
        'proses_3' => 'required|numeric|min:0|max:100',
        'proses_4' => 'required|numeric|min:0|max:100',
        'uts' => 'required|numeric|min:0|max:100',
        'uas' => 'required|numeric|min:0|max:100',
        'catatan' => 'nullable|string',
        'semester' => 'nullable|string',
        'tahun_akademik' => 'nullable|string'
    ]);

    // Hitung rata-rata otomatis
    $rata = round((
        $request->proses_1 +
        $request->proses_2 +
        $request->proses_3 +
        $request->proses_4 +
        $request->uts +
        $request->uas
    ) / 6, 2);

    // Simpan ke tabel nilai
    Nilai::create([
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
        'tahun_akademik' => $request->tahun_akademik
    ]);

    return response()->json([
        'message' => 'Nilai siswa berhasil disimpan.',
        'rata_rata' => $rata
    ], 201);
}

/**
 * @OA\Get(
 *     path="/api/guru/laporan-akademik",
 *     summary="Menampilkan laporan akademik siswa berdasarkan kelas, tahun akademik, dan semester",
 *     tags={"Guru"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Laporan akademik berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="kelas", type="string", example="6A"),
 *             @OA\Property(property="nama_siswa", type="string", example="Michael Joko Nurcipto"),
 *             @OA\Property(property="tahun_akademik", type="string", example="2025/2026"),
 *             @OA\Property(property="semester", type="string", example="Genap"),
 *             @OA\Property(
 *                 property="nilai",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="no", type="integer", example=1),
 *                     @OA\Property(property="mata_pelajaran", type="string", example="Matematika"),
 *                     @OA\Property(property="nilai", type="number", example=90)
 *                 )
 *             ),
 *             @OA\Property(property="catatan", type="string", example="Siswa aktif dan berprestasi di bidang olahraga.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function laporanAkademik(Request $request)
{
    // Contoh data dummy — nanti bisa query tabel nilai berdasarkan siswa, kelas, dan semester
    $laporan = [
        'kelas' => '6A',
        'nama_siswa' => 'Michael Joko Nurcipto',
        'tahun_akademik' => '2025/2026',
        'semester' => 'Genap',
        'nilai' => [
            ['no' => 1, 'mata_pelajaran' => 'Matematika', 'nilai' => 90],
            ['no' => 2, 'mata_pelajaran' => 'Olahraga', 'nilai' => 99],
        ],
        'catatan' => 'Siswa aktif dan berprestasi di bidang olahraga.'
    ];

    return response()->json($laporan);
}



}
