<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - FacilityHub')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #EEEFE0;
        }
        .title-font {
            font-family: 'Playfair Display', serif;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#EEEFE0] p-2 sm:p-4">

    {{-- Mobile Top Bar --}}
    <div class="lg:hidden flex items-center justify-between bg-gradient-to-r from-orange-500 to-orange-400 rounded-xl px-4 py-3 mb-3 shadow-lg">
        <div class="flex items-center gap-2">
            <img src="{{ asset('image/capyburu.png') }}" alt="Logo" class="w-12 h-12 object-contain">
            <span class="text-2xl font-bold title-font text-white">FacilityHub</span>
        </div>
        <button onclick="toggleSidebar()" class="text-white p-1 focus:outline-none">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    {{-- Sidebar Overlay --}}
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

    <div class="flex gap-3 sm:gap-4 max-w-[1600px] mx-auto">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 left-0 h-screen z-50 w-64 bg-gradient-to-b from-orange-400 via-orange-500 to-orange-600 p-6 flex flex-col shadow-xl -translate-x-full transition-transform duration-300 ease-in-out
            lg:relative lg:inset-auto lg:h-[calc(100vh-2rem)] lg:translate-x-0 lg:rounded-xl lg:flex-shrink-0">
            <!-- Logo -->
            <div class="flex items-center mb-3">
                <img src="{{ asset('image/capyburu.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                <h1 class="text-2xl font-bold title-font text-white">FacilityHub</h1>
            </div>
            <div class="border-b border-white -mx-6 mb-4"></div>
            <!-- Menu -->
            <div class="flex-1">
                <p class="text-white/70 text-sm font-medium mb-3">Menu</p>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3 text-white {{ request()->routeIs('siswa.dashboard')}} px-4 py-3 rounded-lg font-medium ">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.pengaduan') }}" class="flex items-center gap-3 text-white {{ request()->routeIs('siswa.pengaduan')}} px-4 py-3 rounded-lg font-medium">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i>
                            <span>Buat Pengaduan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.histori') }}" class="flex items-center gap-3 text-white {{ request()->routeIs('siswa.histori')}} px-4 py-3 rounded-lg font-medium">
                            <i data-lucide="history" class="w-5 h-5"></i>
                            <span>Histori Pengaduan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Info & Logout -->
            <div class="mt-auto">
                <a href="{{ route('siswa.profile') }}" class="block bg-white/10 rounded-lg p-4 mb-3 transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-white/40">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-semibold text-sm truncate">{{ Auth::guard('siswa')->user()->nama }}</p>
                            <p class="text-white/70 text-xs">Siswa / {{ Auth::guard('siswa')->user()->kelas }}</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-white/70"></i>
                    </div>
                </a>

                <form action="{{ route('siswa.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white/10  text-white px-4 py-3 rounded-lg font-medium transition">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 min-w-0 h-auto lg:h-[calc(100vh-2rem)] overflow-y-visible lg:overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">
            @yield('content')
        </div>
    </div>

    @stack('scripts')

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });

        lucide.createIcons();
    </script>
</body>
</html>
