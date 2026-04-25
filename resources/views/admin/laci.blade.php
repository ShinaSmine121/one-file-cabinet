<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Manajemen Laci | One File Cabinet UHO</title>

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
    </style>
</head>
<body class="font-body-md text-slate-900">

{{-- SIDEBAR --}}
<aside id="sidebar" class="transform -translate-x-full lg:translate-x-0 transition-transform duration-300 h-screen w-72 border-r flex flex-col fixed left-0 top-0 bg-white shadow-sm z-[60]">
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
            <a class="flex items-center gap-4 text-slate-500 hover:bg-slate-50 px-6 py-3 transition-colors click-effect" href="{{ route('admin.mahasiswa.index') }}">
                <span class="material-symbols-outlined">group</span>
                <span class="font-label-md">Manajemen Mahasiswa</span>
            </a>
            <a class="flex items-center gap-4 text-slate-500 hover:bg-slate-50 px-6 py-3 transition-colors click-effect" href="{{ route('admin.dosen.index') }}">
                <span class="material-symbols-outlined">person</span>
                <span class="font-label-md">Manajemen Dosen</span>
            </a>
            <a class="flex items-center gap-4 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-6 py-3 click-effect" href="{{ route('admin.laci.index') }}">
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
<div class="lg:ml-72 min-h-screen flex flex-col transition-all duration-300">

    <header class="w-full h-16 sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-4 lg:px-8 h-full mx-auto w-full gap-2">
            
            {{-- KIRI: Tombol Menu & Judul --}}
            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg click-effect shrink-0">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="truncate">
                    <h2 class="text-lg lg:text-xl font-bold text-[#1E3A8A] truncate">
                        <span class="hidden sm:inline">Manajemen Laci</span>
                        <span class="sm:hidden">Data Laci</span>
                    </h2>
                </div>
            </div>

            {{-- KANAN: Profil Admin --}}
            <div class="flex items-center gap-2 sm:gap-3 pl-2 sm:pl-0 shrink-0 border-l sm:border-none border-slate-200">
                <div class="text-right min-w-0">
                    <p class="text-xs sm:text-sm font-bold text-slate-900 leading-tight truncate max-w-[90px] sm:max-w-none">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-[10px] sm:text-xs text-slate-500 font-medium truncate max-w-[90px] sm:max-w-none">
                        <span class="hidden sm:inline">{{ Auth::user()->email }}</span>
                        <span class="sm:hidden">Admin</span>
                    </p>
                </div>
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>

        </div>
    </header>

    <main class="p-4 sm:p-6 lg:p-8 mx-auto w-full space-y-4 lg:space-y-6">

        {{-- NOTIFIKASI SUKSES OTOMATIS HILANG --}}
        @if(session('success'))
            <div id="autoHideSuccess" class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2 animate-reveal">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- NOTIFIKASI ERROR (VERSI MERAH) --}}
        @if($errors->any())
            <div id="autoHideError" class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg flex items-start gap-3 animate-reveal mb-6 shadow-sm">
                <span class="material-symbols-outlined text-red-500 mt-0.5">error</span>
                <div>
                    <h3 class="font-bold text-sm">Sok ganteng lagi insepct inspect code-ku</h3>
                    <h4 class="font-bold text-sm">ga usah ngide kocak, eror</h4>
                    <ul class="text-xs mt-1 list-disc list-inside font-medium text-red-600">
                        @foreach ($errors->all() as $error)
                            {{-- Ubah pesan default bahasa Inggris ke Indonesia secara instan --}}
                            <li>{{ str_replace('The angkatan field must be 2 digits.', 'Kolom Angkatan harus tepat berisi 2 angka.', $error) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- FORM TAMBAH LACI --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-2">Tambah Laci Baru</h3>
            <p class="text-sm text-slate-500 mb-6">Buat kategori laci untuk mengelompokkan dokumen.</p>
            
            <form action="{{ route('admin.laci.store') }}" method="POST" class="flex flex-col md:flex-row gap-4 items-stretch md:items-end">
                @csrf
                {{-- Input Nama Laci --}}
                <div class="flex-[2] w-full">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Laci</label>
                    <input type="text" name="nama_laci" placeholder="Contoh: Proposal Kerja Praktek" 
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#1E3A8A] outline-none" required>
                </div>

                {{-- Input Angkatan (Dengan Proteksi UI & Pesan Eror) --}}
                <div class="flex-1 w-full">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Angkatan (2 Digit)</label>
                    <input type="text" 
                           inputmode="numeric" 
                           name="angkatan" 
                           placeholder="Contoh: 23" 
                           maxlength="2" 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           class="w-full px-4 py-2.5 border @error('angkatan') border-red-500 focus:ring-red-500 @else border-slate-200 focus:ring-[#1E3A8A] @enderror rounded-lg focus:ring-2 outline-none" 
                           required>
                </div>

                {{-- Tombol Tambah Laci: Lebar penuh dan teks ke tengah di HP --}}
                <button type="submit" 
                class="w-full md:w-auto justify-center group bg-[#1E3A8A] text-white px-6 py-2.5 rounded-lg font-bold 
                transition-all duration-300 flex items-center gap-2 
                shadow-md click-effect hover-gradiant-primary 
                hover:scale-105 hover:shadow-lg active:scale-95">
                    <span class="material-symbols-outlined text-sm transition-transform duration-300 group-hover:rotate-90">add</span> 
                    Tambah Laci
                </button>
            </form>
        </div>

        {{-- TABEL LACI --}}

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 px-1">
            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2 min-w-max">
                <span class="material-symbols-outlined text-lg">filter_list</span> 
                DAFTAR LACI:
            </h3>
            
            {{-- UI Filter Modern (Gaya Kapsul / Pills) --}}
            <div class="flex flex-wrap items-center gap-2">
                
                {{-- Tombol Semua Angkatan --}}
                <a href="{{ route('admin.laci.index') }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 click-effect flex items-center gap-1.5
                   {{ request('angkatan') == '' 
                        ? 'bg-[#1E3A8A] text-white shadow-md shadow-blue-900/20' 
                        : 'bg-white border border-slate-200 text-slate-500 hover:border-[#1E3A8A] hover:text-[#1E3A8A]' }}">
                    <span class="material-symbols-outlined text-[16px]">inventory_2</span>
                    Semua Laci
                </a>

                {{-- Looping Tombol Per Angkatan --}}
                @foreach($listAngkatan as $ang)
                    <a href="{{ route('admin.laci.index', ['angkatan' => $ang]) }}" 
                       class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 click-effect flex items-center gap-1.5
                       {{ request('angkatan') == $ang 
                            ? 'bg-[#1E3A8A] text-white shadow-md shadow-blue-900/20' 
                            : 'bg-white border border-slate-200 text-slate-500 hover:border-[#1E3A8A] hover:text-[#1E3A8A]' }}">
                        <span class="material-symbols-outlined text-[16px]">school</span>
                        20{{ $ang }}
                    </a>
                @endforeach
                
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="p-4 text-left font-semibold">Nama Laci</th>
                            <th class="p-4 text-left font-semibold">Angkatan</th> {{-- Kolom Baru --}}
                            <th class="p-4 text-left font-semibold">Dibuat Pada</th>
                            <th class="p-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($lacis as $laci)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4">
                                <div class="font-semibold text-slate-900">{{ $laci->nama_laci }}</div>
                            </td>
                            <td class="p-4">
                                {{-- Badge Angkatan --}}
                                <span class="px-2.5 py-1 bg-blue-50 text-[#1E3A8A] text-[10px] font-black rounded-md border border-blue-100">
                                    20{{ $laci->angkatan ?? '??' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="text-sm text-slate-500">{{ $laci->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-1">
                                    <button onclick="askConfirmDelete(`{{ route('admin.laci.destroy', $laci->id) }}`, `{{ $laci->nama_laci }}`)"
                                        class="p-2.5 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors click-effect" title="Hapus Laci">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-slate-500">
                                <span class="material-symbols-outlined text-3xl mb-2">inventory_2</span>
                                <p>Belum ada laci yang ditambahkan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($lacis, 'links'))
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $lacis->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

{{-- MODAL KONFIRMASI HAPUS --}}
<div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[60] backdrop-blur-sm">
    <div class="bg-white p-6 rounded-xl w-[400px] max-w-[90%] shadow-xl animate-reveal">
        <div id="modalIcon" class="mb-3 text-center">
            <span class="material-symbols-outlined text-4xl text-red-500">delete_forever</span>
        </div>
        <h3 id="modalTitle" class="font-bold text-lg text-slate-900 mb-1">Hapus Laci?</h3>
        <p id="modalMsg" class="text-sm text-slate-500 mb-6"></p>

        <div class="flex gap-3 justify-end">
            <button onclick="closeConfirm()" class="px-5 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 font-medium transition click-effect">Batal</button>
            <form id="confirmForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2 rounded-lg text-white font-medium bg-red-600 hover:bg-red-700 transition click-effect">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-hide notifikasi sukses
    const successAlert = document.getElementById('autoHideSuccess');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.4s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 400);
        }, 1500);
    }

    // Auto-hide notifikasi error (Tampil lebih lama: 4 detik)
    const errorAlert = document.getElementById('autoHideError');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.transition = 'opacity 0.4s ease';
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 400);
        }, 8000); 
    }

    function askConfirmDelete(url, namaLaci) {
        const modal = document.getElementById('confirmModal');
        const msg = document.getElementById('modalMsg');
        const form = document.getElementById('confirmForm');
        
        form.action = url;
        msg.innerText = `Anda akan menghapus laci "${namaLaci}". Semua dokumen di dalamnya mungkin akan terpengaruh. Lanjutkan?`;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeConfirm() {
        const modal = document.getElementById('confirmModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('confirmModal').addEventListener('click', function(e) {
        if (e.target === this) closeConfirm();
    });

    // FITUR MOBILE: BUKA, SWIPE, & TAP LUAR SIDEBAR
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