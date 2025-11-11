<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrtuController extends Controller
{
    
/**
 * @OA\Get(
 *     path="/api/orangtua/dashboard",
 *     summary="Menampilkan ringkasan data dashboard orang tua",
 *     tags={"Orang Tua"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data dashboard berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="nama_orangtua", type="string", example="Siti Aminah"),
 *             @OA\Property(property="email", type="string", example="siti@sdn1.sch.id"),
 *             @OA\Property(property="nama_anak", type="string", example="Andi Saputra"),
 *             @OA\Property(property="kelas_anak", type="string", example="5A"),
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
    $orangtua = Auth::user();

    // misal relasi: $orangtua->anak dan $orangtua->anak->guru
    $anak = $orangtua->anak ?? null;

    $data = [
        'nama_orangtua' => $orangtua->nama ?? 'Siti Aminah',
        'email' => $orangtua->email,
        'nama_anak' => $anak->nama ?? 'Andi Saputra',
        'kelas_anak' => $anak->kelas ?? '5A',
    ];

    return response()->json($data);
}

// Laporan untuk Orang Tua

/**
 * @OA\Get(
 *     path="/api/orangtua/laporan",
 *     summary="Menampilkan laporan akademik anak dari orang tua yang login",
 *     tags={"Orang Tua"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data laporan akademik berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="nama_anak", type="string", example="Ahmad Rizky"),
 *             @OA\Property(property="kelas", type="string", example="6A"),
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
 *             @OA\Property(property="catatan", type="string", example="Sudah siap untuk olimpiade.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function laporan()
{
    $orangtua = Auth::user();

    // Contoh relasi: $orangtua->anak
    $anak = $orangtua->anak ?? null;

    // Jika data anak tersedia, ambil nilai-nilainya
    $laporan = [
        'nama_anak' => $anak->nama ?? 'Ahmad Rizky',
        'kelas' => $anak->kelas ?? '6A',
        'tahun_akademik' => '2025/2026',
        'semester' => 'Genap',
        'nilai' => [
            ['no' => 1, 'mata_pelajaran' => 'Matematika', 'nilai' => 90],
            ['no' => 2, 'mata_pelajaran' => 'Bahasa Indonesia', 'nilai' => 88],
        ],
        'catatan' => 'Anak menunjukkan perkembangan baik di semester ini.'
    ];

    return response()->json($laporan);
}

// Absensi untuk Orang Tua
/**
 * @OA\Get(
 *     path="/api/orangtua/absensi",
 *     summary="Menampilkan data absensi anak dari orang tua yang login",
 *     tags={"Orang Tua"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data absensi berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="nama_anak", type="string", example="Ahmad Rizky"),
 *                 @OA\Property(property="kelas", type="string", example="6A"),
 *                 @OA\Property(property="tanggal", type="string", format="date", example="2025-10-21"),
 *                 @OA\Property(property="status", type="string", example="Hadir")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function absensi()
{
    $orangtua = Auth::user();

    // Misal relasi: $orangtua->anak->absensi
    $anak = $orangtua->anak ?? null;

    $data = [
        [
            'nama_anak' => $anak->nama ?? 'Ahmad Rizky',
            'kelas' => $anak->kelas ?? '6A',
            'tanggal' => '2025-10-20',
            'status' => 'Hadir',
        ],
        [
            'nama_anak' => $anak->nama ?? 'Ahmad Rizky',
            'kelas' => $anak->kelas ?? '6A',
            'tanggal' => '2025-10-21',
            'status' => 'Izin',
        ],
        [
            'nama_anak' => $anak->nama ?? 'Ahmad Rizky',
            'kelas' => $anak->kelas ?? '6A',
            'tanggal' => '2025-10-22',
            'status' => 'Hadir',
        ],
    ];

    return response()->json($data);
}

/**
 * @OA\Get(
 *     path="/api/orangtua/nilai-anak",
 *     summary="Menampilkan nilai akademik anak dari orang tua yang login berdasarkan tahun akademik dan semester",
 *     tags={"Orang Tua"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data nilai anak berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="nama_anak", type="string", example="Michael Joko Nurcipto"),
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
public function getNilaiAnak(Request $request)
{
    $orangtua = Auth::user();

    // Misal relasi: $orangtua->anak
    $anak = $orangtua->anak ?? null;

    $data = [
        'nama_anak' => $anak->nama ?? 'Michael Joko Nurcipto',
        'tahun_akademik' => '2025/2026',
        'semester' => 'Genap',
        'nilai' => [
            ['no' => 1, 'mata_pelajaran' => 'Matematika', 'nilai' => 90],
            ['no' => 2, 'mata_pelajaran' => 'IPA', 'nilai' => 99]
        ]
    ];

    return response()->json($data);
}


}
