<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Dosen | One File Cabinet UHO</title>
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

{{-- SIDEBAR (KONSISTEN DENGAN DASHBOARD MAHASISWA) --}}
<nav class="h-screen w-56 border-r flex flex-col fixed left-0 top-0 bg-white shadow-sm z-40">
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
            <a class="flex items-center gap-3 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-4 py-2.5" href="{{ route('dosen.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5" href="{{ route('dosen.mahasiswa.index') }}">
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

{{-- HEADER + MAIN (MARGIN LEFT w-56) --}}
<div class="ml-56 min-h-screen flex flex-col">
    <header class="w-full h-16 sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-6 h-full">
            <h2 class="text-xl font-bold text-[#1E3A8A]">Dashboard Dosen</h2>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500">Dosen Teknik Informatika</p>
                </div>
                <div class="h-9 w-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold border border-slate-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </header>

    <main class="p-6 w-full">
        @if(session('success'))
            <div id="autoHideSuccess" class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- STATISTIK CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-[#1E3A8A] rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Berkas</p>
                    <p class="text-2xl font-black text-slate-900">{{ $totalDokumen ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-amber-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Perlu Review</p>
                    <p class="text-2xl font-black text-amber-600">{{ $pendingCount ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-green-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">check_circle</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Disetujui</p>
                    <p class="text-2xl font-black text-green-600">{{ $disetujuiCount ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-red-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">cancel</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ditolak</p>
                    <p class="text-2xl font-black text-red-600">{{ $ditolakCount ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm mb-6">
            <form action="{{ route('dosen.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIM mahasiswa..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-2 focus:ring-[#1E3A8A] text-sm">
                </div>
                <div class="relative">
                    <select name="angkatan" class="border border-slate-200 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-[#1E3A8A] bg-white text-sm font-medium text-slate-600 appearance-none pr-10">
                        <option value="">Semua Angkatan</option>
                        @if(isset($listAngkatan))
                            @foreach($listAngkatan as $thn)
                                <option value="{{ $thn }}" {{ request('angkatan') == $thn ? 'selected' : '' }}>20{{ $thn }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="bg-[#1E3A8A] text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-blue-900 transition-all shadow-md click-effect hover-gradiant-primary">
                    Filter
                </button>
            </form>
        </div>

        {{-- TABEL ANTREAN REVIEW (PENDING) --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-bold text-[#1E3A8A] uppercase text-xs tracking-wider">Antrean Review (Pending)</h3>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black shadow-sm">
                    {{ isset($dokumenPending) ? $dokumenPending->count() : 0 }} Berkas
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-white text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-4 text-left">Mahasiswa</th>
                            <th class="p-4 text-left">Laci</th>
                            <th class="p-4 text-left">Dokumen</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dokumenPending as $dok)
                        <tr class="hover:bg-slate-50/80 transition-colors dokumen-row" data-dokumen-id="{{ $dok->id }}">
                            <td class="p-4">
                                <div class="font-bold text-slate-900">{{ $dok->user->name }}</div>
                                <div class="text-[10px] text-slate-400 font-medium">NIM: {{ $dok->user->nim }}</div>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-md text-[10px] font-black uppercase border border-blue-100">
                                    {{ $dok->laci->nama_laci }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-red-500">picture_as_pdf</span>
                                    <span class="font-medium text-slate-700 truncate max-w-[200px]">{{ $dok->nama_file_asli }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('dosen.download', $dok->id) }}" class="p-2 text-slate-400 hover:text-[#1E3A8A] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100 click-effect" title="Unduh">
                                        <span class="material-symbols-outlined">download</span>
                                    </a>
                                    <button class="btn-review p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all border border-transparent hover:border-amber-100 click-effect" 
                                        data-url="{{ route('dosen.status', $dok->id) }}"
                                        data-status="{{ $dok->status }}"
                                        data-note="{{ $dok->catatan_dosen ?? '' }}"
                                        data-dokumen-id="{{ $dok->id }}"
                                        title="Review Dokumen">
                                        <span class="material-symbols-outlined">rate_review</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center">
                                <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                                    <span class="material-symbols-outlined text-4xl">task_alt</span>
                                </div>
                                <h4 class="text-slate-900 font-bold text-lg">Meja Kerja Bersih!</h4>
                                <p class="text-slate-500 text-sm mt-1">Semua submisi mahasiswa telah diperiksa.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

{{-- MODAL REVIEW --}}
<div id="reviewModal" class="fixed inset-0 bg-black/50 hidden z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-5 border-b border-slate-100 pb-3">
            <h3 class="text-lg font-bold text-slate-900">Review Dokumen</h3>
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
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#1E3A8A] text-white rounded-lg font-bold hover:bg-blue-900 transition-colors shadow-md click-effect" id="submitReviewBtn">
                    Simpan Review
                </button>
            </div>
        </form>
    </div>
</div>

{{-- TOAST NOTIFIKASI --}}
<div id="ajaxSuccessToast" class="fixed bottom-6 right-6 bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg shadow-lg hidden z-[120] flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    <span id="ajaxSuccessMessage">Review berhasil disimpan.</span>
</div>

<script>
    // Auto-hide notifikasi sukses
    const successAlert = document.getElementById('autoHideSuccess');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.4s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 400);
        }, 2000);
    }

    // Variabel global untuk menyimpan ID dokumen yang sedang direview
    let currentDokumenId = null;

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        currentDokumenId = null;
    }

    // Event listener untuk tombol review
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-review');
        if (!btn) return;
        e.stopPropagation();
        const dokumenId = btn.dataset.dokumenId || btn.getAttribute('data-dokumen-id');
        openReviewModal(btn.dataset.url, btn.dataset.status, btn.dataset.note, dokumenId);
    });

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

            // Hapus baris tabel yang sesuai dengan animasi
            if (currentDokumenId) {
                const row = document.querySelector(`tr[data-dokumen-id="${currentDokumenId}"]`);
                if (row) {
                    row.style.transition = 'all 0.4s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        row.remove();
                        // Update counter "Perlu Review" jika ada (opsional)
                    }, 400);
                }
            }

            // Tampilkan tombol "Tersimpan!"
            submitBtn.innerHTML = '<span class="material-symbols-outlined text-sm">check_circle</span> Tersimpan!';
            submitBtn.classList.remove('bg-[#1E3A8A]', 'hover-gradiant-primary');
            submitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');

            setTimeout(() => {
                closeReviewModal();
                // Kembalikan tombol ke kondisi semula
                submitBtn.innerHTML = originalText;
                submitBtn.classList.add('bg-[#1E3A8A]', 'hover-gradiant-primary');
                submitBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                submitBtn.disabled = false;
            }, 600);

            // Tampilkan toast
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
            alert('Terjadi kesalahan saat menyimpan review.');
            console.error(error);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    // Tutup modal jika klik di luar konten
    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) closeReviewModal();
    });
</script>

</body>
</html>