@extends('layouts.siswa')

@section('title', 'Dashboard - FacilityHub')

@push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.45s ease both;
        }

        .delay-1 {
            animation-delay: 0.05s;
        }

        .delay-2 {
            animation-delay: 0.10s;
        }

        .delay-3 {
            animation-delay: 0.15s;
        }

        .delay-4 {
            animation-delay: 0.20s;
        }
    </style>
@endpush

@section('content')
    <div class="flex flex-col h-full">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="{{ route('siswa.dashboard') }}" class="hover:text-orange-500">FacilityHub</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-gray-900 font-medium">Dashboard</span>
        </div>

        <div
            class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <div
                class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-orange-500 via-orange-400 to-amber-400 p-4 sm:p-6 mb-6 sm:mb-8 shadow-lg fade-in-up">
                <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-10 right-20 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute top-4 right-36 w-10 h-10 bg-white/10 rounded-full"></div>

                <div class="relative flex items-start sm:items-center justify-between gap-3">
                    <div>
                        <p class="text-white/80 text-sm font-medium mb-1">Selamat datang kembali</p>
                        <h2 class="text-white text-xl sm:text-2xl font-bold">{{ Auth::guard('siswa')->user()->nama }}</h2>
                        {{-- <p class="text-white/70 text-sm mt-1">{{ now()->translatedFormat('l, d F Y') }}</p> --}}
                    </div>
                    {{-- <a href="{{ route('siswa.pengaduan') }}"
                        class="hidden md:flex items-center gap-2 bg-white text-orange-500 font-semibold text-sm px-5 py-2.5 rounded-xl shadow hover:shadow-md hover:bg-orange-50 transition">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        Buat Pengaduan
                    </a> --}}
                </div>

                <a href="{{ route('siswa.pengaduan') }}"
                    class="mt-4 inline-flex md:hidden items-center gap-2 bg-white text-orange-500 font-semibold text-sm px-4 py-2 rounded-xl shadow hover:bg-orange-50 transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    Buat Pengaduan
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Total Pengaduan</p>
                            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $total }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <i data-lucide="clipboard-list" class="w-6 h-6 text-orange-500"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Menunggu</p>
                            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $menunggu }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i data-lucide="clock" class="w-6 h-6 text-blue-500"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Sedang Diproses</p>
                            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $diproses }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i data-lucide="loader" class="w-6 h-6 text-purple-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Selesai</p>
                            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $selesai }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if ($total > 0)
                <div
                    class="bg-gradient-to-r from-gray-50 to-orange-50 border border-orange-100 rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8 fade-in-up">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="bar-chart-2" class="w-5 h-5 text-orange-500"></i>
                        <h2 class="text-base font-bold text-gray-900">Ringkasan Status</h2>
                    </div>
                    <div class="space-y-3">
                        @php
                            $bars = [
                                ['label' => 'Menunggu', 'value' => $menunggu, 'color' => 'bg-yellow-400'],
                                ['label' => 'Sedang Diproses', 'value' => $diproses, 'color' => 'bg-blue-500'],
                                ['label' => 'Selesai', 'value' => $selesai, 'color' => 'bg-green-500'],
                            ];
                        @endphp
                        @foreach ($bars as $bar)
                            <div>
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>{{ $bar['label'] }}</span>
                                    <span class="font-semibold text-gray-700">{{ $bar['value'] }} /
                                        {{ $total }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="{{ $bar['color'] }} h-2.5 rounded-full transition-all duration-700"
                                        style="width: {{ $total > 0 ? round(($bar['value'] / $total) * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="fade-in-up">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="history" class="w-4 h-4 text-orange-500"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Pengaduan Terbaru</h2>
                    </div>
                    <a href="{{ route('siswa.histori') }}"
                        class="text-xs text-orange-500 font-semibold hover:underline flex items-center gap-1">
                        Lihat semua
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($pengaduanTerbaru as $index => $item)
                        @php
                            $statusConfig = match ($item->status) {
                                'menunggu' => [
                                    'border' => 'border-yellow-400',
                                    'bg' => 'bg-yellow-100',
                                    'text' => 'text-yellow-700',
                                    'dot' => 'bg-yellow-400',
                                    'label' => 'Menunggu',
                                ],
                                'diproses' => [
                                    'border' => 'border-blue-400',
                                    'bg' => 'bg-blue-100',
                                    'text' => 'text-blue-700',
                                    'dot' => 'bg-blue-400',
                                    'label' => 'Sedang Diproses',
                                ],
                                'selesai' => [
                                    'border' => 'border-green-400',
                                    'bg' => 'bg-green-100',
                                    'text' => 'text-green-700',
                                    'dot' => 'bg-green-400',
                                    'label' => 'Selesai',
                                ],
                                'ditolak' => [
                                    'border' => 'border-red-400',
                                    'bg' => 'bg-red-100',
                                    'text' => 'text-red-600',
                                    'dot' => 'bg-red-400',
                                    'label' => 'Ditolak',
                                ],
                                default => [
                                    'border' => 'border-gray-400',
                                    'bg' => 'bg-gray-100',
                                    'text' => 'text-gray-600',
                                    'dot' => 'bg-gray-400',
                                    'label' => ucfirst($item->status),
                                ],
                            };
                        @endphp
                        <div
                            class="group flex items-start sm:items-center gap-3 sm:gap-4 bg-white border border-gray-100 rounded-2xl p-3 sm:p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-l-4 {{ $statusConfig['border'] }}">

                            <div
                                class="w-8 h-8 bg-orange-50 text-orange-400 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">
                                {{ $index + 1 }}
                            </div>


                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 truncate">{{ $item->judul }}</p>
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-0.5">
                                    @if ($item->lokasi)
                                        <span class="flex items-center gap-1 text-xs text-gray-500">
                                            <i data-lucide="map-pin" class="w-3 h-3"></i>
                                            {{ $item->lokasi }}
                                        </span>
                                    @endif
                                    <span class="flex items-center gap-1 text-xs text-gray-400">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                @if ($item->deskripsi)
                                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ str($item->deskripsi)->limit(70) }}
                                    </p>
                                @endif
                            </div>


                            <span
                                class="flex-shrink-0 inline-flex items-center gap-1.5 text-[11px] sm:text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} px-2.5 sm:px-3 py-1.5 rounded-full">
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mb-3">
                                <i data-lucide="inbox" class="w-8 h-8 text-orange-300"></i>
                            </div>
                            <p class="text-sm font-medium">Belum ada pengaduan</p>
                            <p class="text-xs mt-1">Tekan tombol "Buat Pengaduan" untuk memulai</p>
                            <a href="{{ route('siswa.pengaduan') }}"
                                class="mt-4 flex items-center gap-2 bg-orange-500 text-white text-sm font-semibold px-5 py-2 rounded-xl hover:bg-orange-600 transition">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                Buat Pengaduan
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection
