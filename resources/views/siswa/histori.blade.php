@extends('layouts.siswa')

@section('title', 'Histori Pengaduan - FacilityHub')

@section('content')
<div class="flex flex-col h-full">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('siswa.dashboard') }}" class="hover:text-orange-500">FacilityHub</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-gray-900 font-medium">Histori Pengaduan</span>
    </div>

    @if(session('success'))
    <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-300 text-green-800 px-5 py-4 rounded-xl">
        <i data-lucide="check-circle" class="w-5 h-5 text-green-600 shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        <!-- Header -->
        <div class="flex items-center gap-2 mb-5 sm:mb-6">
            <i data-lucide="history" class="w-5 h-5 text-orange-500"></i>
            <h2 class="text-lg font-bold text-gray-900">Histori Pengaduan</h2>
        </div>

        <!-- Filter Status -->
        @php
            $filters = [
                'semua'    => 'Semua',
                'menunggu' => 'Menunggu',
                'diproses' => 'Sedang Diproses',
                'selesai'  => 'Selesai',
            ];
        @endphp
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($filters as $key => $label)
                <a href="{{ route('siswa.histori', ['status' => $key]) }}"
                   class="px-4 py-1.5 text-sm font-medium rounded-full transition
                          {{ $filter === $key
                             ? 'bg-orange-500 text-white'
                             : 'bg-gray-100 text-gray-600 hover:bg-orange-100 hover:text-orange-600' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- List Pengaduan -->
        <div class="space-y-4">

            @forelse($pengaduan as $p)
                @php
                    $statusMap = [
                        'menunggu' => ['label' => 'Menunggu',        'border' => 'border-yellow-400', 'hover' => 'hover:bg-yellow-50', 'badge' => 'bg-yellow-100 text-yellow-600'],
                        'diproses' => ['label' => 'Sedang Diproses', 'border' => 'border-blue-400',   'hover' => 'hover:bg-blue-50',   'badge' => 'bg-blue-100 text-blue-600'],
                        'selesai'  => ['label' => 'Selesai',         'border' => 'border-green-400',  'hover' => 'hover:bg-green-50',  'badge' => 'bg-green-100 text-green-600'],
                        'ditolak'  => ['label' => 'Ditolak',         'border' => 'border-red-400',    'hover' => 'hover:bg-red-50',    'badge' => 'bg-red-100 text-red-500'],
                    ];
                    $s = $statusMap[$p->status] ?? $statusMap['menunggu'];
                    $deskripsiPreview = \Illuminate\Support\Str::limit($p->deskripsi, 60);
                @endphp

                <div class="pengaduan-item flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-l-4 {{ $s['border'] }} bg-gray-50 rounded-r-xl pl-4 pr-4 sm:pr-5 py-4 cursor-pointer {{ $s['hover'] }} transition"
                    data-judul="{{ $p->judul }}"
                    data-lokasi="{{ $p->lokasi }}"
                    data-deskripsi="{{ $p->deskripsi }}"
                    data-kategori="{{ $p->kategori->nama ?? '-' }}"
                    data-tanggal="{{ $p->tanggal_lapor->locale('id')->translatedFormat('d F Y') }}"
                    data-status="{{ $s['label'] }}"
                    data-catatan-admin="-"
                    data-foto="{{ json_encode(array_map(fn($f) => asset('storage/'.$f), $p->foto ?? [])) }}">

                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900">{{ $p->judul }}</p>
                        <p class="text-sm text-blue-500 mt-0.5 truncate">{{ $p->lokasi }} - {{ $deskripsiPreview }}</p>
                        <div class="flex items-center gap-1 text-xs text-gray-400 mt-1">
                            <i data-lucide="clock" class="w-3 h-3"></i>
                            <span>{{ $p->created_at->locale('id')->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between sm:justify-end gap-3 sm:ml-4 shrink-0 w-full sm:w-auto">
                        <span class="text-xs font-medium {{ $s['badge'] }} px-3 py-1 rounded-full whitespace-nowrap">{{ $s['label'] }}</span>
                        <button class="text-gray-400 hover:text-orange-500 transition" title="Lihat Detail">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

            @empty
                <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                    <i data-lucide="inbox" class="w-14 h-14 mb-4 text-gray-300"></i>
                    <p class="text-base font-medium text-gray-500">Belum ada pengaduan</p>
                    <p class="text-sm mt-1">
                        @if($filter !== 'semua')
                            Tidak ada pengaduan dengan status <span class="font-semibold">{{ $filters[$filter] }}</span>.
                        @else
                            Kamu belum pernah mengirim pengaduan.
                        @endif
                    </p>
                    {{-- @if($filter === 'semua')
                    <a href="{{ route('siswa.pengaduan') }}" class="mt-4 px-5 py-2 bg-orange-500 text-white text-sm font-medium rounded-xl hover:bg-orange-600 transition">
                        Buat Pengaduan
                    </a>
                    @endif --}}
                </div>
            @endforelse

        </div>
    </div>
</div>

@include('siswa.partials.modal-detail-pengaduan')
@endsection
