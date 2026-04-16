<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login-siswa');
    }


    public function login(Request $request)
    {

        $credentials = $request->validate([
            'nisn' => 'required|string|min:10|max:10',
            'password' => 'required|string|min:6',
        ]);


        if (Auth::guard('siswa')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('siswa.dashboard'));
        }


        return back()->withErrors([
            'nisn' => 'NISN atau password salah.',
        ])->withInput($request->only('nisn'));
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
