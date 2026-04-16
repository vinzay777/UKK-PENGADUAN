<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();

        $total      = Pengaduan::where('siswa_id', $siswa->id)->count();
        $menunggu   = Pengaduan::where('siswa_id', $siswa->id)->where('status', 'menunggu')->count();
        $diproses   = Pengaduan::where('siswa_id', $siswa->id)->where('status', 'diproses')->count();
        $selesai    = Pengaduan::where('siswa_id', $siswa->id)->where('status', 'selesai')->count();

        $pengaduanTerbaru = Pengaduan::with('kategori')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact('total', 'menunggu', 'diproses', 'selesai', 'pengaduanTerbaru'));
    }

    public function index()
    {
        $kategori = Kategori::orderBy('nama')->get();
        return view('siswa.pengaduan', compact('kategori'));
    }

    public function histori(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();
        $filter = $request->query('status', 'semua');

        $query = Pengaduan::with('kategori')
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc');

        if ($filter !== 'semua') {
            $query->where('status', $filter);
        }

        $pengaduan = $query->get();

        return view('siswa.histori', compact('pengaduan', 'filter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi'      => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|array|max:3',
            'foto.*'      => 'image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'judul.required'       => 'Judul pengaduan wajib diisi.',
            'judul.max'            => 'Judul maksimal 150 karakter.',
            'kategori_id.required' => 'Kategori fasilitas wajib dipilih.',
            'kategori_id.exists'   => 'Kategori tidak valid.',
            'lokasi.required'      => 'Lokasi wajib diisi.',
            'lokasi.max'           => 'Lokasi maksimal 100 karakter.',
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
            'foto.max'             => 'Maksimal 3 foto.',
            'foto.*.image'         => 'File harus berupa gambar.',
            'foto.*.mimes'         => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.*.max'           => 'Ukuran setiap foto maksimal 5MB.',
        ]);


        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('pengaduan', 'public');
                $fotoPaths[] = $path;
            }
        }

        $siswa = Auth::guard('siswa')->user();

        Pengaduan::create([
            'siswa_id'     => $siswa->id,
            'kategori_id'  => $validated['kategori_id'],
            'judul'        => $validated['judul'],
            'deskripsi'    => $validated['deskripsi'],
            'lokasi'       => $validated['lokasi'],
            'status'       => 'menunggu',
            'tanggal_lapor' => now()->toDateString(),
            'foto'         => !empty($fotoPaths) ? $fotoPaths : null,
        ]);

        return redirect()->route('siswa.histori')
            ->with('success', 'Pengaduan berhasil dikirim! Kami akan segera menindaklanjutinya.');
    }
}
