@extends('layouts.siswa')

@section('title', 'Buat Pengaduan - FacilityHub')

@section('content')
<div class="flex flex-col h-full">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
        <a href="{{ route('siswa.dashboard') }}" class="hover:text-orange-500">FacilityHub</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-gray-900 font-medium">Buat Pengaduan</span>
    </div>

    {{-- @if(session('success'))
    <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-300 text-green-800 px-5 py-4 rounded-xl">
        <i data-lucide="check-circle" class="w-5 h-5 text-green-600 shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif --}}

    @if($errors->any())
    <div class="mb-4 flex items-start gap-3 bg-red-50 border border-red-300 text-red-800 px-5 py-4 rounded-xl">
        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 shrink-0 mt-0.5"></i>
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        <form action="{{ route('siswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl w-full">
            @csrf

            <!-- Informasi Dasar -->
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="info" class="w-5 h-5 text-orange-500"></i>
                    </div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900">Informasi Dasar</h2>
                </div>

                <!-- Judul Pengaduan -->
                <div class="mb-5">
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: AC Ruang Kelas Rusak"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('judul') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:border-orange-500 transition-colors"
                        required
                    >
                    @error('judul')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Buat judul yang singkat dan jelas (maksimal 150 karakter)</p>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Fasilitas <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="kategori_id"
                        name="kategori_id"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('kategori_id') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:border-orange-500 transition-colors appearance-none bg-white"
                        required
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="lokasi"
                        name="lokasi"
                        value="{{ old('lokasi') }}"
                        placeholder="Contoh: Ruang XII RPL 1, Lantai 2"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('lokasi') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:border-orange-500 transition-colors"
                        required
                    >
                    @error('lokasi')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Sebutkan lokasi spesifik termasuk lantai/gedung jika ada</p>
                    @enderror
                </div>
            </div>

            <div class="mb-8 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5 text-orange-500"></i>
                    </div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900">Detail Masalah</h2>
                </div>

                <div class="mb-5">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Jelaskan masalah yang terjadi secara detail... Contoh: AC tidak dingin dan mengeluarkan suara bising. Sudah tidak berfungsi sejak 3 hari yang lalu."
                        class="w-full px-4 py-3 border-2 {{ $errors->has('deskripsi') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:border-orange-500 transition-colors resize-none"
                        required
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Jelaskan kronologi dan kondisi masalah sejelas mungkin</p>
                    @enderror
                </div>
            </div>

            <div class="mb-8 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="camera" class="w-5 h-5 text-orange-500"></i>
                    </div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900">Foto Bukti (Opsional)</h2>
                </div>

                <div class="border-2 border-dashed border-gray-300 rounded-xl p-5 sm:p-8 text-center hover:border-orange-400 transition-colors cursor-pointer" id="dropzone">
                    <input type="file" id="foto" name="foto[]" multiple accept="image/png,image/jpg,image/jpeg" class="hidden" onchange="previewFoto(this)">
                    <div id="upload-area" class="cursor-pointer">
                        <label for="foto" class="cursor-pointer">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <p class="text-gray-700 font-medium mb-1">Klik atau seret foto ke sini</p>
                            <p class="text-sm text-gray-500">PNG, JPG hingga 5MB</p>
                        </label>
                    </div>
                    <div id="foto-preview" class="flex flex-wrap gap-4 justify-center mt-4"></div>
                </div>
                @error('foto')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
                @error('foto.*')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button
                    type="submit"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-orange-500 hover:to-orange-600 transition-all duration-300 hover:shadow-lg"
                >
                    {{-- <i data-lucide="send" class="w-5 h-5"></i> --}}
                    <span>Kirim Pengaduan</span>
                </button>

                {{-- <button
                    type="reset"
                    onclick="document.getElementById('foto-preview').innerHTML = ''"
                    class="flex items-center justify-center gap-2 bg-white border-2 border-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-50 transition-all duration-300"
                >
                    <span>Reset Form</span>
                </button> --}}
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
    const uploadArea = document.getElementById('upload-area');
    const dropzone = document.getElementById('dropzone');
    preview.innerHTML = '';

    if (input.files.length > 3) {
        alert('Maksimal 3 foto yang dapat diunggah.');
        input.value = '';
        return;
    }

    if (input.files.length > 0) {
        uploadArea.style.display = 'none';
        dropzone.classList.remove('border-2', 'border-dashed', 'border-gray-300', 'p-5', 'sm:p-8', 'hover:border-orange-400', 'cursor-pointer');
        dropzone.classList.add('p-0');
    } else {
        uploadArea.style.display = 'block';
        dropzone.classList.add('border-2', 'border-dashed', 'border-gray-300', 'p-5', 'sm:p-8', 'hover:border-orange-400', 'cursor-pointer');
        dropzone.classList.remove('p-0');
    }

    Array.from(input.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.createElement('div');
            container.className = 'flex flex-col items-center gap-2';

            const wrapper = document.createElement('div');
            wrapper.className = 'relative w-24 h-24';
            wrapper.innerHTML = `<img src="${e.target.result}" class="w-24 h-24 object-cover rounded-lg border-2 border-orange-300" />`;

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.onclick = function(e) {
                e.preventDefault();
                removeFoto(index);
            };
            deleteBtn.className = 'p-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors';
            deleteBtn.title = 'Hapus foto';
            deleteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';

            container.appendChild(wrapper);
            container.appendChild(deleteBtn);
            preview.appendChild(container);
        };
        reader.readAsDataURL(file);
    });
}

function removeFoto(index) {
    const input = document.getElementById('foto');
    const dt = new DataTransfer();
    const files = input.files;

    for (let i = 0; i < files.length; i++) {
        if (i !== index) {
            dt.items.add(files[i]);
        }
    }

    input.files = dt.files;
    previewFoto(input);
}
</script>
@endpush
@endsection
