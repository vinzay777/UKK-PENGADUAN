<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('pengaduan')->latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.form', ['mode' => 'create', 'kategori' => new Kategori()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
            'nama.unique' => 'Kategori dengan nama tersebut sudah ada.',
        ]);

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori fasilitas berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        $kategori->load('pengaduan');
        return view('admin.kategori.form', ['mode' => 'show', 'kategori' => $kategori]);
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.form', ['mode' => 'edit', 'kategori' => $kategori]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama,' . $kategori->id,
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
            'nama.unique' => 'Kategori dengan nama tersebut sudah ada.',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.show', $kategori)->with('success', 'Kategori fasilitas berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori fasilitas berhasil dihapus.');
    }
}
