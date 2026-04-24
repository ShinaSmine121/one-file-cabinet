<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Arsip: {{ $mahasiswa->name }} | One File Cabinet UHO (Admin)</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-container": "#fed01b",
                        "primary": "#00236f",
                        "on-surface-variant": "#444651",
                        "primary-fixed-dim": "#b6c4ff",
                        "primary-container": "#1e3a8a",
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "h2": ["Inter"],
                        "h1": ["Inter"]
                    },
                    animation: {
                        'reveal': 'reveal 0.6s cubic-bezier(0.23, 1, 0.32, 1)',
                    },
                    keyframes: {
                        reveal: {
                            '0%': { opacity: '0', transform: 'scale(0.98)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        }
                    },
                    backgroundImage: {
                        'gradient-primary': 'linear-gradient(135deg, #1e3a8a 0%, #00236f 100%)',
                        'gradient-amber': 'linear-gradient(135deg, #d97706 0%, #b45309 100%)',
                        'gradient-blue': 'linear-gradient(135deg, #2563eb 0%, #1e40af 100%)',
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; vertical-align: middle; }
        body { background-color: #faf8ff; }
        .click-effect {
            transition: transform 0.15s ease, opacity 0.15s ease, box-shadow 0.2s ease;
        }
        .click-effect:active {
            transform: scale(0.96);
            opacity: 0.85;
        }
        .animate-reveal {
            animation: reveal 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }
        .hover-gradiant-primary {
            transition: all 0.3s ease;
        }
        .hover-gradiant-primary:hover {
            background-image: linear-gradient(135deg, #1e3a8a 0%, #00236f 100%);
            box-shadow: 0 4px 12px rgba(0, 35, 111, 0.2);
        }
        .hover-gradiant-amber:hover {
            background-image: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2);
        }
    </style>
</head>
<body class="font-body-md text-slate-900">

{{-- SIDEBAR ADMIN (TANPA FADE-IN) --}}
<aside class="h-screen w-72 border-r flex flex-col fixed left-0 top-0 bg-white shadow-sm z-50">
    <div class="flex flex-col h-full py-6">
        <div class="px-6 mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">folder_managed</span>
                </div>
                <div>
                    <h1 class="text-lg font-black text-[#1E3A8A] uppercase tracking-wider">One File Cabinet</h1>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-widest">Admin Control</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 space-y-1">
            <a class="flex items-center gap-4 text-slate-500 hover:bg-slate-50 px-6 py-3 transition-colors click-effect" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label-md">Dashboard</span>
            </a>
            <a class="flex items-center gap-4 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-6 py-3 click-effect" href="{{ route('admin.mahasiswa.index') }}">
                <span class="material-symbols-outlined">group</span>
                <span class="font-label-md">Manajemen Mahasiswa</span>
            </a>
            <a class="flex items-center gap-4 text-slate-500 hover:bg-slate-50 px-6 py-3 transition-colors click-effect" href="{{ route('admin.dosen.index') }}">
                <span class="material-symbols-outlined">person</span>
                <span class="font-label-md">Manajemen Dosen</span>
            </a>
            <a class="flex items-center gap-4 text-slate-500 hover:bg-slate-50 px-6 py-3 transition-colors click-effect" href="{{ route('admin.laci.index') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="font-label-md">Manajemen Laci</span>
            </a>
        </nav>

        <div class="mt-auto border-t border-slate-100 pt-6">
            <form action="{{ route('login') }}" method="GET" class="w-full">
                <button type="submit" class="flex items-center w-full gap-4 text-red-600 hover:bg-red-50 px-6 py-3 transition-colors click-effect">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-label-md font-bold">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<div class="ml-72 min-h-screen flex flex-col">
    
    {{-- HEADER (TANPA FADE-IN) --}}
    <header class="w-full h-16 sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-8 h-full mx-auto w-full">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.mahasiswa.index') }}" class="p-2 text-slate-500 hover:text-[#1E3A8A] hover:bg-blue-50 rounded-lg transition-all click-effect">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h2 class="text-xl font-bold text-[#1E3A8A]">Arsip Mahasiswa</h2>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 pl-2 border-l border-slate-200">
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-500 font-medium">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="p-8 mx-auto w-full space-y-6">
        
        {{-- PROFIL MAHASISWA --}}
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-2xl font-black text-slate-900">{{ $mahasiswa->name }}</h3>
                <p class="text-slate-500 font-medium mt-1 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">badge</span> 
                    NIM: {{ $mahasiswa->nim }}
                </p>
            </div>
            <div class="bg-amber-50 px-5 py-3 rounded-xl border border-amber-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akses Admin</p>
                <p class="text-lg font-black text-amber-600">Full Control</p>
            </div>
        </div>

        {{-- GRID LACI --}}
        <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">folder</span> 
            Daftar Laci Dokumen
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($lacis as $laci)
                @php 
                    $dokumenDalamLaci = $dokumens->where('laci_id', $laci->id);
                    $count = $dokumenDalamLaci->count(); 
                @endphp
                {{-- Tidak ada efek fade atau delay; tampil langsung --}}
                <div onclick="openLaciModal('modal_laci_{{ $laci->id }}')" class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm hover:border-[#1E3A8A] hover:shadow-md cursor-pointer transition-all group click-effect">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-blue-50 text-[#1E3A8A] rounded-xl">
                            <span class="material-symbols-outlined" style="font-size: 32px;">folder</span>
                        </div>
                        <span id="count_laci_{{ $laci->id }}" class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-black border border-slate-200">
                            {{ $count }} File
                        </span>
                    </div>
                    <h4 class="font-bold text-slate-900 group-hover:text-[#1E3A8A] text-base">{{ $laci->nama_laci }}</h4>
                    <p class="text-xs text-slate-400 mt-1">Klik untuk melihat isi laci</p>
                </div>

                {{-- MODAL ISI LACI --}}
                <div id="modal_laci_{{ $laci->id }}" class="fixed inset-0 bg-black/40 hidden z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
                    <div class="bg-white rounded-xl w-full max-w-3xl max-h-[85vh] flex flex-col shadow-2xl animate-reveal">
                        <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[#1E3A8A]">folder_open</span>
                                <h3 class="font-bold text-slate-900 text-lg">{{ $laci->nama_laci }}</h3>
                            </div>
                            <button onclick="closeModal('modal_laci_{{ $laci->id }}')" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all click-effect">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        
                        <div class="flex-1 overflow-y-auto p-5 space-y-3" id="laci_container_{{ $laci->id }}">
                            @forelse($dokumenDalamLaci as $dok)
                                <div class="dokumen-item flex items-center justify-between p-4 bg-slate-50/80 border border-slate-100 rounded-xl hover:bg-white transition-colors" data-dokumen-id="{{ $dok->id }}" data-laci-id="{{ $laci->id }}">
                                    <div class="flex items-center gap-4">
                                        <span class="material-symbols-outlined text-red-500" style="font-size: 36px;">picture_as_pdf</span>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm">{{ $dok->nama_file_asli }}</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-[10px] text-slate-400">{{ $dok->created_at->format('d M Y') }}</span>
                                                @php
                                                    $statusColor = match($dok->status) {
                                                        'disetujui' => 'bg-green-100 text-green-700 border-green-200',
                                                        'ditolak' => 'bg-red-100 text-red-700 border-red-200',
                                                        default => 'bg-amber-100 text-amber-700 border-amber-200'
                                                    };
                                                @endphp
                                                <span class="status-badge px-2 py-0.5 rounded-full text-[9px] font-black border {{ $statusColor }}">
                                                    {{ ucfirst($dok->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button class="btn-review p-2 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all border border-transparent hover:border-amber-100 click-effect"
                                                data-url="{{ route('admin.dokumen.status', $dok->id) }}"
                                                data-status="{{ $dok->status }}"
                                                data-note="{{ $dok->catatan_dosen ?? '' }}"
                                                data-dokumen-id="{{ $dok->id }}"
                                                title="Review">
                                            <span class="material-symbols-outlined">rate_review</span>
                                        </button>
                                        <a href="{{ route('admin.download', $dok->id) }}" class="p-2 text-slate-500 hover:text-[#1E3A8A] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100 click-effect" title="Unduh">
                                            <span class="material-symbols-outlined">download</span>
                                        </a>
                                        <button class="btn-delete p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all border border-transparent hover:border-red-100 click-effect"
                                                data-url="{{ route('admin.dokumen.destroy', $dok->id) }}"
                                                data-nama="{{ $dok->nama_file_asli }}"
                                                data-dokumen-id="{{ $dok->id }}"
                                                data-laci-id="{{ $laci->id }}"
                                                title="Hapus Permanen">
                                            <span class="material-symbols-outlined">delete_forever</span>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <span class="material-symbols-outlined text-3xl">description_off</span>
                                    </div>
                                    <p class="text-slate-500 font-medium">Laci ini masih kosong.</p>
                                    <p class="text-xs text-slate-400 mt-1">Belum ada dokumen yang diunggah.</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                            <button onclick="closeModal('modal_laci_{{ $laci->id }}')" class="w-full py-2.5 bg-white border border-slate-200 text-slate-700 rounded-lg font-medium hover:bg-slate-100 transition-all click-effect">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>

{{-- MODAL REVIEW (GLOBAL) --}}
<div id="reviewModal" class="fixed inset-0 bg-black/50 hidden z-[110] flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl animate-reveal">
        <div class="flex justify-between items-center mb-5 border-b border-slate-100 pb-3">
            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-600">rate_review</span>
                Review Dokumen (Admin)
            </h3>
            <button type="button" onclick="closeReviewModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-lg hover:bg-red-50 click-effect">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <form id="reviewForm" onsubmit="submitReview(event)">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1 text-slate-700">Status Keputusan</label>
                <select name="status" class="w-full border border-slate-200 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-[#1E3A8A] bg-white">
                    <option value="disetujui">Setujui (Approved)</option>
                    <option value="ditolak">Tolak (Rejected)</option>
                    <option value="pending">Kembalikan ke Pending</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1 text-slate-700">Catatan / Feedback</label>
                <textarea name="catatan_dosen" rows="3" class="w-full border border-slate-200 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-[#1E3A8A]" placeholder="Tambahkan catatan revisi atau pesan untuk mahasiswa..."></textarea>
            </div>
            
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeReviewModal()" class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 font-bold transition-colors click-effect">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#1E3A8A] text-white rounded-lg font-bold transition-colors shadow-md click-effect hover-gradiant-primary">
                    Simpan Review
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL KONFIRMASI HAPUS --}}
<div id="deleteModal" class="fixed inset-0 bg-black/50 hidden z-[110] flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-sm w-full p-6 shadow-2xl text-center animate-reveal">
        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-4xl">delete_forever</span>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Hapus Dokumen?</h3>
        <p class="text-sm text-slate-500 mb-6">File <b id="deleteFileName" class="text-slate-700"></b> akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
        <form id="deleteForm" onsubmit="submitDelete(event)">
            @csrf
            @method('DELETE')
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 font-bold transition-colors click-effect">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition-colors shadow-md click-effect">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>

{{-- TOAST NOTIFIKASI --}}
<div id="ajaxToast" class="fixed bottom-6 right-6 px-5 py-3 rounded-lg shadow-lg hidden z-[120] flex items-center gap-2 text-white font-medium transition-opacity duration-300">
    <span id="toastIcon" class="material-symbols-outlined">info</span>
    <span id="toastMsg"></span>
</div>

<script>
    let currentDokumenId = null;
    let currentDeleteDokumenId = null;
    let currentDeleteLaciId = null;

    // Fungsi modal
    function openLaciModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { event.stopPropagation(); document.getElementById(id).classList.add('hidden'); }
    function closeReviewModal() { document.getElementById('reviewModal').classList.add('hidden'); currentDokumenId = null; }
    function closeDeleteModal() { document.getElementById('deleteModal').classList.add('hidden'); currentDeleteDokumenId = null; currentDeleteLaciId = null; }

    // Fungsi toast
    function showToast(msg, isSuccess = true) {
        const toast = document.getElementById('ajaxToast');
        const icon = document.getElementById('toastIcon');
        document.getElementById('toastMsg').innerText = msg;
        icon.innerText = isSuccess ? 'check_circle' : 'error';
        toast.className = `fixed bottom-6 right-6 px-5 py-3 rounded-lg shadow-lg z-[120] flex items-center gap-2 text-white font-medium transition-opacity duration-300 ${
            isSuccess ? 'bg-green-600' : 'bg-red-600'
        }`;
        toast.classList.remove('hidden');
        toast.style.opacity = '1';
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.classList.add('hidden'), 300);
        }, 3000);
    }

    // Event global untuk tombol Review dan Delete
    document.addEventListener('click', function(e) {
        const btnRev = e.target.closest('.btn-review');
        if (btnRev) {
            e.stopPropagation();
            currentDokumenId = btnRev.dataset.dokumenId;
            const form = document.getElementById('reviewForm');
            form.action = btnRev.dataset.url;
            form.status.value = btnRev.dataset.status;
            form.catatan_dosen.value = btnRev.dataset.note || '';
            document.getElementById('reviewModal').classList.remove('hidden');
        }

        const btnDel = e.target.closest('.btn-delete');
        if (btnDel) {
            e.stopPropagation();
            currentDeleteDokumenId = btnDel.dataset.dokumenId;
            currentDeleteLaciId = btnDel.dataset.laciId;
            document.getElementById('deleteFileName').innerText = btnDel.dataset.nama;
            document.getElementById('deleteForm').action = btnDel.dataset.url;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
    });

    // Submit Review
    async function submitReview(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const url = form.action;

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Menyimpan...';
        submitBtn.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
            });

            if (!response.ok) throw new Error('Server error');
            const result = await response.json();

            // Update UI
            if (currentDokumenId) {
                const newStatus = formData.get('status');
                const item = document.querySelector(`.dokumen-item[data-dokumen-id="${currentDokumenId}"]`);
                if (item) {
                    const badge = item.querySelector('.status-badge');
                    badge.className = 'status-badge px-2 py-0.5 rounded-full text-[9px] font-black border';
                    if (newStatus === 'disetujui') {
                        badge.classList.add('bg-green-100', 'text-green-700', 'border-green-200');
                        badge.textContent = 'Disetujui';
                    } else if (newStatus === 'ditolak') {
                        badge.classList.add('bg-red-100', 'text-red-700', 'border-red-200');
                        badge.textContent = 'Ditolak';
                    } else {
                        badge.classList.add('bg-amber-100', 'text-amber-700', 'border-amber-200');
                        badge.textContent = 'Pending';
                    }
                    const revBtn = item.querySelector('.btn-review');
                    if (revBtn) {
                        revBtn.dataset.status = newStatus;
                        revBtn.dataset.note = formData.get('catatan_dosen') || '';
                    }
                }
            }

            submitBtn.innerHTML = '<span class="material-symbols-outlined text-sm">check_circle</span> Tersimpan!';
            submitBtn.classList.remove('bg-[#1E3A8A]', 'hover-gradiant-primary');
            submitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
            setTimeout(() => {
                closeReviewModal();
                submitBtn.innerHTML = originalText;
                submitBtn.classList.add('bg-[#1E3A8A]', 'hover-gradiant-primary');
                submitBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                submitBtn.disabled = false;
            }, 600);

            showToast(result.message || 'Review berhasil disimpan.');
        } catch (error) {
            alert('Gagal menyimpan review. Pastikan server merespon JSON.');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    // Submit Delete
    async function submitDelete(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const url = form.action;

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Menghapus...';
        submitBtn.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
            });

            if (!response.ok) throw new Error('Server error');
            const result = await response.json();

            if (currentDeleteDokumenId) {
                const item = document.querySelector(`.dokumen-item[data-dokumen-id="${currentDeleteDokumenId}"]`);
                if (item) {
                    item.style.transition = 'all 0.3s';
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                    setTimeout(() => item.remove(), 300);
                }
            }

            if (currentDeleteLaciId) {
                const counter = document.getElementById(`count_laci_${currentDeleteLaciId}`);
                if (counter) {
                    let num = parseInt(counter.innerText) - 1;
                    counter.innerText = `${num < 0 ? 0 : num} File`;
                }
            }

            closeDeleteModal();
            showToast(result.message || 'Dokumen berhasil dihapus.');
        } catch (error) {
            alert('Gagal menghapus dokumen.');
        }
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }

    // Tutup modal jika klik di luar
    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) closeReviewModal();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
    document.querySelectorAll('[id^="modal_laci_"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) this.classList.add('hidden');
        });
    });
</script>

</body>
</html>