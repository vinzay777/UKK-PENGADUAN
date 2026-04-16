@extends('layouts.admin')

@section('title', 'Dashboard - FacilityHub')

@section('content')
<div class="flex flex-col h-full gap-4">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-600">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-500">FacilityHub</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-gray-900 font-medium">Dashboard</span>
    </div>

    <div class="flex-1 overflow-y-auto flex flex-col gap-4 pb-2 [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        {{-- Header --}}
        <div class="bg-white rounded-xl shadow-sm px-4 sm:px-6 py-4 sm:py-5 flex items-start sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-lg sm:text-xl font-bold text-gray-800">Selamat Datang, {{ Auth::guard('admin')->user()->nama }}</h1>
                <p class="text-xs sm:text-sm text-gray-400 mt-0.5">Pantau dan kelola semua pengaduan dari sini.</p>
            </div>
            {{-- <div class="flex items-center gap-2 bg-blue-50 text-blue-600 text-sm font-medium px-4 py-2 rounded-lg">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
            </div> --}}
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4">
            @php
                $cards = [
                    [
                        'label' => 'Total Pengaduan',
                        'value' => $stats['total'],
                        'icon' => 'inbox',
                        'bg' => 'bg-blue-50',
                        'icon_color' => 'text-blue-600',
                        'val_color' => 'text-blue-700',
                        'border' => 'border-blue-200',
                    ],
                    [
                        'label' => 'Menunggu',
                        'value' => $stats['menunggu'],
                        'icon' => 'clock',
                        'bg' => 'bg-yellow-50',
                        'icon_color' => 'text-yellow-600',
                        'val_color' => 'text-yellow-700',
                        'border' => 'border-yellow-200',
                    ],
                    [
                        'label' => 'Sedang Diproses',
                        'value' => $stats['diproses'],
                        'icon' => 'loader',
                        'bg' => 'bg-purple-50',
                        'icon_color' => 'text-purple-600',
                        'val_color' => 'text-purple-700',
                        'border' => 'border-purple-200',
                    ],
                    [
                        'label' => 'Selesai',
                        'value' => $stats['selesai'],
                        'icon' => 'check-circle',
                        'bg' => 'bg-green-50',
                        'icon_color' => 'text-green-600',
                        'val_color' => 'text-green-700',
                        'border' => 'border-green-200',
                    ],
                ];
            @endphp
            @foreach ($cards as $c)
                <div class="bg-white border {{ $c['border'] }} rounded-xl shadow-sm p-4 sm:p-5 flex items-center gap-3 sm:gap-4">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 {{ $c['bg'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="{{ $c['icon'] }}" class="w-5 h-5 sm:w-6 sm:h-6 {{ $c['icon_color'] }}"></i>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-bold {{ $c['val_color'] }}">{{ $c['value'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $c['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

            {{-- Progress Status --}}
            <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-4 sm:p-5 xl:col-span-1">
                <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i data-lucide="bar-chart-2" class="w-4 h-4 text-blue-500"></i>
                    Progres Status
                </h2>
                <div class="space-y-3">
                    @php
                        $t = $stats['total'] ?: 1;
                        $progres = [
                            ['label' => 'Selesai',         'pct' => round($stats['selesai']  / $t * 100), 'bar' => 'bg-green-500',  'text' => 'text-green-600'],
                            ['label' => 'Sedang Diproses', 'pct' => round($stats['diproses'] / $t * 100), 'bar' => 'bg-purple-500', 'text' => 'text-purple-600'],
                            ['label' => 'Menunggu',        'pct' => round($stats['menunggu'] / $t * 100), 'bar' => 'bg-yellow-400', 'text' => 'text-yellow-600'],
                        ];
                    @endphp
                    @foreach ($progres as $p)
                        <div>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>{{ $p['label'] }}</span>
                                <span class="font-semibold {{ $p['text'] }}">{{ $p['pct'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="{{ $p['bar'] }} h-2 rounded-full" style="width:{{ $p['pct'] }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-4 border-t border-gray-100">
                    <h2 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <i data-lucide="tag" class="w-4 h-4 text-blue-500"></i>
                        Kategori Terbanyak
                    </h2>
                    <div class="space-y-2">
                        @php
                            $katColors = [
                                ['bg' => 'bg-blue-100',  'text' => 'text-blue-700'],
                                ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                                ['bg' => 'bg-gray-100',  'text' => 'text-gray-600'],
                            ];
                        @endphp
                        @forelse ($kategoriStats as $i => $k)
                            @php $color = $katColors[$i] ?? $katColors[2]; @endphp
                            <div class="flex items-center justify-between">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $color['bg'] }} {{ $color['text'] }}">{{ $k->nama }}</span>
                                <span class="text-sm font-bold text-gray-700">{{ $k->pengaduan_count }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-400">Belum ada data.</p>
                        @endforelse
                    </div>
                </div>
            </div>


            <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-4 sm:p-5 xl:col-span-2 flex flex-col ">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-bold text-gray-700 flex items-center gap-2">
                        <i data-lucide="list" class="w-4 h-4 text-blue-500"></i>
                        Pengaduan Terbaru
                    </h2>
                    <a href="{{ route('admin.kelola-pengaduan') }}"
                        class="text-xs text-blue-600 hover:underline font-medium flex items-center gap-1">
                        Lihat Semua
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </a>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full min-w-[680px] text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wide">
                                <th class="px-3 py-2 text-left font-semibold rounded-l-lg">ID</th>
                                <th class="px-3 py-2 text-left font-semibold">Siswa</th>
                                <th class="px-3 py-2 text-left font-semibold">Judul</th>
                                <th class="px-3 py-2 text-left font-semibold">Kategori</th>
                                <th class="px-3 py-2 text-left font-semibold rounded-r-lg">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php
                                $statusStyle = [
                                    'menunggu' => 'bg-yellow-100 text-yellow-700',
                                    'diproses'  => 'bg-blue-100 text-blue-700',
                                    'selesai'   => 'bg-green-100 text-green-700',

                                ];
                            @endphp
                            @forelse ($pengaduanTerbaru as $p)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-3 py-2.5 text-blue-600 font-semibold">#ASP-{{ $p->id }}</td>
                                    <td class="px-3 py-2.5 text-gray-700 font-medium">{{ $p->siswa->nama ?? '-' }}</td>
                                    <td class="px-3 py-2.5 text-gray-600 max-w-[160px] truncate">{{ $p->judul }}</td>
                                    <td class="px-3 py-2.5">
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">{{ $p->kategori->nama ?? '-' }}</span>
                                    </td>
                                    <td class="px-3 py-2.5">
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusStyle[$p->status] ?? 'bg-gray-100 text-gray-600' }}">{{ strtoupper($p->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-center text-sm text-gray-400">Belum ada pengaduan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Bar Chart: Aspirasi per Bulan --}}
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-4 sm:p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i data-lucide="bar-chart-2" class="w-4 h-4 text-blue-500"></i>
                    Pengaduan per Bulan
                </h2>
                <span class="text-xs text-gray-400">Tahun 2026</span>
            </div>
            <div class="overflow-x-auto">
                <canvas id="pengaduanBulananChart" height="90"></canvas>
            </div>
        </div>

    </div>{{-- end scrollable --}}
</div>{{-- end flex-col wrapper --}}
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pengaduanBulananChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Selesai',
                    data: {!! json_encode($chartSelesai) !!},
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderRadius: 6,
                },
                {
                    label: 'Diproses',
                    data: {!! json_encode($chartDiproses) !!},
                    backgroundColor: 'rgba(99,102,241,0.7)',
                    borderRadius: 6,
                },
                {
                    label: 'Menunggu',
                    data: {!! json_encode($chartMenunggu) !!},
                    backgroundColor: 'rgba(250,204,21,0.7)',
                    borderRadius: 6,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { size: 12, family: 'Plus Jakarta Sans' },
                        usePointStyle: true,
                        pointStyle: 'circle',
                    },
                },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.dataset.label}: ${ctx.parsed.y} pengaduan`,
                    },
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, family: 'Plus Jakarta Sans' } },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { font: { size: 11, family: 'Plus Jakarta Sans' }, stepSize: 5 },
                },
            },
        },
    });
</script>
@endpush
