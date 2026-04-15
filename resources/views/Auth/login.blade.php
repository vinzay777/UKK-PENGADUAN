@extends('layouts.auth')

@section('title', 'Pilih Akses Masuk - FacilityHub')

@section('content')

<div class="relative z-10 w-full max-w-3xl mx-auto px-4">
    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-orange-200/50 md:flex md:min-h-[480px]">
        <div class="flex w-full md:w-1/2 bg-gradient-to-br from-orange-400 via-orange-500 to-orange-600 items-center justify-center p-6 sm:p-8 relative">

            <div class="text-center">
                <div class="mb-4 sm:mb-6">
                    <img
                        src="{{ asset('image/capyburu.png') }}"
                        class="w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 mx-auto object-contain capy-wave"
                    >
                </div>

                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold title-font text-white tracking-tight drop-shadow-lg">
                    FacilityHub
                </h1>
                <p class="mt-2 sm:mt-3 text-white/90 text-sm sm:text-base font-medium">
                    Satu Langkah Menuju Fasilitas yang Lebih Nyaman
                </p>
            </div>

        </div>
        <div class="w-full md:w-1/2 px-5 py-8 sm:px-6 sm:py-10 md:p-8 lg:p-10 flex flex-col justify-center">

            <div class="max-w-md mx-auto w-full">

                <h2 class="text-2xl md:text-3xl font-bold title-font text-gray-800 text-center md:text-left mb-3">
                    SELAMAT DATANG!
                </h2>

                <p class="text-gray-600 text-center md:text-left mb-6 text-sm">
                    Silakan pilih akses masuk untuk melanjutkan<br>
                    pengaduan atau manajemen fasilitas.
                </p>

                <!-- Tombol pilihan -->
                <div class="space-y-3">

                    <!-- Siswa -->
                          <a href="{{ route('login.siswa') }}"
                       class="group flex items-center w-full bg-white border-2 border-gray-300 hover:border-orange-500 rounded-xl px-5 py-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mr-4 group-hover:bg-orange-100 transition-colors">
                            <i class="fas fa-user-graduate text-xl text-orange-500"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-base text-gray-800 group-hover:text-orange-700">
                                Masuk Sebagai Siswa
                            </div>
                            <div class="text-sm text-gray-500">
                                Untuk pengaduan & melihat status
                            </div>
                        </div>
                    </a>

                    <!-- Admin -->
                    <a href="{{ route('login.admin') }}"
                       class="group flex items-center w-full bg-white border-2 border-gray-300 hover:border-blue-500 rounded-xl px-5 py-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mr-4 group-hover:bg-blue-100 transition-colors">
                            <i class="fas fa-user-tie text-xl text-blue-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-base text-gray-800 group-hover:text-blue-700">
                                Masuk Sebagai Admin
                            </div>
                            <div class="text-sm text-gray-500">
                                Kelola fasilitas & laporan
                            </div>
                        </div>
                    </a>

                </div>

                <!-- Optional footer text -->
                {{-- <p class="text-center text-xs text-gray-500 mt-6">
                    © {{ date('Y') }} FacilityHub • Dibuat dengan 🐾
                </p> --}}

            </div>
        </div>

    </div>
</div>

@endsection
