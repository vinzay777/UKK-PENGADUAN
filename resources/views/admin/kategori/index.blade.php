@extends('layouts.admin')

@section('title', 'Kelola Kategori - FacilityHub')

@section('content')
<div class="flex flex-col h-full">
	<div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
		<a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500">FacilityHub</a>
		<i data-lucide="chevron-right" class="w-3 h-3"></i>
		<span class="text-gray-900 font-medium">Kelola Kategori</span>
	</div>

	<div class="bg-white rounded-xl shadow-lg flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
		<div class="flex items-center justify-between gap-4 mb-6 pb-6 border-b border-gray-200">
			<div>
				<h2 class="text-xl font-bold text-gray-900">Kelola Kategori Fasilitas</h2>
				<p class="text-sm text-gray-500 mt-1">Daftar semua kategori fasilitas di sekolah</p>
			</div>
			<a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white hover:bg-orange-600 transition whitespace-nowrap">
				<i data-lucide="plus" class="w-4 h-4"></i>
				Tambah Kategori
			</a>
		</div>

		@if(session('success'))
			<div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
				{{ session('success') }}
			</div>
		@endif

		@if($kategori->count() > 0)
			<div class="overflow-x-auto">
				<table class="w-full border-collapse">
					<thead>
						<tr class="border-b-2 border-gray-200">
							<th class="text-left py-3 px-4 font-semibold text-gray-900">Nama Kategori</th>
							<th class="text-left py-3 px-4 font-semibold text-gray-900">Jumlah Pengaduan</th>
							<th class="text-center py-3 px-4 font-semibold text-gray-900">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($kategori as $k)
							<tr class="border-b border-gray-100 hover:bg-gray-50 transition">
								<td class="py-3 px-4 text-sm font-medium text-gray-900">{{ $k->nama }}</td>
								<td class="py-3 px-4 text-sm text-gray-700">
									<span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
										<i data-lucide="bar-chart-3" class="w-3 h-3"></i>
										{{ $k->pengaduan_count }} pengaduan
									</span>
								</td>
								<td class="py-3 px-4 text-center">
									<div class="flex items-center justify-center gap-2">
										<a href="{{ route('admin.kategori.show', $k) }}" class="inline-flex items-center gap-1 rounded-lg bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 hover:bg-blue-200 transition">
											<i data-lucide="eye" class="w-3 h-3"></i>
											Lihat
										</a>
										<a href="{{ route('admin.kategori.edit', $k) }}" class="inline-flex items-center gap-1 rounded-lg bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700 hover:bg-yellow-200 transition">
											<i data-lucide="edit" class="w-3 h-3"></i>
											Edit
										</a>
										<form id="deleteForm-kategori-{{ $k->id }}" action="{{ route('admin.kategori.destroy', $k) }}" method="POST" class="inline" style="display: none;">
											@csrf
											@method('DELETE')
										</form>
										<button 
											type="button"
											onclick="openDeleteModal(document.getElementById('deleteForm-kategori-{{ $k->id }}'), 'Apakah Anda yakin ingin menghapus kategori &quot;{{ $k->nama }}&quot;? Semua pengaduan yang terkait akan tetap ada tanpa label kategori.')"
											class="inline-flex items-center gap-1 rounded-lg bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 hover:bg-red-200 transition"
										>
											<i data-lucide="trash-2" class="w-3 h-3"></i>
											Hapus
										</button>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="mt-6">
				{{ $kategori->links() }}
			</div>
		@else
			<div class="flex flex-col items-center justify-center py-12">
				<i data-lucide="inbox" class="w-16 h-16 text-gray-300 mb-4"></i>
				<p class="text-gray-500 text-lg font-medium">Belum ada data kategori</p>
				<p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Kategori" untuk menambahkan kategori fasilitas baru</p>
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
