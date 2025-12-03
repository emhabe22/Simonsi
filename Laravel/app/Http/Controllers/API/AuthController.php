<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;
use App\Models\Ortu;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login pengguna untuk mendapatkan token akses",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="admin@gmail.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login sukses"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        // Token base64 seperti middleware RoleMiddleware
       $token = $user->createToken('token_login')->plainTextToken;


        // ========= ROLE-BASED EXTRA DATA =========
        $extraData = [];

        if ($user->role === 'guru') {
            $guru = Guru::where('user_id', $user->id)->first();
            $extraData = [
                'id_guru' => $guru->id ?? null,
                'mapel_id' => $guru->mapel_id ?? null,
                'kelas_id' => $guru->kelas_id ?? null,
            ];
        }

        if ($user->role === 'ortu') {
            $ortu = Ortu::where('user_id', $user->id)->first();
            $anak = $ortu->siswa ?? null;

            $extraData = [
                'id_ortu' => $ortu->id ?? null,
                'nama_orangtua' => $ortu->nama ?? null,
                'id_anak' => $anak->id ?? null,
                'nama_anak' => $anak->nama ?? null,
                'kelas_anak' => $anak->kelas->class ?? null,
            ];
        }

        // ==========================================

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name ?? $user->nama,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'extra' => $extraData,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout pengguna dan mencabut token akses",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function logout()
    {
        // Token tidak disimpan, logout hanya pesan sukses
        return response()->json(['message' => 'Logout successful.']);
    }
}
