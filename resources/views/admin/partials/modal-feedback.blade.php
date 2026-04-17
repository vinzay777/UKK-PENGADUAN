
<div id="feedbackModal" class="fixed inset-0 z-50 hidden items-center justify-center">

    <div onclick="closeModal()" class="absolute inset-0 bg-black/40"></div>


    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800 text-sm flex items-center gap-2">
                Update Status Pengaduan
            </h2>
            <button onclick="closeModal()" class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 transition">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="px-5 py-4 flex flex-col gap-4">
            <form id="statusForm" method="POST" enctype="multipart/form-data" onsubmit="handleStatusFormSubmit(event)">
                @csrf
                @method('PATCH')
                <input type="hidden" id="m-status-input" name="status" value="">


            <div class="bg-gray-50 rounded-xl p-3 flex flex-col gap-1.5 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">ID</span>
                    <span id="m-id" class="font-bold text-blue-600"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Siswa</span>
                    <span id="m-siswa" class="font-medium text-gray-700"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Judul</span>
                    <span id="m-judul" class="font-medium text-gray-700 text-right max-w-[60%] truncate"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Kategori</span>
                    <span id="m-kat" class="font-medium text-gray-700"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Lokasi</span>
                    <span id="m-lokasi" class="font-medium text-gray-700"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Tanggal</span>
                    <span id="m-tgl" class="font-medium text-gray-700"></span>
                </div>
                <div class="pt-1 border-t border-gray-200">
                    <p id="m-deskripsi" class="text-gray-500 leading-relaxed">-</p>
                </div>
            </div>


            <div id="m-foto-wrapper">
                <p class="text-xs text-gray-400 font-medium mb-1.5">Foto Bukti</p>
                <div id="m-foto-grid" class="grid grid-cols-3 gap-1.5">
                    <p class="text-xs text-gray-400 col-span-3">Tidak ada foto.</p>
                </div>
            </div>


            <div>
                <p class="text-xs text-gray-500 font-semibold mb-2">Pilih Status <span class="text-red-400">*</span></p>
                <div class="flex gap-1.5 flex-wrap" id="statusGroup">
                    @foreach(['menunggu' => ['clock','Menunggu'], 'diproses' => ['loader','Diproses'], 'selesai' => ['check-circle','Selesai']] as $val => $sc)
                    <button type="button" onclick="setStatus(this)" data-status="{{ $val }}"
                        class="status-btn inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-xs font-medium transition bg-white text-gray-400 border border-gray-200 hover:border-blue-300 hover:text-blue-500">
                        <i data-lucide="{{ $sc[0] }}" class="w-3 h-3"></i>
                        {{ $sc[1] }}
                    </button>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500 font-semibold mb-1.5 block">
                    Feedback untuk Siswa <span class="text-gray-400">(Opsional)</span>
                </label>
                <textarea rows="3" name="feedback" placeholder="Tulis respon atau update untuk siswa..."
                    class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 resize-none text-gray-700 placeholder-gray-300"></textarea>
            </div>


            <div>
                <label class="text-xs text-gray-500 font-semibold mb-1.5 block">
                    Foto Progres <span class="text-gray-400">(Opsional)</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition" id="dropZone">
                    <input type="file" name="foto_progres[]" id="fotoProgresInput" multiple accept="image/*" class="hidden">
                    <div id="uploadPrompt" class="cursor-pointer">
                        <i data-lucide="image-plus" class="w-6 h-6 text-gray-400 mx-auto mb-2"></i>
                        <p class="text-xs text-gray-500">Drag foto di sini atau <span class="text-blue-600 font-medium">klik untuk pilih</span></p>
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max 5MB per file)</p>
                    </div>
                    <div id="fotoPreviewList" class="flex flex-wrap gap-4 justify-center mt-4"></div>
                </div>
            </div>


            <div class="flex gap-2 pt-1">
                <button type="button" onclick="closeModal()"
                    class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-500 text-sm font-medium hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition">
                    Simpan
                </button>
            </div>

            </form>
        </div>
    </div>
</div>

<script>
function handleStatusFormSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const status = document.getElementById('m-status-input').value;

    if (!status) {
        alert('Pilih status terlebih dahulu!');
        return;
    }

    form.submit();
}

function setStatus(btn) {
    const currentStatus = document.getElementById('m-status-input').value;

    if (currentStatus === 'selesai') {
        alert('Status sudah selesai, tidak bisa diubah lagi!');
        return;
    }

    const statusBtns = document.querySelectorAll('.status-btn');
    statusBtns.forEach(b => b.classList.remove('bg-blue-600', 'text-white', 'border-blue-600'));
    statusBtns.forEach(b => b.classList.add('bg-white', 'text-gray-400', 'border-gray-200'));

    btn.classList.remove('bg-white', 'text-gray-400', 'border-gray-200');
    btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');

    document.getElementById('m-status-input').value = btn.getAttribute('data-status');
}

function closeModal() {
    document.getElementById('feedbackModal').classList.add('hidden');
    document.getElementById('feedbackModal').classList.remove('flex');
}

setTimeout(function() {
    const dropZone = document.getElementById('dropZone');
    const fotoInput = document.getElementById('fotoProgresInput');
    const uploadPrompt = document.getElementById('uploadPrompt');
    const previewList = document.getElementById('fotoPreviewList');

    if (dropZone && fotoInput) {
        dropZone.addEventListener('click', () => fotoInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-400', 'bg-blue-50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-400', 'bg-blue-50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-400', 'bg-blue-50');

            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fotoInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });
    }
}, 100);

function handleFiles(files) {
    const previewList = document.getElementById('fotoPreviewList');
    const uploadPrompt = document.getElementById('uploadPrompt');
    const dropZone = document.getElementById('dropZone');

    previewList.innerHTML = '';

    if (files.length === 0) {
        uploadPrompt.style.display = 'block';
        dropZone.classList.add('border-2', 'border-dashed', 'border-gray-300', 'p-4', 'hover:border-blue-400', 'hover:bg-blue-50');
        dropZone.classList.remove('p-0');
        return;
    }

    uploadPrompt.style.display = 'none';
    dropZone.classList.remove('border-2', 'border-dashed', 'border-gray-300', 'p-4', 'hover:border-blue-400', 'hover:bg-blue-50');
    dropZone.classList.add('p-0');

    Array.from(files).forEach((file, index) => {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const container = document.createElement('div');
            container.className = 'flex flex-col items-center gap-2';

            const imgWrapper = document.createElement('div');
            imgWrapper.className = 'relative w-20 h-20';
            imgWrapper.innerHTML = `<img src="${e.target.result}" alt="preview" class="w-20 h-20 object-cover rounded-lg border-2 border-blue-300">`;

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.onclick = function(evt) {
                evt.preventDefault();
                removeFotoProgres(index);
            };
            deleteBtn.className = 'p-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors';
            deleteBtn.title = 'Hapus foto';
            deleteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';

            container.appendChild(imgWrapper);
            container.appendChild(deleteBtn);
            previewList.appendChild(container);
        };
        reader.readAsDataURL(file);
    });
}

function removeFotoProgres(index) {
    const input = document.getElementById('fotoProgresInput');
    const dt = new DataTransfer();
    const files = input.files;

    for (let i = 0; i < files.length; i++) {
        if (i !== index) {
            dt.items.add(files[i]);
        }
    }

    input.files = dt.files;
    handleFiles(input.files);
}
</script>
