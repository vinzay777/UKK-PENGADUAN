<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        return view('admin.profile-admin', compact('admin'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'current_password.required_with' => 'Password saat ini wajib diisi untuk mengganti password.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($request->filled('new_password') && ! Hash::check($request->current_password, $admin->kata_sandi)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']));
        }

        $admin->nama = $validated['nama'];

        if ($request->filled('new_password')) {
            $admin->kata_sandi = $validated['new_password'];
        }

        $admin->save();

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
