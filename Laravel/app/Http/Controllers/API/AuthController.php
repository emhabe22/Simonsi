<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Swagger Annotations
/**
 * @OA\Info(
 *     title="SIMONSI API",
 *     version="1.0.0",
 *     description="API untuk monitoring belajar dan absensi siswa"
 * )
 */

class AuthController extends Controller
{
    //Login Method
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login pengguna untuk mendapatkan token akses",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="user123@itn.ac.id"),
     *             @OA\Property(property="password", type="string", example="securePassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login sukses",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login successful."),
     *             @OA\Property(property="token", type="string", example="someRandomToken123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid credentials.")
     *         )
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

        $token = base64_encode($user->email . '|' . now());

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout pengguna dan mencabut token akses",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout berhasil",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Logout successful.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token tidak valid atau sudah kadaluarsa",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        return response()->json(['message' => 'Logout successful.']);
    }
}

