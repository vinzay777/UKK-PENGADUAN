<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FacilityHub - Sistem Pengaduan Sarana Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-dm { font-family: 'DM Mono', monospace; }
    </style>
</head>

<body class="h-screen overflow-hidden flex flex-col bg-[#EEEFE0] text-[#1A1917]">
    <header class="flex-shrink-0 bg-white border-b border-[#E5E2DD] px-5 py-2.5 flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-[#D4440C] rounded-lg flex items-center justify-center">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <div class="font-semibold text-[15px] leading-tight">FacilityHub</div>
                <div class="font-mono-dm text-[10px] text-[#7A7672] tracking-wide">Sistem Pengaduan Sarana Sekolah</div>
            </div>
        </div>

        {{-- @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="flex items-center gap-1.5 bg-[#D4440C] text-white text-xs font-medium px-4 py-1.5 rounded-lg hover:opacity-85 transition-opacity">
                    Dashboard
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="flex items-center gap-1.5 bg-[#D4440C] text-white text-xs font-medium px-4 py-1.5 rounded-lg hover:opacity-85 transition-opacity">
                    Masuk
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            @endauth
        @endif --}}
    </header>
    <main class="flex-1 overflow-hidden px-5 py-3.5 grid grid-cols-2 gap-3">

        <div class="bg-white border border-[#E5E2DD] rounded-2xl p-4 flex flex-col justify-between">
            <div>
                <div class="inline-flex items-center gap-1.5 bg-[#EEEFE0] text-[#57534E] text-[11px] font-medium px-2.5 py-1 rounded-full mb-3">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#57534E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 0-2-2Z"/><path d="M2 8h2"/><path d="M2 12h2"/><path d="M2 16h2"/></svg>
                    Layanan Pengaduan Fasilitas
                </div>
                <h1 class="text-[22px] font-semibold tracking-tight leading-snug text-[#1A1917] mb-2">
                    Pengaduan Sarana<br>dan Prasarana
                </h1>
                <p class="text-[12.5px] text-[#6B6763] leading-relaxed">
                    Halaman ini digunakan untuk penyampaian laporan kerusakan fasilitas sekolah,
                    pemantauan proses penanganan, dan pembaruan status hingga selesai.
                </p>
            </div>
            <div class="flex flex-wrap gap-1.5 mt-3">
                <span class="text-[11px] bg-[#FDF0EB] text-[#B53D10] px-2.5 py-1 rounded-md">Pelapor: Siswa</span>
                <span class="text-[11px] bg-[#EBF0FD] text-[#3150BF] px-2.5 py-1 rounded-md">Verifikator: Admin</span>
                <span class="text-[11px] bg-[#EDF7EE] text-[#2E7D32] px-2.5 py-1 rounded-md">Pelaksana: Admin</span>
            </div>
        </div>

        <div class="bg-white border border-[#E5E2DD] rounded-2xl p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-[12px] font-semibold text-[#1A1917]">Status Pengaduan</h2>
                <span class="font-mono-dm text-[10px] text-[#7A7672]">4 STATUS</span>
            </div>
            <div class="flex flex-col gap-1.5">
                <div class="flex items-center justify-between bg-[#F8F7F5] rounded-lg px-2.5 py-1.5">
                    <span class="flex items-center gap-2 text-[12px] text-[#6B6763]">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C26D39" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Menunggu
                    </span>
                    <span class="font-mono-dm text-[10px] text-[#7A7672]">PENDING</span>
                </div>
                <div class="flex items-center justify-between bg-[#F8F7F5] rounded-lg px-2.5 py-1.5">
                    <span class="flex items-center gap-2 text-[12px] text-[#6B6763]">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#3B5BDB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Diverifikasi
                    </span>
                    <span class="font-mono-dm text-[10px] text-[#7A7672]">VALID</span>
                </div>
                <div class="flex items-center justify-between bg-[#F8F7F5] rounded-lg px-2.5 py-1.5">
                    <span class="flex items-center gap-2 text-[12px] text-[#6B6763]">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Diproses
                    </span>
                    <span class="font-mono-dm text-[10px] text-[#7A7672]">ON PROGRESS</span>
                </div>
                <div class="flex items-center justify-between bg-[#F8F7F5] rounded-lg px-2.5 py-1.5">
                    <span class="flex items-center gap-2 text-[12px] text-[#6B6763]">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6B21A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        Selesai
                    </span>
                    <span class="font-mono-dm text-[10px] text-[#7A7672]">DONE</span>
                </div>
            </div>
        </div>

        <div class="bg-white border border-[#E5E2DD] rounded-2xl overflow-hidden">
            <div class="px-4 py-2.5 border-b border-[#E5E2DD] flex items-center justify-between">
                <h2 class="text-[12px] font-semibold text-[#1A1917]">Alur Penanganan</h2>
                <span class="font-mono-dm text-[10px] text-[#7A7672]">4 TAHAP</span>
            </div>
            <div class="grid grid-cols-4 divide-x divide-[#E5E2DD]">
                <div class="p-3">
                    <div class="font-mono-dm text-[10px] text-[#7A7672] tracking-widest mb-2">01</div>
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-[#FDF0EB] mb-2">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#D4440C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div class="text-[11px] font-semibold text-[#1A1917] mb-1">Pelaporan</div>
                    <div class="text-[11px] text-[#7A7672] leading-snug">Siswa isi formulir dan lampirkan foto.</div>
                </div>
                <div class="p-3">
                    <div class="font-mono-dm text-[10px] text-[#7A7672] tracking-widest mb-2">02</div>
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-[#EBF0FD] mb-2">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#3B5BDB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="text-[11px] font-semibold text-[#1A1917] mb-1">Verifikasi</div>
                    <div class="text-[11px] text-[#7A7672] leading-snug">Admin periksa laporan sebelum diteruskan.</div>
                </div>
                <div class="p-3">
                    <div class="font-mono-dm text-[10px] text-[#7A7672] tracking-widest mb-2">03</div>
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-[#EDF7EE] mb-2">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <div class="text-[11px] font-semibold text-[#1A1917] mb-1">Tindakan</div>
                    <div class="text-[11px] text-[#7A7672] leading-snug">Admin atur perbaikan sesuai prioritas.</div>
                </div>
                <div class="p-3">
                    <div class="font-mono-dm text-[10px] text-[#7A7672] tracking-widest mb-2">04</div>
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-[#F3EDFC] mb-2">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#6B21A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="text-[11px] font-semibold text-[#1A1917] mb-1">Selesai</div>
                    <div class="text-[11px] text-[#7A7672] leading-snug">Status diperbarui dan tersimpan.</div>
                </div>
            </div>
        </div>

        <div class="grid grid-rows-2 gap-3">
            <div class="bg-white border border-[#E5E2DD] rounded-2xl p-4">
                <h2 class="text-[12px] font-semibold text-[#1A1917] mb-2.5">Kategori Fasilitas</h2>
                <div class="grid grid-cols-2 gap-1.5">
                    <div class="bg-[#F8F7F5] rounded-lg px-2.5 py-1.5 flex items-center gap-2 text-[11px] text-[#6B6763]">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#7A7672" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        Ruang Kelas
                    </div>
                    <div class="bg-[#F8F7F5] rounded-lg px-2.5 py-1.5 flex items-center gap-2 text-[11px] text-[#6B6763]">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#7A7672" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                        Listrik & Penerangan
                    </div>
                    <div class="bg-[#F8F7F5] rounded-lg px-2.5 py-1.5 flex items-center gap-2 text-[11px] text-[#6B6763]">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#7A7672" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M2 12h20"/></svg>
                        Air & Sanitasi
                    </div>
                    <div class="bg-[#F8F7F5] rounded-lg px-2.5 py-1.5 flex items-center gap-2 text-[11px] text-[#6B6763]">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#7A7672" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"/><line x1="6" y1="2" x2="6" y2="4"/><line x1="10" y1="2" x2="10" y2="4"/><line x1="14" y1="2" x2="14" y2="4"/></svg>
                        Area Lingkungan
                    </div>
                </div>
            </div>
            <div class="bg-white border border-[#E5E2DD] rounded-2xl p-4 flex flex-col justify-between">
                <div>
                    <h2 class="text-[12px] font-semibold text-[#1A1917] mb-1.5">Akses Sistem</h2>
                    <p class="text-[11.5px] text-[#7A7672] leading-relaxed">Masuk ke dashboard untuk kirim pengaduan baru atau lihat riwayat laporan.</p>
                </div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="mt-3 inline-flex items-center justify-center gap-1.5 bg-[#D4440C] text-white text-xs font-medium px-4 py-2 rounded-lg hover:opacity-85 transition-opacity">
                            Buka Dashboard
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="mt-3 inline-flex items-center justify-center gap-1.5 bg-[#D4440C] text-white text-xs font-medium px-4 py-2 rounded-lg hover:opacity-85 transition-opacity">
                            Masuk Sistem
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    @endauth
                @endif
            </div>

        </div>

    </main>
    <footer class="flex-shrink-0 py-2 text-center text-[10.5px] text-[#7A7672]">
        FacilityHub · Sistem Informasi Pengaduan Sarana Sekolah
    </footer>

</body>
</html>
