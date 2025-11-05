<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Ortu;
use App\Models\Guru;


class AdminController extends Controller
{
    //Dashboard 
    /**
 * @OA\Get(
 *     path="/api/admin/dashboard",
 *     summary="Menampilkan ringkasan data untuk admin",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data dashboard berhasil diambil",
 *         @OA\JsonContent(
 *             @OA\Property(property="total_guru", type="integer", example=15),
 *             @OA\Property(property="total_siswa", type="integer", example=200),
 *            @OA\Property(property="total_orang_tua", type="integer", example=480),
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
    $totalGuru = Guru::count();
    $totalSiswa = Siswa::count();
    $totalOrtu = Ortu::count();
    return response()->json([
        'total_guru' => $totalGuru,
        'total_siswa' => $totalSiswa,
        'total_orang_tua' => $totalOrtu,
    ]);
}

// Absensi 
   /**
 * @OA\Get(
 *     path="/api/admin/absensi",
 *     summary="Menampilkan data absensi semua siswa",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data absensi berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="nama_siswa", type="string", example="Ahmad Rizky"),
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
    $data = [
        [
            'nama_siswa' => 'Ahmad Rizky',
            'kelas' => '6A',
            'tanggal' => '2025-10-21',
            'status' => 'Hadir',
        ],
        [
            'nama_siswa' => 'Siti Aisyah',
            'kelas' => '6A',
            'tanggal' => '2025-10-21',
            'status' => 'Izin',
        ],
    ];

    return response()->json($data);
}

/**
 * @OA\Get(
 *     path="/api/admin/nilai",
 *     summary="Menampilkan data nilai semua siswa",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data nilai berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="nama_siswa", type="string", example="Ahmad Rizky"),
 *                 @OA\Property(property="kelas", type="string", example="6A"),
 *                 @OA\Property(property="tahun_akademik", type="string", example="2025/2026"),
 *                 @OA\Property(property="semester", type="string", example="Genap"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function nilai()
{
   
    $data = [
        [
            'nama_siswa' => 'Ahmad Rizky',
            'kelas' => '6A',
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
        ],
        [
            'nama_siswa' => 'Siti Aisyah',
            'kelas' => '6A',
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
        ]
    ];

    return response()->json($data);
}

// getNilai

/**
 * @OA\Get(
 *     path="/api/admin/getNilai",
 *     summary="Menampilkan data nilai dari semua mata pelajaran siswa",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data nilai berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="nama_siswa", type="string", example="Ahmad Rizky"),
 *                 @OA\Property(property="kelas", type="string", example="6A"),
 *                 @OA\Property(property="tahun_akademik", type="string", example="2025/2026"),
 *                 @OA\Property(property="semester", type="string", example="Genap"),
 *                 @OA\Property(property="mata_pelajaran", type="string", example="Matematika"),
 *                 @OA\Property(property="nilai", type="number", example=88.5)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
public function getNilai()
{
    $data = [
        [
            'nama_siswa' => 'Ahmad Rizky',
            'kelas' => '6A',
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
            'mata_pelajaran' => 'Matematika',
            'nilai' => 88.5
        ],
        [
            'nama_siswa' => 'Siti Aisyah',
            'kelas' => '6A',
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
            'mata_pelajaran' => 'Bahasa Indonesia',
            'nilai' => 92.0
        ]
    ];

    return response()->json($data);
}


// Laporan

/**
 * @OA\Get(
 *     path="/api/admin/laporan",
 *     summary="Menampilkan seluruh laporan akademik siswa",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Data laporan akademik berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="nama_siswa", type="string", example="Ahmad Rizky"),
 *                 @OA\Property(property="kelas", type="string", example="6A"),
 *                 @OA\Property(property="tahun_akademik", type="string", example="2025/2026"),
 *                 @OA\Property(property="semester", type="string", example="Genap"),
 *                 @OA\Property(
 *                     property="nilai",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="no", type="integer", example=1),
 *                         @OA\Property(property="mata_pelajaran", type="string", example="Matematika"),
 *                         @OA\Property(property="nilai", type="number", example=90)
 *                     )
 *                 ),
 *                 @OA\Property(property="catatan", type="string", example="Sudah siap untuk olimpiade.")
 *             )
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
    $laporan = [
        [
            'nama_siswa' => 'Ahmad Rizky',
            'kelas' => '6A',
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
            'nilai' => [
                ['no' => 1, 'mata_pelajaran' => 'Matematika', 'nilai' => 90],
                ['no' => 2, 'mata_pelajaran' => 'Olahraga', 'nilai' => 99],
            ],
            'catatan' => 'Sudah siap untuk olimpiade.'
        ],
        [
            'nama_siswa' => 'Siti Aisyah',
            'kelas' => '6A',
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
            'nilai' => [
                ['no' => 1, 'mata_pelajaran' => 'Bahasa Indonesia', 'nilai' => 95],
                ['no' => 2, 'mata_pelajaran' => 'IPA', 'nilai' => 89],
            ],
            'catatan' => 'Perlu peningkatan di mata pelajaran IPA.'
        ]
    ];

    return response()->json($laporan);
}

// ==============================================================================
//POST Methods Section
// ==============================================================================
// addGuru

/**
 * @OA\Post(
 *     path="/api/admin/addGuru",
 *     summary="Menambahkan data guru baru",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nama","email","password","nip"},
 *             @OA\Property(property="nama", type="string", example="Budi Santoso"),
 *             @OA\Property(property="email", type="string", example="budi@sekolah.ac.id"),
 *             @OA\Property(property="password", type="string", example="password123"),
 *             @OA\Property(property="nip", type="string", example="19850102 202001 1 001")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Guru berhasil ditambahkan",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Data guru berhasil disimpan.")
 *         )
 *     )
 * )
 */
public function addGuru(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'nip' => 'required|string'
    ]);

    $user = User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'guru'
    ]);
    Guru::create([
        'user_id' => $user->id,
        'nip' => $request->nip
    ]);

    return response()->json(['message' => 'Data guru berhasil disimpan.'], 201);
}


// addSiswa
/**
 * @OA\Post(
 *     path="/api/admin/addSiswa",
 *     summary="Menambahkan data siswa baru",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","nisn","address","gender","date_of_birth"},
 *             @OA\Property(property="name", type="string", example="Ahmad Rizky"),
 *            @OA\Property(property="address", type="string", example="Jl. Merpati No. 10, Jakarta"),
 *             @OA\Property(property="nisn", type="string", example="2025001"),
 *            @OA\Property(property="gender", type="string", example="male"),
 *            @OA\Property(property="date_of_birth", type="string", format="date", example="2015-08-15"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Siswa berhasil ditambahkan",
 *         @OA\JsonContent(
 *           @OA\Property(property="message", type="string", example="Data siswa berhasil disimpan.")
 *         )
 *     )
 * )
 */
public function addSiswa(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'nisn' => 'required|string|unique:siswas',
        'address'=> 'required|string',
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
    ]);

    Siswa::create([
        'name' => $request->name,
        'nisn' => $request->nisn,
        'address' => $request->address,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth, 
        'kelas_id' => 1, // Default kelas_id for simplicity
    ]);

    return response()->json(['message' => 'Data siswa berhasil disimpan.'], 201);
}

// addOrangTua

/**
 * @OA\Post(
 *     path="/api/admin/addOrtu",
 *     summary="Menambahkan data orang tua baru",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nama","email","password","no_hp","id_siswa"},
 *             @OA\Property(property="nama", type="string", example="Siti Nuraini"),
 *             @OA\Property(property="email", type="string", example="siti@gmail.com"),
 *             @OA\Property(property="password", type="string", example="password123"),
 *             @OA\Property(property="no_hp", type="string", example="081234567890"),
 *             @OA\Property(property="id_siswa", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Data orang tua berhasil ditambahkan",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Data orang tua berhasil disimpan.")
 *         )
 *     )
 * )
 */
public function addOrtu(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'phone' => 'required|string',
        'siswa_id' => 'required|exists:siswa,id'
    ]);

    $user = User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'ortu'
    ]);

    Ortu::create([
        'user_id' => $user->id,
        'siswa_id' => $request->id_siswa,
        'phone' => $request->phone
    ]);

    return response()->json(['message' => 'Data orang tua berhasil disimpan.'], 201);
}

// ==========================
// End of POST Methods Section
// ==========================

// GET Methods Section
// ==========================


/**
 * @OA\Get(
 *     path="/api/admin/guru",
 *     summary="Menampilkan daftar semua guru",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Daftar guru berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nama", type="string", example="Budi Santoso"),
 *                 @OA\Property(property="email", type="string", example="budi@sekolah.ac.id"),
 *                 @OA\Property(property="nip", type="string", example="19850102 202001 1 001")
 *             )
 *         )
 *     )
 * )
 */
public function getGuru()
{
    $guru = Guru::with('user:id,name,email')
        ->select('id', 'user_id', 'nip')
        ->get()
        ->map(function ($g) {
            return [
                'id' => $g->id,
                'name' => $g->user->name,
                'email' => $g->user->email,
                'nip' => $g->nip
            ];
        });

    return response()->json($guru);
}

/**
 * @OA\Get(
 *     path="/api/admin/siswa",
 *     summary="Menampilkan daftar semua siswa",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Daftar siswa berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Ahmad Rizky"),
 *                 @OA\Property(property="email", type="string", example="rizky@sekolah.ac.id"),
 *                 @OA\Property(property="nisn", type="string", example="2025001"),
 *                 @OA\Property(property="kelas", type="string", example="6A")
 *             )
 *         )
 *     )
 * )
 */
public function getSiswa()
{
    $siswa = Siswa::with('user:id,name,email')
        ->select('id', 'user_id', 'nisn', 'kelas')
        ->get()
        ->map(function ($s) {
            return [
                'id' => $s->id,
                'name' => $s->user->name,
                'email' => $s->user->email,
                'nisn' => $s->nisn,
                'kelas' => $s->kelas
            ];
        });

    return response()->json($siswa);
}

/**
 * @OA\Get(
 *     path="/api/admin/ortu",
 *     summary="Menampilkan daftar semua orang tua",
 *     tags={"Admin"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Daftar orang tua berhasil diambil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Siti Nuraini"),
 *                 @OA\Property(property="email", type="string", example="siti@gmail.com"),
 *                 @OA\Property(property="phone", type="string", example="081234567890"),
 *                 @OA\Property(property="nama_siswa", type="string", example="Ahmad Rizky")
 *             )
 *         )
 *     )
 * )
 */
public function getOrtu()
{
    $ortu = Ortu::with(['user:id,nama,email', 'siswa.user:id,nama'])
        ->select('id', 'user_id', 'siswa_id', 'phone')
        ->get()
        ->map(function ($o) {
            return [
                'id' => $o->id,
                'nama' => $o->user->nama,
                'email' => $o->user->email,
                'phone' => $o->phone,
                'nama_siswa' => $o->siswa->user->nama ?? null
            ];
        });

    return response()->json($ortu);
}


}
