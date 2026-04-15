<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 p-4 [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">
	<div class="bg-white rounded-3xl shadow-2xl max-w-md w-full overflow-hidden animate-in fade-in zoom-in-95 duration-200">
		<!-- Icon -->
		<div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-6 flex justify-center">
			<div class="w-16 h-16 rounded-full bg-red-500 flex items-center justify-center shadow-lg">
				<i data-lucide="trash-2" class="w-8 h-8 text-white"></i>
			</div>
		</div>

		<!-- Content -->
		<div class="px-6 py-6 text-center">
			<h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Data?</h3>
			<p id="deleteMessage" class="text-gray-600 text-sm mb-6">
				Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
			</p>

			<!-- Warning -->
			<div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6">
				<div class="flex items-start gap-3">
					<i data-lucide="alert-circle" class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5"></i>
					<p class="text-xs text-red-700 font-medium">Data yang dihapus tidak dapat dikembalikan, pastikan Anda sudah benar-benar yakin!</p>
				</div>
			</div>
		</div>

		<!-- Actions -->
		<div class="bg-gray-50 px-6 py-4 flex gap-3 border-t border-gray-100">
			<button
				type="button"
				onclick="closeDeleteModal()"
				class="flex-1 rounded-2xl border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition"
			>
				Batal
			</button>
			<button
				type="button"
				id="confirmDeleteBtn"
				onclick="confirmDelete()"
				class="flex-1 rounded-2xl bg-red-500 px-4 py-3 text-sm font-semibold text-white hover:bg-red-600 transition flex items-center justify-center gap-2"
			>
				<i data-lucide="check" class="w-4 h-4"></i>
				Hapus
			</button>
		</div>
	</div>
</div>

<script>
	let deleteForm = null;
	let deleteMessage = '';

	function openDeleteModal(form, message = '') {
		deleteForm = form;
		deleteMessage = message;
		const modal = document.getElementById('deleteModal');
		const messageEl = document.getElementById('deleteMessage');
		
		if (message) {
			messageEl.textContent = message;
		} else {
			messageEl.textContent = 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
		}
		
		modal.classList.remove('hidden');
		modal.classList.add('flex');
		document.body.style.overflow = 'hidden';
	}

	function closeDeleteModal() {
		const modal = document.getElementById('deleteModal');
		modal.classList.add('hidden');
		modal.classList.remove('flex');
		document.body.style.overflow = 'auto';
		deleteForm = null;
	}

	function confirmDelete() {
		if (deleteForm) {
			deleteForm.submit();
		}
		closeDeleteModal();
	}

	// Close modal when clicking outside
	document.getElementById('deleteModal')?.addEventListener('click', function(e) {
		if (e.target === this) {
			closeDeleteModal();
		}
	});

	// Close modal on Escape key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
			closeDeleteModal();
		}
	});

	// Re-initialize icons when modal opens
	const observer = new MutationObserver(() => {
		if (!document.getElementById('deleteModal').classList.contains('hidden')) {
			lucide.createIcons();
		}
	});

	observer.observe(document.getElementById('deleteModal'), { attributes: true, attributeFilter: ['class'] });
</script>
