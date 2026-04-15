@extends('layouts.admin')

@php
	$isCreate = $mode === 'create';
	$isEdit = $mode === 'edit';
	$isShow = $mode === 'show';
@endphp

@section('title', ($isCreate ? 'Tambah' : ($isEdit ? 'Edit' : 'Profil')) . ' Siswa - FacilityHub')

@section('content')
<div class="flex flex-col h-full">
	<!-- Breadcrumb -->
	<div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
		<a href="{{ route('admin.siswa.index') }}" class="hover:text-orange-500">Kelola Siswa</a>
		<i data-lucide="chevron-right" class="w-3 h-3"></i>
		<span class="text-gray-900 font-medium">
			@if($isCreate) Tambah Siswa @elseif($isEdit) Edit Siswa @else Profil Siswa @endif
		</span>
	</div>

	<!-- Main Content -->
	<div class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
		<!-- SHOW MODE -->
		@if($isShow)
			<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
				<div class="xl:col-span-1 space-y-6">
					<!-- Orange Info Card -->
					<div class="rounded-3xl bg-orange-500 p-6 text-white shadow-lg">
						<h1 class="text-2xl font-bold">{{ $siswa->nama }}</h1>
						<p class="text-white/80 mt-1">Lihat profil lengkap siswa</p>

						<div class="mt-6 space-y-3 text-sm">
							<div class="flex items-start gap-3 bg-white/10 rounded-2xl p-3">
								<i data-lucide="badge-check" class="w-5 h-5 mt-0.5"></i>
								<div>
									<p class="text-white/70 text-xs uppercase tracking-wide">NISN</p>
									<p class="font-semibold">{{ $siswa->nisn }}</p>
								</div>
							</div>
							<div class="flex items-start gap-3 bg-white/10 rounded-2xl p-3">
								<i data-lucide="graduation-cap" class="w-5 h-5 mt-0.5"></i>
								<div>
									<p class="text-white/70 text-xs uppercase tracking-wide">Kelas</p>
									<p class="font-semibold">{{ $siswa->kelas }}</p>
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
								<h2 class="font-semibold text-gray-900">Data Siswa</h2>
								<p class="text-sm text-gray-600 mt-1">Informasi profil lengkap siswa dari sistem</p>
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
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</p>
									<p class="text-lg font-semibold text-gray-900">{{ $siswa->nama }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">NISN</p>
									<p class="text-lg font-semibold text-gray-900">{{ $siswa->nisn }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">

									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Kelas</p>
									<p class="text-lg font-semibold text-gray-900">{{ $siswa->kelas }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Didaftar</p>
									<p class="text-lg font-semibold text-gray-900">{{ $siswa->created_at->format('d M Y') }}</p>
								</div>

								<div class="bg-gray-50 rounded-2xl p-4">
									<p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Terakhir Diperbarui</p>
									<p class="text-lg font-semibold text-gray-900">{{ $siswa->updated_at->format('d M Y') }}</p>
								</div>
							</div>
						</div>

						<div class="border-t border-dashed border-gray-200 pt-4">
							<div class="flex flex-col sm:flex-row gap-3">
								<a
									href="{{ route('admin.siswa.edit', $siswa) }}"
									class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600"
								>
									<i data-lucide="edit" class="w-4 h-4"></i>
									Edit Siswa
								</a>

								<form id="deleteFormSiswa" action="{{ route('admin.siswa.destroy', $siswa) }}" method="POST" style="display: none;">
									@csrf
									@method('DELETE')
								</form>
								<button
									type="button"
									onclick="openDeleteModal(document.getElementById('deleteFormSiswa'), 'Apakah Anda yakin ingin menghapus siswa &quot;{{ $siswa->nama }}&quot;? Tindakan ini tidak dapat dibatalkan.')"
									class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-red-100 px-5 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-200"
								>
									<i data-lucide="trash-2" class="w-4 h-4"></i>
									Hapus Siswa
								</button>

								<a
									href="{{ route('admin.siswa.index') }}"
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
						<i data-lucide="{{ $isCreate ? 'user-plus' : 'edit-3' }}" class="w-5 h-5"></i>
					</div>
					<div>
						<h2 class="text-xl font-bold text-gray-900">
							@if($isCreate) Tambah Siswa Baru @else Edit Data Siswa @endif
						</h2>
						<p class="text-sm text-gray-500">
							@if($isCreate) Isi form di bawah untuk menambahkan siswa baru @else Perbarui informasi siswa @endif
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
					action="{{ $isCreate ? route('admin.siswa.store') : route('admin.siswa.update', $siswa) }}"
					method="POST"
					class="space-y-6"
				>
					@csrf
					@if($isEdit) @method('PUT') @endif

					<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
						<!-- Nama -->
						<div>
							<label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
							<input
								type="text"
								id="nama"
								name="nama"
								value="{{ old('nama', $siswa->nama ?? '') }}"
								class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 @error('nama') border-red-500 @enderror"
								placeholder="Nama siswa"
								required
							>
							@error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
						</div>

						<!-- NISN -->
						<div>
							<label for="nisn" class="block text-sm font-semibold text-gray-700 mb-2">NISN</label>
							<input
								type="text"
								id="nisn"
								name="nisn"
								value="{{ old('nisn', $siswa->nisn ?? '') }}"
								class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 @error('nisn') border-red-500 @enderror"
								placeholder="Nomor induk siswa"
								required
							>
							@error('nisn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
						</div>

						<!-- Kelas -->
						<div>
							<label for="kelas" class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
							<input
								type="text"
								id="kelas"
								name="kelas"
								value="{{ old('kelas', $siswa->kelas ?? '') }}"
								class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 @error('kelas') border-red-500 @enderror"
								placeholder="Contoh: XII RPL 1"
								required
							>
							@error('kelas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
						</div>

						<!-- Password (Only on Create) -->
						@if($isCreate)
							<div class="md:col-span-2">
								<label for="kata_sandi" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
								<input
									type="password"
									id="kata_sandi"
									name="kata_sandi"
									class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 @error('kata_sandi') border-red-500 @enderror"
									placeholder="Minimal 6 karakter"
									required
								>
								@error('kata_sandi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
							</div>
						@endif
					</div>

					<!-- Action Buttons -->
					<div class="flex flex-col sm:flex-row gap-3 pt-2">
						<button
							type="submit"
							class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600"
						>
							<i data-lucide="save" class="w-4 h-4"></i>
							@if($isCreate) Tambah Siswa @else Simpan Perubahan @endif
						</button>

						<a
							href="{{ route('admin.siswa.index') }}"
							class="inline-flex items-center justify-center gap-2 rounded-2xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
						>
							<i data-lucide="arrow-left" class="w-4 h-4"></i>
							Kembali
						</a>
					</div>
				</form>
			</div>
		@endif
	</div>
</div>
@endsection
