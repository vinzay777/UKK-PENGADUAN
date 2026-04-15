<!-- Modal Detail Pengaduan -->
<div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4">
    <!-- Backdrop -->
    <div id="modalBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>

    <!-- Modal Card -->
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden max-h-[90vh] overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-400 to-orange-500 px-4 sm:px-6 py-4 sm:py-5 flex items-start justify-between">
            <div>
                <p class="text-white/80 text-xs font-medium mb-1">Detail Pengaduan</p>
                <h3 id="modal-judul" class="text-white text-base sm:text-lg font-bold leading-tight"></h3>
            </div>
            <button onclick="closeModal()" class="text-white/80 hover:text-white transition ml-4 mt-0.5 flex-shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="px-4 sm:px-6 py-4 sm:py-5 space-y-4">

            <!-- Status & Kategori -->
            <div class="flex items-center gap-3">
                <span id="modal-status-badge" class="text-xs font-semibold px-3 py-1 rounded-full"></span>
                <span class="text-xs text-gray-400">•</span>
                <span id="modal-kategori" class="text-xs text-gray-500 font-medium"></span>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                <div class="bg-gray-50 rounded-xl p-3">
                    <div class="flex items-center gap-2 text-gray-400 mb-1">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                        <span class="text-xs font-medium">Lokasi</span>
                    </div>
                    <p id="modal-lokasi" class="text-sm font-semibold text-gray-900"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <div class="flex items-center gap-2 text-gray-400 mb-1">
                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                        <span class="text-xs font-medium">Tanggal Lapor</span>
                    </div>
                    <p id="modal-tanggal" class="text-sm font-semibold text-gray-900"></p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <div class="flex items-center gap-2 text-gray-400 mb-2">
                    <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                    <span class="text-xs font-medium">Deskripsi Masalah</span>
                </div>
                <p id="modal-deskripsi" class="text-sm text-gray-700 leading-relaxed bg-gray-50 rounded-xl p-3"></p>
            </div>

            <!-- Foto -->
            <div id="modal-foto-wrapper" class="hidden">
                <div class="flex items-center gap-2 text-gray-400 mb-2">
                    <i data-lucide="image" class="w-3.5 h-3.5"></i>
                    <span class="text-xs font-medium">Foto Bukti</span>
                </div>
                <div id="modal-foto-list" class="flex flex-wrap gap-2"></div>
            </div>

            <!-- Catatan Admin -->
            <div id="modal-catatan-wrapper">
                <div class="flex items-center gap-2 text-gray-400 mb-2">
                    <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                    <span class="text-xs font-medium">Catatan Admin</span>
                </div>
                <p id="modal-catatan" class="text-sm text-gray-700 leading-relaxed bg-orange-50 border border-orange-100 rounded-xl p-3"></p>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-4 sm:px-6 pb-4 sm:pb-5">
            <button onclick="closeModal()" class="w-full py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const statusConfig = {
        'Sedang Diproses': { bg: 'bg-blue-100',   text: 'text-blue-600'   },
        'Selesai':         { bg: 'bg-green-100',  text: 'text-green-600'  },
        'Menunggu':        { bg: 'bg-yellow-100', text: 'text-yellow-600' },
        'Ditolak':         { bg: 'bg-red-100',    text: 'text-red-500'    },
    };

    document.querySelectorAll('.pengaduan-item').forEach(item => {
        item.addEventListener('click', () => {
            const judul     = item.dataset.judul;
            const lokasi    = item.dataset.lokasi;
            const deskripsi = item.dataset.deskripsi;
            const kategori  = item.dataset.kategori;
            const tanggal   = item.dataset.tanggal;
            const status    = item.dataset.status;
            const catatan   = item.dataset.catatanAdmin;
            const fotoRaw   = item.dataset.foto;

            document.getElementById('modal-judul').textContent     = judul;
            document.getElementById('modal-lokasi').textContent    = lokasi;
            document.getElementById('modal-deskripsi').textContent = deskripsi;
            document.getElementById('modal-kategori').textContent  = kategori;
            document.getElementById('modal-tanggal').textContent   = tanggal;
            document.getElementById('modal-catatan').textContent   = catatan;

            // Foto
            const fotoWrapper = document.getElementById('modal-foto-wrapper');
            const fotoList    = document.getElementById('modal-foto-list');
            fotoList.innerHTML = '';
            let fotos = [];
            try { fotos = JSON.parse(fotoRaw || '[]'); } catch(e) {}
            if (fotos.length > 0) {
                fotos.forEach(url => {
                    const img = document.createElement('img');
                    img.src = url;
                    img.className = 'w-24 h-24 object-cover rounded-lg border border-gray-200 cursor-pointer hover:opacity-90 transition';
                    img.onclick = () => window.open(url, '_blank');
                    fotoList.appendChild(img);
                });
                fotoWrapper.classList.remove('hidden');
            } else {
                fotoWrapper.classList.add('hidden');
            }

            const badge = document.getElementById('modal-status-badge');
            badge.textContent = status;
            badge.className = 'text-xs font-semibold px-3 py-1 rounded-full';
            const cfg = statusConfig[status] || { bg: 'bg-gray-100', text: 'text-gray-600' };
            badge.classList.add(cfg.bg, cfg.text);

            const catatanWrapper = document.getElementById('modal-catatan-wrapper');
            catatanWrapper.style.display = (catatan && catatan !== '-') ? 'block' : 'none';

            const modal = document.getElementById('modalDetail');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            lucide.createIcons();
        });
    });

    function closeModal() {
        const modal = document.getElementById('modalDetail');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModal();
    });
</script>
@endpush
