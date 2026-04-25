<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Arsip: {{ $mahasiswa->name }} | One File Cabinet UHO</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { "primary-container": "#1e3a8a", "primary": "#00236f" },
                    fontFamily: { "body-md": ["Inter"], "h1": ["Inter"], "h2": ["Inter"], "h3": ["Inter"] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { background-color: #faf8ff; }
        .click-effect {
            transition: transform 0.1s ease, opacity 0.1s ease;
        }
        .click-effect:active {
            transform: scale(0.96);
            opacity: 0.8;
        }
        .hover-gradiant-primary {
            transition: all 0.3s ease;
        }
        .hover-gradiant-primary:hover {
            background-image: linear-gradient(135deg, #1e3a8a 0%, #00236f 100%);
            box-shadow: 0 4px 12px rgba(0, 35, 111, 0.2);
        }
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem !important;
        }
    </style>
</head>
<body class="font-body-md text-slate-900">

{{-- SIDEBAR (KONSISTEN) --}}
<nav id="sidebar" class="transform -translate-x-full lg:translate-x-0 transition-transform duration-300 h-screen w-56 border-r flex flex-col fixed left-0 top-0 bg-white shadow-sm z-50">
    <div class="flex flex-col h-full py-6">
        <div class="px-4 mb-8">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-8 h-8 rounded-lg bg-primary-container flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-lg">account_balance</span>
                </div>
                <div>
                    <h1 class="text-sm font-black text-[#1E3A8A] uppercase tracking-wider leading-tight">One File Cabinet</h1>
                    <p class="text-[10px] text-slate-500 font-medium">Portal Dosen</p>
                </div>
            </div>
        </div>
        
        <div class="flex-1 space-y-1">
            <a class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5" href="{{ route('dosen.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-4 py-2.5" href="{{ route('dosen.mahasiswa.index') }}">
                <span class="material-symbols-outlined">folder_open</span>
                <span class="text-sm">Berkas Mahasiswa</span>
            </a>
        </div>

        <div class="mt-auto pt-6 border-t border-slate-100">
            <form action="{{ route('login') }}" method="GET" class="w-full">
                <button type="submit" class="flex items-center w-full gap-3 text-red-600 hover:bg-red-50 px-4 py-2.5 rounded-lg click-effect">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-bold">Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- HEADER + MAIN --}}
<div class="lg:ml-56 min-h-screen flex flex-col transition-all duration-300">
    <header class="w-full h-16 sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-4 lg:px-6 h-full gap-2">
            
            {{-- KIRI: Hamburger, Tombol Back, & Judul --}}
            <div class="flex items-center gap-1.5 sm:gap-3 min-w-0">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg click-effect shrink-0">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <a href="{{ route('dosen.mahasiswa.index') }}" class="p-1.5 sm:p-2 text-slate-500 hover:text-[#1E3A8A] hover:bg-blue-50 rounded-lg transition-all click-effect shrink-0">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div class="truncate">
                    <h2 class="text-lg lg:text-xl font-bold text-[#1E3A8A] truncate">
                        <span class="hidden sm:inline">Arsip Mahasiswa</span>
                        <span class="sm:hidden">Arsip</span>
                    </h2>
                </div>
            </div>

            {{-- KANAN: Profil Dosen --}}
            <div class="flex items-center gap-2 sm:gap-3 pl-2 sm:pl-0 shrink-0">
                <div class="text-right min-w-0">
                    <p class="text-xs sm:text-sm font-bold text-slate-900 leading-tight truncate max-w-[80px] sm:max-w-none">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-[10px] sm:text-xs text-slate-500 leading-none truncate max-w-[80px] sm:max-w-none">
                        <span class="hidden sm:inline">Dosen Teknik Informatika</span>
                        <span class="sm:hidden">Dosen TI</span>
                    </p>
                </div>
                <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold border border-slate-200 shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>

        </div>
    </header>

    <main class="p-6 w-full">
        {{-- PROFIL MAHASISWA CARD & TOTAL ARSIP (UPGRADED) --}}
        <div class="bg-white p-5 lg:p-6 rounded-xl border border-slate-100 shadow-sm mb-6 lg:mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
            <div>
                <h3 class="text-xl lg:text-2xl font-black text-slate-900">{{ $mahasiswa->name }}</h3>
                <p class="text-sm text-slate-500 font-medium mt-1 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">badge</span> 
                    NIM: {{ $mahasiswa->nim }}
                </p>
            </div>
            
            {{-- DESAIN BARU TOTAL ARSIP: Lebih Profesional & Modern --}}
            <div class="flex items-center gap-4 bg-gradient-to-r from-blue-50 to-white border border-blue-100 px-5 py-3.5 rounded-2xl shadow-sm w-full md:w-auto">
                <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#1E3A8A] shrink-0 border border-blue-50">
                    <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-0.5">Total Arsip</p>
                    <p class="text-xl lg:text-2xl font-black text-[#1E3A8A] leading-none">
                        {{ $dokumens->count() }} <span class="text-xs lg:text-sm font-bold text-blue-600/60">Berkas</span>
                    </p>
                </div>
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
                <div onclick="openLaciModal('modal_laci_{{ $laci->id }}')" class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm hover:border-[#1E3A8A] hover:shadow-md cursor-pointer transition-all group click-effect">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-blue-50 text-[#1E3A8A] rounded-xl">
                            <span class="material-symbols-outlined" style="font-size: 32px;">folder</span>
                        </div>
                        <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-black border border-slate-200">
                            {{ $count }} File
                        </span>
                    </div>
                    <h4 class="font-bold text-slate-900 group-hover:text-[#1E3A8A] text-base">{{ $laci->nama_laci }}</h4>
                    <p class="text-xs text-slate-400 mt-1">Klik untuk melihat isi laci</p>
                </div>

                {{-- MODAL ISI LACI --}}
                <div id="modal_laci_{{ $laci->id }}" class="fixed inset-0 bg-black/40 hidden z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
                    <div class="bg-white rounded-xl w-full max-w-3xl max-h-[85vh] flex flex-col shadow-2xl">
                        {{-- Header Modal --}}
                        <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[#1E3A8A]">folder_open</span>
                                <h3 class="font-bold text-slate-900 text-lg">{{ $laci->nama_laci }}</h3>
                            </div>
                            <button onclick="closeModal('modal_laci_{{ $laci->id }}')" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all click-effect">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        
                        {{-- Body Modal (Scrollable) --}}
                        <div class="flex-1 overflow-y-auto p-5 space-y-3" id="laci_content_{{ $laci->id }}">
                            @forelse($dokumenDalamLaci as $dok)
                                <div class="dokumen-item flex items-center justify-between p-4 bg-slate-50/80 border border-slate-100 rounded-xl hover:bg-white transition-colors" data-dokumen-id="{{ $dok->id }}">
                                    <div class="flex items-center gap-4">
                                    {{-- Ikon PDF --}}
                                    <span class="material-symbols-outlined text-red-500" style="font-size: 36px;">picture_as_pdf</span>
                                    <div>
                                        {{-- Nama File sebagai Link Preview --}}
                                        <a href="{{ route('dosen.preview', $dok->id) }}" target="_blank" class="group flex items-center gap-1.5 click-effect">
                                            <p class="font-bold text-slate-900 text-sm group-hover:text-[#1E3A8A] group-hover:underline transition-all">
                                                {{ $dok->nama_file_asli }}
                                            </p>
                                            <span class="material-symbols-outlined text-[14px] text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity">open_in_new</span>
                                        </a>
                                        
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
                                                data-url="{{ route('dosen.status', $dok->id) }}"
                                                data-status="{{ $dok->status }}"
                                                data-note="{{ $dok->catatan_dosen ?? '' }}"
                                                data-dokumen-id="{{ $dok->id }}"
                                                title="Review Ulang">
                                            <span class="material-symbols-outlined">rate_review</span>
                                        </button>
                                        <a href="{{ route('dosen.download', $dok->id) }}" class="p-2 text-slate-500 hover:text-[#1E3A8A] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100 click-effect" title="Unduh">
                                            <span class="material-symbols-outlined">download</span>
                                        </a>
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
                        
                        {{-- Footer Modal --}}
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
    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-5 border-b border-slate-100 pb-3">
            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-600">rate_review</span>
                Review Dokumen
            </h3>
            <button type="button" onclick="closeReviewModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-lg hover:bg-red-50 click-effect">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <form id="reviewForm" onsubmit="submitReview(event)">
            @csrf
            {{-- Tidak menggunakan @method('PUT') karena route hanya mendukung POST --}}
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

{{-- Notifikasi Sukses Sementara --}}
<div id="ajaxSuccessToast" class="fixed bottom-6 right-6 bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg shadow-lg hidden z-[120] flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    <span id="ajaxSuccessMessage">Review berhasil disimpan.</span>
</div>

<script>
    // Simpan ID dokumen yang sedang direview
    let currentDokumenId = null;

    // Fungsi untuk modal laci
    function openLaciModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        event.stopPropagation();
        document.getElementById(id).classList.add('hidden');
    }

    // Fungsi untuk review modal (dengan AJAX)
    function openReviewModal(actionUrl, currentStatus, currentNote, dokumenId) {
        const modal = document.getElementById('reviewModal');
        const form = document.getElementById('reviewForm');
        form.action = actionUrl;
        form.status.value = currentStatus;
        form.catatan_dosen.value = currentNote || '';
        currentDokumenId = dokumenId;
        modal.classList.remove('hidden');
    }

    async function submitReview(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const url = form.action;
        
        // Tampilkan loading state pada tombol
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

            if (!response.ok) throw new Error('Gagal terhubung ke server');
            const result = await response.json();

            // 1. UPDATE LABEL STATUS DI LATAR BELAKANG DULUAN
            if (currentDokumenId) {
                const newStatus = formData.get('status');
                const dokumenItem = document.querySelector(`.dokumen-item[data-dokumen-id="${currentDokumenId}"]`);
                
                if (dokumenItem) {
                    const statusBadge = dokumenItem.querySelector('.status-badge');
                    if (statusBadge) {
                        statusBadge.className = 'status-badge px-2 py-0.5 rounded-full text-[9px] font-black border';
                        if (newStatus === 'disetujui') {
                            statusBadge.classList.add('bg-green-100', 'text-green-700', 'border-green-200');
                            statusBadge.textContent = 'Disetujui';
                        } else if (newStatus === 'ditolak') {
                            statusBadge.classList.add('bg-red-100', 'text-red-700', 'border-red-200');
                            statusBadge.textContent = 'Ditolak';
                        } else {
                            statusBadge.classList.add('bg-amber-100', 'text-amber-700', 'border-amber-200');
                            statusBadge.textContent = 'Pending';
                        }
                    }
                    
                    const reviewBtn = dokumenItem.querySelector('.btn-review');
                    if (reviewBtn) {
                        reviewBtn.dataset.status = newStatus;
                        reviewBtn.dataset.note = formData.get('catatan_dosen') || '';
                    }
                }
            }

            // 2. UBAH TAMPILAN TOMBOL JADI "SUKSES" SESAAT
            submitBtn.innerHTML = '<span class="material-symbols-outlined text-sm">check_circle</span> Tersimpan!';
            submitBtn.classList.remove('bg-[#1E3A8A]', 'hover-gradiant-primary');
            submitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
            
            // 3. TUTUP MODAL OTOMATIS SETELAH 600 MILIDETIK
            setTimeout(() => {
                closeReviewModal(); // Modal review tertutup!
                
                // Kembalikan tombol ke kondisi semula di latar belakang (persiapan kalau dosen buka dokumen lain)
                submitBtn.innerHTML = originalText;
                submitBtn.classList.add('bg-[#1E3A8A]', 'hover-gradiant-primary');
                submitBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                submitBtn.disabled = false;
            }, 600);
            
            // Tetap tampilkan Toast kecil di pojok kanan bawah
            const toast = document.getElementById('ajaxSuccessToast');
            document.getElementById('ajaxSuccessMessage').innerText = result.message || 'Review berhasil disimpan.';
            toast.classList.remove('hidden');
            toast.style.opacity = '1';
            setTimeout(() => {
                toast.style.transition = 'opacity 0.3s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.classList.add('hidden'), 300);
            }, 1500);

        } catch (error) {
            alert('Terjadi kesalahan: Server tidak merespon JSON dengan benar. Pastikan Controller sudah diperbarui.');
            console.error(error);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-review');
        if (!btn) return;
        e.stopPropagation();
        const dokumenId = btn.dataset.dokumenId;
        openReviewModal(btn.dataset.url, btn.dataset.status, btn.dataset.note, dokumenId);
    });

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        currentDokumenId = null;
    }

    // Tutup review modal jika klik di luar konten
    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) closeReviewModal();
    });

    // Tutup modal laci jika klik di luar konten (backdrop)
    document.querySelectorAll('[id^="modal_laci_"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) this.classList.add('hidden');
        });
    });

    // ==========================================
    // FITUR MOBILE: BUKA, SWIPE, & TAP LUAR SIDEBAR
    // ==========================================
    const sidebar = document.getElementById('sidebar');
    let touchstartX = 0;
    let touchendX = 0;

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
    }

    document.addEventListener('touchstart', e => {
        touchstartX = e.changedTouches[0].screenX;
    });

    document.addEventListener('touchend', e => {
        touchendX = e.changedTouches[0].screenX;
        if (touchstartX - touchendX > 50 && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    });

    document.addEventListener('click', function(event) {
        if (window.innerWidth >= 1024) return;
        
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnHamburger = event.target.closest('button[onclick="toggleSidebar()"]');

        if (!isClickInsideSidebar && !isClickOnHamburger && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    });

</script>

</body>
</html>