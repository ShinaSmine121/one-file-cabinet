<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Riwayat Berkas | One File Cabinet</title>
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
        body { font-family: 'Inter', sans-serif; background-color: #faf8ff; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .click-effect {
            transition: transform 0.1s ease, opacity 0.1s ease;
        }
        .click-effect:active {
            transform: scale(0.96);
            opacity: 0.8;
        }
        .hover-detail:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>
<body class="flex font-body-md text-slate-900">

{{-- SIDEBAR (IDENTIK DENGAN DASHBOARD) --}}
<nav id="sidebar" class="transform -translate-x-full lg:translate-x-0 transition-transform duration-300 h-screen w-56 border-r flex flex-col fixed left-0 top-0 bg-white shadow-sm z-50">
    <div class="flex flex-col h-full py-6">
        <div class="px-4 mb-8">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-8 h-8 rounded-lg bg-primary-container flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-lg">account_balance</span>
                </div>
                <div>
                    <h1 class="text-sm font-black text-[#1E3A8A] uppercase tracking-wider leading-tight">One File Cabinet</h1>
                    <p class="text-[10px] text-slate-500 font-medium">Portal Mahasiswa</p>
                </div>
            </div>
        </div>
        
        <div class="flex-1 space-y-1">
            <a class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5" href="{{ route('mahasiswa.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5" href="{{ route('mahasiswa.berkas') }}">
                <span class="material-symbols-outlined">folder_open</span>
                <span class="text-sm">Berkas Saya</span>
            </a>
            <a class="flex items-center gap-3 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-4 py-2.5" href="{{ route('mahasiswa.riwayat') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-sm">Riwayat Berkas</span>
            </a>
        </div>

        <div class="mt-auto pt-6 border-t border-slate-100">
            <form action="{{ route('login') }}" method="GET" class="w-full">
                <button type="submit" class="flex items-center w-full gap-3 text-red-600 hover:bg-red-50 px-4 py-2.5 click-effect">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-bold">Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- HEADER + MAIN (ML-56) --}}
<div class="lg:ml-56 min-h-screen flex flex-col w-full transition-all duration-300">
    <header class="w-full h-16 sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-4 lg:px-6 h-full gap-2">
            
            {{-- KIRI: Tombol Menu & Judul --}}
            <div class="flex items-center gap-2 min-w-0">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg click-effect shrink-0">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="truncate">
                    <h2 class="text-lg lg:text-xl font-bold text-[#1E3A8A] truncate">
                        <span class="sm:inline hidden">Riwayat Berkas</span>
                        <span class="sm:hidden">Riwayat</span>
                    </h2>
                </div>
            </div>

            {{-- KANAN: Statistik & Profil --}}
            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                
                {{-- Lencana Total Berkas (Kini Muncul di Mobile & Desktop) --}}
                <div class="flex items-center gap-1.5 bg-blue-50 border border-blue-100 text-[#1E3A8A] px-2.5 sm:px-4 py-1.5 rounded-full shadow-sm shrink-0">
                    <span class="material-symbols-outlined text-[16px] sm:text-[18px]">inventory_2</span>
                    <span class="text-[10px] sm:text-xs font-black tracking-wide mt-0.5">
                        {{ $dokumens->count() }} <span class="hidden xs:inline sm:inline">Berkas</span>
                    </span>
                </div>

                {{-- Informasi Profil Mahasiswa --}}
                <div class="flex items-center gap-2 sm:gap-3 pl-2 border-l border-slate-200">
                    <div class="text-right min-w-0">
                        <p class="text-xs sm:text-sm font-bold text-slate-900 leading-tight truncate max-w-[80px] sm:max-w-none">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-[10px] sm:text-xs text-slate-500 leading-none">
                            {{ Auth::user()->nim }}
                        </p>
                    </div>
                    <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold border border-slate-200 shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

        </div>
    </header>

    <main class="p-6 w-full max-w-[1400px]">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Nama Berkas</th>
                            <th class="px-6 py-4 text-left font-semibold">Laci</th>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal Unggah</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dokumens as $dok)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-red-500">picture_as_pdf</span>
                                    <span class="font-medium text-slate-800">{{ $dok->nama_file_asli }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $dok->laci->nama_laci ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $dok->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($dok->status) {
                                        'disetujui' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'ditolak' => 'bg-red-50 text-red-700 border-red-200',
                                        default => 'bg-amber-50 text-amber-700 border-amber-200'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusColor }}">
                                    {{ ucfirst($dok->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-[#1E3A8A] bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors click-effect hover-detail"
                                        onclick="showDetailModal(this)"
                                        data-nama="{{ e($dok->nama_file_asli) }}"
                                        data-status="{{ $dok->status }}"
                                        data-catatan="{{ e($dok->catatan_dosen) }}">
                                    <span class="material-symbols-outlined text-base">info</span>
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <span class="material-symbols-outlined text-4xl mb-2">description_off</span>
                                <p>Belum ada riwayat pengunggahan berkas.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($dokumens, 'links'))
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $dokumens->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

{{-- MODAL DETAIL CATATAN DOSEN --}}
<div id="detailModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-lg w-full shadow-2xl">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold text-slate-900">Detail Berkas</h3>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <p class="text-sm font-semibold text-slate-500 mb-1">Nama Berkas</p>
                <p class="text-slate-800 font-medium" id="modalFileName"></p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-slate-500 mb-1">Status Review</p>
                <p id="modalStatus"></p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Catatan Dosen</p>
                <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 text-slate-700 italic" id="modalNote">
                    -
                </div>
            </div>
        </div>
        <div class="p-4 border-t bg-slate-50 flex justify-end">
            <button onclick="closeDetailModal()" 
            class="group px-5 py-2 bg-[#1E3A8A] text-white rounded-lg font-medium 
            transition-all duration-300 shadow-md 
            click-effect hover-gradiant-primary 
            hover:scale-105 hover:shadow-lg active:scale-95">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function showDetailModal(btn) {
        const nama = btn.dataset.nama;
        const status = btn.dataset.status;
        const catatan = btn.dataset.catatan || 'Tidak ada catatan dari dosen.';

        document.getElementById('modalFileName').innerText = nama;
        
        const statusElement = document.getElementById('modalStatus');
        let statusBadge = '';
        if (status === 'disetujui') {
            statusBadge = '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border bg-emerald-50 text-emerald-700 border-emerald-200">Disetujui</span>';
        } else if (status === 'ditolak') {
            statusBadge = '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border bg-red-50 text-red-700 border-red-200">Ditolak</span>';
        } else {
            statusBadge = '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border bg-amber-50 text-amber-700 border-amber-200">Pending</span>';
        }
        statusElement.innerHTML = statusBadge;
        
        document.getElementById('modalNote').innerText = catatan;
        
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
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