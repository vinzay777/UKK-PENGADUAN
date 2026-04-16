<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaProfileController extends Controller
{
    public function edit()
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Auth::guard('siswa')->user();

        return view('siswa.profile-siswa', compact('siswa'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Auth::guard('siswa')->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.max' => 'Kelas maksimal 50 karakter.',
            'current_password.required_with' => 'Password saat ini wajib diisi untuk mengganti password.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($request->filled('new_password') && ! Hash::check($request->current_password, $siswa->kata_sandi)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']));
        }

        $siswa->nama = $validated['nama'];
        $siswa->kelas = $validated['kelas'];

        if ($request->filled('new_password')) {
            $siswa->kata_sandi = $validated['new_password'];
        }

        $siswa->save();

        return redirect()
            ->route('siswa.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
