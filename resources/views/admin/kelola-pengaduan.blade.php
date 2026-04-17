@extends('layouts.admin')

@section('title', 'Kelola Pengaduan - FacilityHub')

@section('content')
<div class="flex flex-col gap-4 pb-2">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-600">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-500">FacilityHub</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-gray-900 font-medium">Kelola Pengaduan</span>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="px-4 lg:px-6 pt-5 lg:pt-6 pb-3 border-b border-gray-100">
            <h1 class="text-lg lg:text-xl font-bold text-gray-800">List Pengaduan Keseluruhan</h1>
            <p class="text-sm text-gray-400 mt-0.5">Daftar lengkap semua pengaduan dengan filter advanced</p>

            {{-- Tabs --}}
            @php
                $tabs = [
                    ['label' => 'Semua', 'value' => 'semua'],
                    ['label' => 'Hari Ini', 'value' => 'hari_ini'],
                    ['label' => 'Minggu Ini', 'value' => 'minggu_ini'],
                    ['label' => 'Bulan Ini', 'value' => 'bulan_ini'],
                ];
                $activePeriode = $periode ?? request('periode', 'semua');
            @endphp
            <div class="flex flex-wrap gap-2 mt-4">
                @foreach ($tabs as $tab)
                    @php
                        $isActive = $activePeriode === $tab['value'];
                        $tabQuery = array_merge(request()->except(['page', 'periode']), ['periode' => $tab['value']]);
                    @endphp
                    <a href="{{ route('admin.kelola-pengaduan', $tabQuery) }}"
                        class="tab-btn px-3 lg:px-4 py-1.5 rounded-md text-xs lg:text-sm font-medium transition {{ $isActive ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50' }}">
                        {{ $tab['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="px-4 lg:px-6 py-4 flex flex-col gap-4">

            {{-- Stat Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-4 gap-3">
                @php
                    $statCards = [
                        ['label' => 'Total Pengaduan', 'value' => $stats['total'],      'color' => 'border-blue-500'],
                        ['label' => 'Hari Ini',        'value' => $stats['hari_ini'],   'color' => 'border-purple-500'],
                        ['label' => 'Minggu Ini',      'value' => $stats['minggu_ini'], 'color' => 'border-green-500'],
                        ['label' => 'Bulan Ini',       'value' => $stats['bulan_ini'],  'color' => 'border-yellow-500'],
                    ];
                @endphp
                @foreach ($statCards as $s)
                    <div class="border-l-4 {{ $s['color'] }} bg-white border border-gray-100 rounded-xl shadow-sm p-3 lg:p-4">
                        <p class="text-2xl font-bold text-gray-800">{{ $s['value'] }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $s['label'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Filter --}}
            <form id="filterForm" method="GET" action="{{ route('admin.kelola-pengaduan') }}">
                <input type="hidden" name="periode" value="{{ $activePeriode }}">
                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 items-end">
                        <div>
                            <label class="text-xs text-gray-500 mb-1 block">Siswa</label>
                            <input type="text" name="siswa" value="{{ request('siswa') }}" placeholder="Cari nama siswa..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 filter-text-input">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 mb-1 block">Kategori</label>
                            <select name="kategori_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 filter-select-input">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoris as $kat)
                                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 mb-1 block">Status</label>
                            <select name="status"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 filter-select-input">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai"  {{ request('status') === 'selesai'  ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        {{-- <div>
                            <label class="text-xs text-gray-500 mb-1 block">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Cari lokasi..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 filter-text-input">
                        </div> --}}
                        <div>
                            <label class="text-xs text-gray-500 mb-1 block">Urutkan</label>
                            <select name="sort"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 filter-select-input">
                                <option value="terbaru" {{ request('sort') !== 'terlama' ? 'selected' : '' }}>Terbaru</option>
                                <option value="terlama" {{ request('sort') === 'terlama' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </div>
                        <div class="flex gap-2 items-center justify-end">
                            @if(request()->hasAny(['periode','siswa','kategori_id','status','lokasi','sort']))
                            <a href="{{ route('admin.kelola-pengaduan') }}"
                                class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold py-2 px-3 rounded-lg transition flex items-center justify-center">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </a>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            </form>

            {{-- Export Bar --}}
            {{-- <div class="bg-white border border-gray-100 rounded-xl shadow-sm px-5 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="download" class="w-5 h-5 text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700">Export Data Aspirasi</p>
                    <p class="text-xs text-gray-400">Download data dalam format Excel atau PDF</p>
                </div>
            </div>
            <div class="flex gap-2">
                <button class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                    <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                    Export Excel
                </button>
                <button class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Export PDF
                </button>
            </div>
        </div> --}}

        </div>

        {{-- Table --}}
        <div class="px-4 lg:px-6 pb-4">
            <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[920px] text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wide">
                                <th class="px-4 py-3 text-left font-semibold">ID</th>
                                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Siswa</th>
                                <th class="px-4 py-3 text-left font-semibold">Judul Pengaduan</th>
                                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold">Lokasi</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php
                                $statusTw = [
                                    'menunggu' => 'bg-yellow-100 text-yellow-700',
                                    'diproses'  => 'bg-blue-100 text-blue-700',
                                    'selesai'   => 'bg-green-100 text-green-700',

                                ];
                            @endphp
                            @forelse ($pengaduan as $p)
                                @php
                                    $data = [
                                        'id'          => $p->id,
                                        'judul'       => $p->judul,
                                        'nama'        => $p->siswa->nama ?? '-',
                                        'nis'         => $p->siswa->nisn ?? '-',
                                        'kelas'       => $p->siswa->kelas ?? '-',
                                        'kat'         => $p->kategori->nama ?? '-',
                                        'lokasi'      => $p->lokasi,
                                        'deskripsi'   => $p->deskripsi,
                                        'status'      => $p->status,
                                        'foto'        => $p->foto ?? [],
                                        'tgl'         => optional($p->tanggal_lapor)->translatedFormat('d M Y') ?? '-',
                                        // 'time'        => now()->format('H:i'),
                                        'update_url'  => route('admin.pengaduan.status', $p->id),
                                    ];
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-blue-600 font-semibold">#ASP-{{ $p->id }}</td>
                                    <td class="px-4 py-3">
                                        <p class="text-gray-700 font-medium">{{ optional($p->tanggal_lapor)->translatedFormat('d M Y') ?? '-' }}</p>
                                        {{-- <p class="text-gray-400 text-xs">{{ now()->format('H:i')}}</p> --}}
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-blue-600 font-medium">{{ $p->siswa->nama ?? '-' }}</p>
                                        <p class="text-gray-400 text-xs">{{ $p->siswa->kelas ?? '' }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700 max-w-[180px] truncate">{{ $p->judul }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            {{ $p->kategori->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 max-w-[120px] truncate">{{ $p->lokasi }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusTw[$p->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ strtoupper($p->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            @if($p->status !== 'selesai')
                                            <button
                                                onclick="openModal({{ json_encode($data) }})"
                                                class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition"
                                                title="Detail & Update Status">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-400">Belum ada pengaduan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 lg:px-5 py-3 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <p class="text-xs text-gray-400">
                        Menampilkan {{ $pengaduan->firstItem() }}–{{ $pengaduan->lastItem() }} dari {{ $pengaduan->total() }} pengaduan
                    </p>
                    <div class="overflow-x-auto max-w-full">{{ $pengaduan->links() }}</div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('admin.partials.modal-feedback')

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            if (!filterForm) return;

            let debounceTimer;
            const submitFilter = () => filterForm.submit();

            filterForm.querySelectorAll('.filter-text-input').forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(submitFilter, 500);
                });

                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        clearTimeout(debounceTimer);
                        submitFilter();
                    }
                });
            });

            filterForm.querySelectorAll('.filter-select-input').forEach(select => {
                select.addEventListener('change', submitFilter);
            });
        });

        function openModal(data) {
            document.getElementById('m-id').textContent     = '#ASP-' + data.id;
            document.getElementById('m-siswa').textContent  = data.nama + ' (' + data.nis + ')';
            document.getElementById('m-tgl').textContent    = data.tgl ;
            document.getElementById('m-judul').textContent  = data.judul;
            document.getElementById('m-kat').textContent    = data.kat;
            document.getElementById('m-lokasi').textContent = data.lokasi;

            const deskEl = document.getElementById('m-deskripsi');
            if (deskEl) deskEl.textContent = data.deskripsi || '-';

            // Set form action for status update
            const form = document.getElementById('statusForm');
            if (form) form.action = data.update_url;

            // Show photos
            const fotoGrid = document.getElementById('m-foto-grid');
            if (fotoGrid) {
                fotoGrid.innerHTML = '';
                if (data.foto && data.foto.length > 0) {
                    data.foto.forEach(path => {
                        const img = document.createElement('img');
                        img.src = '/storage/' + path;
                        img.className = 'w-full h-28 object-cover rounded-lg border border-gray-200';
                        fotoGrid.appendChild(img);
                    });
                } else {
                    fotoGrid.innerHTML = '<p class="text-xs text-gray-400 col-span-2">Tidak ada foto.</p>';
                }
            }

            document.querySelectorAll('.status-btn').forEach(b => {
                const active = b.dataset.status.toLowerCase() === data.status.toLowerCase();
                b.className = b.className
                    .replace(/bg-\S+/g, '').replace(/text-\S+/g, '').replace(/border-\S+/g, '').trim();
                if (active) {
                    b.classList.add('bg-blue-600', 'text-white');
                } else {
                    b.classList.add('bg-white', 'text-gray-500', 'border', 'border-gray-200');
                }
            });

            const hiddenStatus = document.getElementById('m-status-input');
            if (hiddenStatus) hiddenStatus.value = data.status;

            const modal = document.getElementById('feedbackModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            lucide.createIcons();
        }

        function closeModal() {
            const modal = document.getElementById('feedbackModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function setStatus(el) {
            document.querySelectorAll('.status-btn').forEach(b => {
                b.classList.remove('bg-blue-600', 'text-white');
                b.classList.add('bg-white', 'text-gray-500', 'border', 'border-gray-200');
            });
            el.classList.add('bg-blue-600', 'text-white');
            el.classList.remove('bg-white', 'text-gray-500', 'border', 'border-gray-200');

            const hiddenStatus = document.getElementById('m-status-input');
            if (hiddenStatus) hiddenStatus.value = el.dataset.status;
        }

    </script>
@endpush
