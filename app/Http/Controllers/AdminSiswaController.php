<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.form',['mode'=> 'create', 'siswa'=> new Siswa() ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nisn' => 'required|string|max:20|unique:siswa,nisn',
            'email' => 'required|email|max:100|unique:siswa,email',
            'kelas' => 'required|string|max:50',
            'kata_sandi' => 'required|string|min:6',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nisn.max' => 'NISN maksimal 20 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus format yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.max' => 'Email maksimal 100 karakter.',
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.max' => 'Kelas maksimal 50 karakter.',
            'kata_sandi.required' => 'Password wajib diisi.',
            'kata_sandi.min' => 'Password minimal 6 karakter.',
        ]);

        Siswa::create([
            'nama' => $validated['nama'],
            'nisn' => $validated['nisn'],
            'email' => $validated['email'],
            'kelas' => $validated['kelas'],
            'kata_sandi' => $validated['kata_sandi'],
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        return view('admin.siswa.form',['mode'=> 'edit', 'siswa' => $siswa ]);
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.form',['mode' => 'edit', 'siswa'=> $siswa ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nisn' => 'required|string|max:20|unique:siswa,nisn,' . $siswa->id,
            'email' => 'required|email|max:100|unique:siswa,email,' . $siswa->id,
            'kelas' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nisn.max' => 'NISN maksimal 20 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus format yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.max' => 'Email maksimal 100 karakter.',
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.max' => 'Kelas maksimal 50 karakter.',
        ]);

        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success','Siswa Berhasil Dihapus');
    }

}
