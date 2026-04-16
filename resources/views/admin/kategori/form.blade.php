@extends('layouts.admin')

@php
	$isCreate = $mode === 'create';
	$isEdit = $mode === 'edit';
	$isShow = $mode === 'show';
@endphp

@section('title', ($isCreate ? 'Tambah' : ($isEdit ? 'Edit' : 'Profil')) . ' Kategori - FacilityHub')

@section('content')
<div class="flex flex-col h-full">
	<div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
		<a href="{{ route('admin.kategori.index') }}" class="hover:text-orange-500">Kelola Kategori</a>
		<i data-lucide="chevron-right" class="w-3 h-3"></i>
		<span class="text-gray-900 font-medium">
			@if($isCreate) Tambah Kategori @elseif($isEdit) Edit Kategori @else Profil Kategori @endif
		</span>
	</div>

	<div class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
		@if($isShow)
			<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
				<div class="xl:col-span-1 space-y-6">
					<div class="rounded-3xl bg-orange-500 p-6 text-white shadow-lg">
						<h1 class="text-2xl font-bold">{{ $kategori->nama }}</h1>
						<p class="text-white/80 mt-1">Kategori Fasilitas</p>

						<div class="mt-6 space-y-3 text-sm">
							<div class="flex items-start gap-3 bg-white/10 rounded-2xl p-3">
								<i data-lucide="tag" class="w-5 h-5 mt-0.5"></i>
								<div>
									<p class="text-white/70 text-xs uppercase tracking-wide">Nama Kategori</p>
									<p class="font-semibold">{{ $kategori->nama }}</p>
								</div>
							</div>
							<div class="flex items-start gap-3 bg-white/10 rounded-2xl p-3">
								<i data-lucide="bar-chart-3" class="w-5 h-5 mt-0.5"></i>
								<div>
									<p class="text-white/70 text-xs uppercase tracking-wide">Total Pengaduan</p>
									<p class="font-semibold">{{ $kategori->pengaduan->count() }} pengaduan</p>
								</div>
							</div>
						</div>
					</div>

					<div class="bg-orange-50 border border-orange-100 rounded-3xl p-5">
						<div class="flex items-start gap-3">
							<div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-orange-500 shadow-sm">
								<i data-lucide="info" class="w-5 h-5"></i>
							</div>
							<div>
								<h2 class="font-semibold text-gray-900">Data Kategori</h2>
								<p class="text-sm text-gray-600 mt-1">Informasi kategori fasilitas dari sistem</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Column - Details -->
				<div class="xl:col-span-2">
					<div class="bg-white border border-gray-100 rounded-3xl p-5 sm:p-7 shadow-sm space-y-6">
						<div>
							<h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Lengkap</h2>

							<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Nama Kategori</p>
									<p class="text-lg font-semibold text-gray-900">{{ $kategori->nama }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total Pengaduan</p>
									<p class="text-lg font-semibold text-gray-900">{{ $kategori->pengaduan->count() }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Dibuat</p>
									<p class="text-lg font-semibold text-gray-900">{{ $kategori->created_at->format('d M Y') }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Terakhir Diperbarui</p>
									<p class="text-lg font-semibold text-gray-900">{{ $kategori->updated_at->format('d M Y') }}</p>
								</div>
							</div>
						</div>

						<div class="border-t border-dashed border-gray-200 pt-4">
							<div class="flex flex-col sm:flex-row gap-3">
								<a
									href="{{ route('admin.kategori.edit', $kategori) }}"
									class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600"
								>
									<i data-lucide="edit" class="w-4 h-4"></i>
									Edit Kategori
								</a>

								<form id="deleteFormKategori" action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" style="display: none;">
									@csrf
									@method('DELETE')
								</form>
								<button
									type="button"
									onclick="openDeleteModal(document.getElementById('deleteFormKategori'), 'Apakah Anda yakin ingin menghapus kategori &quot;{{ $kategori->nama }}&quot;? Semua pengaduan yang terkait akan tetap ada tanpa label kategori.')"
									class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-red-100 px-5 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-200"
								>
									<i data-lucide="trash-2" class="w-4 h-4"></i>
									Hapus Kategori
								</button>

								<a
									href="{{ route('admin.kategori.index') }}"
									class="inline-flex items-center justify-center gap-2 rounded-2xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
								>
									<i data-lucide="arrow-left" class="w-4 h-4"></i>
									Kembali
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- CREATE & EDIT MODE -->
		@else
			<div class="max-w-2xl">
				<!-- Header -->
				<div class="flex items-center gap-3 mb-6">
					<div class="w-11 h-11 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center">
						<i data-lucide="{{ $isCreate ? 'plus-circle' : 'edit-3' }}" class="w-5 h-5"></i>
					</div>
					<div>
						<h2 class="text-xl font-bold text-gray-900">
							@if($isCreate) Tambah Kategori Fasilitas Baru @else Edit Kategori Fasilitas @endif
						</h2>
						<p class="text-sm text-gray-500">
							@if($isCreate) Isi form di bawah untuk menambahkan kategori fasilitas baru @else Perbarui informasi kategori fasilitas @endif
						</p>
					</div>
				</div>

				<!-- Error Messages -->
				@if($errors->any())
					<div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
						<p class="font-semibold mb-2">Terdapat beberapa kesalahan:</p>
						<ul class="list-disc pl-5 space-y-1">
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<!-- Form -->
				<form
					action="{{ $isCreate ? route('admin.kategori.store') : route('admin.kategori.update', $kategori) }}"
					method="POST"
					class="space-y-6"
				>
					@csrf
					@if($isEdit) @method('PUT') @endif

					<div>
						<label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori Fasilitas</label>
						<input
							type="text"
							id="nama"
							name="nama"
							value="{{ old('nama', $kategori->nama ?? '') }}"
							class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 @error('nama') border-red-500 @enderror"
							placeholder="Contoh: Toilet, Air Bersih, Listrik, Kursi, dll"
							required
						>
						@error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
						{{-- <p class="text-gray-500 text-xs mt-2">Nama kategori harus unik dan deskriptif</p> --}}
					</div>

					<!-- Action Buttons -->
					<div class="flex flex-col sm:flex-row gap-3 border-t border-dashed border-gray-200 pt-6">
						<button
							type="submit"
							class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600"
						>
							<i data-lucide="check" class="w-4 h-4"></i>
							{{ $isCreate ? 'Tambah Kategori' : 'Simpan Perubahan' }}
						</button>

						<a
							href="{{ route('admin.kategori.index') }}"
							class="inline-flex items-center justify-center gap-2 rounded-2xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
						>
							<i data-lucide="x" class="w-4 h-4"></i>
							Batal
						</a>
					</div>
				</form>
			</div>
		@endif
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		lucide.createIcons();
	});
</script>
@endsection
