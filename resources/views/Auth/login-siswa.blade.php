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

                <h2 class="text-2xl md:text-3xl font-bold title-font text-gray-800 text-center md:text-left mb-2">
                    Login sebagai siswa
                </h2>

                <p class="text-gray-600 text-center md:text-left mb-6 text-sm">
                    Masukkan NISN dan password untuk mengajukan pengaduan
                </p>

                <!-- Login Form -->
                <form action="{{ route('siswa.login') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- NISN Input -->
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                id="nisn"
                                name="nisn"
                                placeholder="1234567890"
                                value="{{ old('nisn') }}"
                                class="w-full pl-11 pr-4 py-3 border-2 @error('nisn') border-red-500 @else border-gray-300 @enderror rounded-xl focus:outline-none focus:border-orange-500 transition-colors"
                                required
                            >
                        </div>
                        @error('nisn')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                class="w-full pl-11 pr-4 py-3 border-2 @error('password') border-red-500 @else border-gray-300 @enderror rounded-xl focus:outline-none focus:border-orange-500 transition-colors"
                                required
                            >
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 space-y-3">
                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold py-3 px-6 rounded-xl hover:from-orange-500 hover:to-orange-600 transition-all duration-300 hover:shadow-lg">
                            Masuk
                        </button>

                        <!-- Back Button -->
                        <a href="{{ route('login') }}"
                           class="w-full inline-block text-center bg-white border-2 border-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-xl hover:bg-gray-50 transition-all duration-300">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
