<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total    = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai  = Pengaduan::where('status', 'selesai')->count();

        $stats = compact('total', 'menunggu', 'diproses', 'selesai');

        $pengaduanTerbaru = Pengaduan::with(['siswa', 'kategori'])->latest()->take(5)->get();

        $kategoriStats = Kategori::withCount('pengaduan')->orderByDesc('pengaduan_count')->take(3)->get();

        $year = now()->year;
        $chartSelesai = $chartDiproses = $chartMenunggu = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartSelesai[]  = Pengaduan::where('status', 'selesai')->whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
            $chartDiproses[] = Pengaduan::where('status', 'diproses')->whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
            $chartMenunggu[] = Pengaduan::where('status', 'menunggu')->whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
        }

        return view('admin.dashboard', compact('stats', 'pengaduanTerbaru', 'kategoriStats', 'chartSelesai', 'chartDiproses', 'chartMenunggu'));
    }

    public function kelolaPengaduan(Request $request)
    {
        $query = Pengaduan::with(['siswa', 'kategori'])->latest();

        $periode = $request->input('periode', 'semua');
        $today = now()->toDateString();
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        if ($periode === 'hari_ini') {
            $query->whereDate('tanggal_lapor', $today);
        } elseif ($periode === 'minggu_ini') {
            $query->whereBetween('tanggal_lapor', [$startOfWeek, $endOfWeek]);
        } elseif ($periode === 'bulan_ini') {
            $query->whereBetween('tanggal_lapor', [$startOfMonth, $endOfMonth]);
        }

        if ($request->filled('siswa')) {
            $query->whereHas('siswa', fn($q) => $q->where('nama', 'like', '%' . $request->siswa . '%'));
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }
        if ($request->input('sort') === 'terlama') {
            $query->reorder('created_at', 'asc');
        }

        $pengaduan = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::all();

        $stats = [
            'total'      => Pengaduan::count(),
            'hari_ini'   => Pengaduan::whereDate('tanggal_lapor', $today)->count(),
            'minggu_ini' => Pengaduan::whereBetween('tanggal_lapor', [$startOfWeek, $endOfWeek])->count(),
            'bulan_ini'  => Pengaduan::whereBetween('tanggal_lapor', [$startOfMonth, $endOfMonth])->count(),
        ];

        return view('admin.kelola-pengaduan', compact('pengaduan', 'kategoris', 'stats', 'periode'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
            'feedback' => 'nullable|string',
            'foto_progres' => 'nullable|array',
            'foto_progres.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = [
            'status'          => $request->status,
            'tanggal_selesai' => $request->status === 'selesai' ? now() : null,
            'feedback'        => $request->feedback,
        ];

        // Handle foto progres
        if ($request->hasFile('foto_progres')) {
            $existingFotos = $pengaduan->foto_progres ?? [];

            foreach ($request->file('foto_progres') as $foto) {
                $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('pengaduan/progres', $filename, 'public');
                $existingFotos[] = 'pengaduan/progres/' . $filename;
            }

            $data['foto_progres'] = $existingFotos;
        }

        $pengaduan->update($data);

        return back()->with('success', 'Status dan feedback berhasil diperbarui.');
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['siswa', 'kategori']);

        return view('admin.detail-pengaduan', compact('pengaduan'));
    }
}
