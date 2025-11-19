<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Ortu;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Absensi;

class AdminController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admin/dashboard",
     *     summary="Dashboard admin: jumlah guru, siswa, orangtua",
     *     tags={"Admin"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Data dashboard berhasil diambil"
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function dashboard(Request $request)
    {
        $user = $request->user; // Dari RoleMiddleware

        return response()->json([
            'admin' => $user->name ?? 'Admin',
            'total_guru' => Guru::count(),
            'total_siswa' => Siswa::count(),
            'total_orang_tua' => Ortu::count(),
        ]);
    }

    // ========================================================
    // =============== CRUD GURU ==============================
    // ========================================================

    /**
     * @OA\Get(
     *     path="/api/admin/guru",
     *     summary="Menampilkan semua guru",
     *     tags={"Admin"},
     *     security={{"bearerAuth":{}}},
     * )
     */
    public function getGuru()
    {
        $guru = Guru::with(['kelas', 'mapel'])->get();
        return response()->json($guru);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/guru",
     *     summary="Tambah guru",
     *     tags={"Admin"},
     * )
     */
    public function addGuru(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
        ]);

        $guru = Guru::create($request->all());

        return response()->json(['message' => 'Guru berhasil ditambahkan', 'data' => $guru]);
    }

    /**
     * @OA\Put(
     *     path="/api/admin/guru/{id}",
     *     summary="Update guru",
     *     tags={"Admin"},
     * )
     */
    public function updateGuru(Request $request, $id)
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json(['message' => 'Guru tidak ditemukan'], 404);
        }

        $guru->update($request->all());
        return response()->json(['message' => 'Guru berhasil diperbarui', 'data' => $guru]);
    }

    /**
     * @OA\Delete(
     *     path="/api/admin/guru/{id}",
     *     summary="Hapus guru",
     *     tags={"Admin"},
     * )
     */
    public function deleteGuru($id)
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json(['message' => 'Guru tidak ditemukan'], 404);
        }

        $guru->delete();
        return response()->json(['message' => 'Guru berhasil dihapus']);
    }


    // ========================================================
    // =============== CRUD SISWA =============================
    // ========================================================

    public function getSiswa()
    {
        return response()->json(Siswa::with('kelas')->get());
    }

    public function addSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::create($request->all());

        return response()->json(['message' => 'Siswa berhasil ditambahkan', 'data' => $siswa]);
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $siswa->update($request->all());
        return response()->json(['message' => 'Siswa berhasil diperbarui', 'data' => $siswa]);
    }

    public function deleteSiswa($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $siswa->delete();
        return response()->json(['message' => 'Siswa berhasil dihapus']);
    }


    // ========================================================
    // =============== CRUD ORTU ==============================
    // ========================================================

    public function getOrtu()
    {
        return response()->json(
            Ortu::with(['siswa.kelas'])->get()
        );
    }

    public function addOrtu(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        $ortu = Ortu::create($request->all());

        return response()->json(['message' => 'Orang tua berhasil ditambahkan', 'data' => $ortu]);
    }

    public function updateOrtu(Request $request, $id)
    {
        $ortu = Ortu::find($id);

        if (!$ortu) {
            return response()->json(['message' => 'Orang tua tidak ditemukan'], 404);
        }

        $ortu->update($request->all());

        return response()->json(['message' => 'Orang tua berhasil diperbarui', 'data' => $ortu]);
    }

    public function deleteOrtu($id)
    {
        $ortu = Ortu::find($id);

        if (!$ortu) {
            return response()->json(['message' => 'Orang tua tidak ditemukan'], 404);
        }

        $ortu->delete();

        return response()->json(['message' => 'Orang tua berhasil dihapus']);
    }


    // ========================================================
    // =============== DATA ABSENSI (OA DIPERTAHANKAN) =======
    // ========================================================

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
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function absensi()
    {
        $abs = Absensi::with(['siswa.kelas'])->orderBy('date', 'desc')->get();

        $data = $abs->map(function ($a) {
            return [
                'nama_siswa' => $a->siswa->nama ?? '-',
                'kelas' => $a->siswa->kelas->class ?? '-',
                'tanggal' => $a->date,
                'status' => ucfirst($a->status),
            ];
        });

        return response()->json($data);
    }
}
