<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    /**
     * Tampilkan halaman login siswa
     */
    public function showLoginForm()
    {
        return view('Auth.login-siswa');
    }

    /**
     * Handle login siswa
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'nisn' => 'required|string|min:10|max:10',
            'password' => 'required|string|min:6',
        ]);

        // Coba login menggunakan guard siswa
        if (Auth::guard('siswa')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect ke dashboard siswa
            return redirect()->intended(route('siswa.dashboard'));
        }

        // Jika login gagal
        return back()->withErrors([
            'nisn' => 'NISN atau password salah.',
        ])->withInput($request->only('nisn'));
    }

    /**
     * Logout siswa
     */
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
