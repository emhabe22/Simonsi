<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['loginError' => 'Email atau password salah']);
        }

        // Login menggunakan web guard (Sanctum akan handle session)
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect berdasarkan role
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'ortu' => redirect()->route('ortu.dashboard'),
        };
    }

 public function logout(Request $request)
    {
        // Logout user dari Sanctum session
        Auth::logout();
        
        // Hapus session
        $request->session()->invalidate();
        
        // Regenerate CSRF token untuk keamanan
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}