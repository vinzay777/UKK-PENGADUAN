@extends('layouts.siswa')

@section('title', 'Profil Siswa - FacilityHub')

@section('content')
<div class="flex flex-col h-full">
	<div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
		<a href="{{ route('siswa.dashboard') }}" class="hover:text-orange-500">FacilityHub</a>
		<i data-lucide="chevron-right" class="w-3 h-3"></i>
		<span class="text-gray-900 font-medium">Profil Siswa</span>
	</div>

	<div class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
		<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
			<div class="xl:col-span-1 space-y-6">
				<div class="rounded-3xl bg-orange-500 p-6 text-white shadow-lg">
					{{-- <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center mb-4">
						<i data-lucide="user-round" class="w-8 h-8"></i>
					</div> --}}
					<h1 class="text-2xl font-bold">{{ $siswa->nama }}</h1>
					<p class="text-white/80 mt-1">Kelola data akun siswa Anda secara mandiri.</p>

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

				{{-- <div class="bg-orange-50 border border-orange-100 rounded-3xl p-5">
					<div class="flex items-start gap-3">
						<div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-orange-500 shadow-sm">
							<i data-lucide="shield-check" class="w-5 h-5"></i>
						</div>
						<div>
							<h2 class="font-semibold text-gray-900">Keamanan akun</h2>
							<p class="text-sm text-gray-600 mt-1">Isi password saat ini dan password baru jika ingin mengganti kata sandi.</p>
						</div>
					</div>
				</div> --}}
			</div>

			<div class="xl:col-span-2">
				<div class="bg-white border border-gray-100 rounded-3xl p-5 sm:p-7 shadow-sm">
					<div class="flex items-center gap-3 mb-6">
						{{-- <div class="w-11 h-11 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center">
							<i data-lucide="settings-2" class="w-5 h-5"></i>
						</div> --}}
						<div>
							<h2 class="text-xl font-bold text-gray-900">Edit Profil</h2>
							<p class="text-sm text-gray-500">Perbarui informasi pribadi dan kata sandi akun siswa.</p>
						</div>
					</div>

					@if(session('success'))
						<div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
							{{ session('success') }}
						</div>
					@endif

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

					<form action="{{ route('siswa.profile.update') }}" method="POST" class="space-y-6">
						@csrf
						@method('PUT')

						<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
							<div>
								<label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
								<input
									type="text"
									id="nama"
									name="nama"
									value="{{ old('nama', $siswa->nama) }}"
									class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-500 outline-none"
									readonly
								>
							</div>

							<div>
								<label for="nisn" class="block text-sm font-semibold text-gray-700 mb-2">NISN</label>
								<input
									type="text"
									id="nisn"
									value="{{ $siswa->nisn }}"
									class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-500 outline-none"
									readonly
								>
							</div>

							<div>
								<label for="kelas" class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
								<input
									type="text"
									id="kelas"
									name="kelas"
									value="{{ old('kelas', $siswa->kelas) }}"
									class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
									placeholder="Contoh: XII RPL 1"
									required
								>
							</div>
						</div>

						<div class="border-t border-dashed border-gray-200 pt-6">
							<div class="flex items-center gap-2 mb-4">
								{{-- <i data-lucide="key-round" class="w-4 h-4 text-orange-500"></i> --}}
								<h3 class="text-base font-semibold text-gray-900">Ubah Password</h3>
							</div>

							<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
								<div class="md:col-span-2">
									<label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
									<input
										type="password"
										id="current_password"
										name="current_password"
										class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
										placeholder="Isi jika ingin mengganti password"
									>
								</div>

								<div>
									<label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
									<input
										type="password"
										id="new_password"
										name="new_password"
										class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
										placeholder="Minimal 6 karakter"
									>
								</div>

								<div>
									<label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
									<input
										type="password"
										id="new_password_confirmation"
										name="new_password_confirmation"
										class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm text-gray-700 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
										placeholder="Ulangi password baru"
									>
								</div>
							</div>
						</div>

						<div class="flex flex-col sm:flex-row gap-3 pt-2">
							<button
								type="submit"
								class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600"
							>
								{{-- <i data-lucide="save" class="w-4 h-4"></i> --}}
								Simpan Perubahan
							</button>

							<a
								href="{{ route('siswa.dashboard') }}"
								class="inline-flex items-center justify-center gap-2 rounded-2xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
							>
								{{-- <i data-lucide="arrow-left" class="w-4 h-4"></i> --}}
								Kembali ke Dashboard
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
