<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Mahasiswa | One File Cabinet UHO</title>
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
    </style>
</head>
<body class="font-body-md text-slate-900">

{{-- MODAL PENCEGAT UNTUK AKUN GENERATE MASSAL --}}
{{-- Muncul jika nama user masih default (mengandung kata "Mahasiswa" atau sama dengan NIM) --}}
@if(str_contains(Auth::user()->name, 'Mahasiswa') || Auth::user()->name == Auth::user()->nim)
<div class="fixed inset-0 bg-slate-900/80 z-[100] flex items-center justify-center p-4 backdrop-blur-md">
    <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl relative overflow-hidden transform transition-all">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 z-0"></div>
        
        <div class="relative z-10">
            <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-2xl flex items-center justify-center mb-6 shadow-sm mx-auto">
                <span class="material-symbols-outlined text-3xl">badge</span>
            </div>
            <h3 class="text-2xl font-black text-center text-slate-900 mb-2">Lengkapi Profil Anda</h3>
            <p class="text-center text-slate-500 mb-8 text-sm font-medium">Akun Anda di-generate secara otomatis oleh Admin. Untuk melanjutkan, silakan masukkan nama lengkap Anda sesuai SIAKAD.</p>

            <form action="{{ route('mahasiswa.update_nama') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Contoh: Vino G Bastian" 
                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-900 outline-none transition-colors text-sm font-medium">
                </div>
                
                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Set Password Baru</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" 
                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-900 outline-none transition-colors text-sm font-medium">
                    <p class="text-[10px] text-slate-500 mt-1.5 font-medium">*Ganti password default (NIM) Anda demi keamanan akun.</p>
                    
                    {{-- Menampilkan error khusus password jika ada --}}
                    @error('password')
                        <p class="text-xs text-red-600 mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-900 text-white font-extrabold py-3.5 rounded-xl hover:bg-blue-800 shadow-lg shadow-blue-900/20 active:scale-95 transition-all">
                    SIMPAN PROFIL & LANJUTKAN
                </button>
            </form>
        </div>
    </div>
</div>
@endif

{{-- SIDEBAR (LEBAR 14rem = w-56) --}}
{{-- Tambahkan ID dan class transform untuk efek geser di mobile --}}
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
            <a class="flex items-center gap-3 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-4 py-2.5" href="{{ route('mahasiswa.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5" href="{{ route('mahasiswa.berkas') }}">
                <span class="material-symbols-outlined">folder_open</span>
                <span class="text-sm">Berkas Saya</span>
            </a>
            <a class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5" href="{{ route('mahasiswa.riwayat') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-sm">Riwayat Berkas</span>
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
{{-- Hapus margin-left di HP, tapi pertahankan di Laptop (lg:ml-56) --}}
<div class="lg:ml-56 min-h-screen flex flex-col transition-all duration-300">
    <header class="w-full h-16 sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-4 lg:px-6 h-full">
            <div class="flex items-center gap-3">
                {{-- Tombol Hamburger (Hanya muncul di HP) --}}
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg click-effect">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h2 class="text-xl font-bold text-[#1E3A8A] hidden sm:block">Portal Mahasiswa</h2>
                <h2 class="text-lg font-bold text-[#1E3A8A] sm:hidden">Portal</h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ Auth::user()->nim }}</p>
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
            <div id="autoHideError" class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-red-500">error</span>
                <p class="text-sm font-bold">
                    @php
                        $errorMsg = strtolower($errors->first());
                        if (str_contains($errorMsg, 'greater than') || str_contains($errorMsg, 'maximum') || str_contains($errorMsg, 'size')) {
                            echo 'Gagal mengunggah: Ukuran berkas terlalu besar. Silakan kompres PDF/Word Anda dan coba lagi.';
                        } elseif (str_contains($errorMsg, 'type') || str_contains($errorMsg, 'mimes')) {
                            echo 'Gagal mengunggah: Format berkas tidak didukung. Harap gunakan format .PDF, .DOC, atau .DOCX.';
                        } else {
                            echo 'Gagal mengunggah: Terjadi kesalahan. Pastikan berkas yang Anda pilih valid.';
                        }
                    @endphp
                </p>
            </div>
        @endif

        <section class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-1">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-slate-500">Kelola dan unggah berkas akademikmu ke dalam laci yang tepat.</p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($lacis as $laci)
                <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-11 h-11 bg-blue-50 text-[#1E3A8A] rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">folder</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-2">{{ $laci->nama_laci }}</h3>
                    <p class="text-slate-500 text-sm mb-5">{{ $laci->deskripsi ?? 'Silakan unggah dokumen terkait ke laci ini.' }}</p>
                    
                    <form action="{{ route('mahasiswa.upload') }}" method="POST" enctype="multipart/form-data" class="w-full">
                        @csrf
                        <input type="hidden" name="laci_id" value="{{ $laci->id }}">
                        <input type="file" name="file_dokumen" id="file_{{ $laci->id }}" class="hidden" onchange="this.form.submit()" accept=".pdf,.doc,.docx">
                        
                        <button type="button" onclick="document.getElementById('file_{{ $laci->id }}').click()" 
                            class="w-full border-2 border-[#1E3A8A] text-[#1E3A8A] font-bold py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 hover:bg-[#1E3A8A] hover:text-white transition-colors cursor-pointer click-effect">
                            <span class="material-symbols-outlined">upload</span>
                            <span>Unggah Berkas</span>
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full p-8 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-center">
                    <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">inventory_2</span>
                    <p class="text-slate-500 font-bold">Belum ada Laci yang dibuat oleh Admin.</p>
                </div>
            @endforelse
        </section>
    </main>
</div>

<script>
    // Auto-hide success notification after 3 seconds
    const successAlert = document.getElementById('autoHideSuccess');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.3s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 300);
        }, 1500);
    }

    // TAMPILKAN DAN HILANGKAN ERROR OTOMATIS DALAM 3 DETIK (3000ms)
    const errorAlert = document.getElementById('autoHideError');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.transition = 'opacity 0.3s ease';
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 300);
        }, 4000);
    }

    // Fungsi untuk membuka/menutup sidebar dari tombol hamburger
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    // ==========================================
    // FITUR MOBILE: SWIPE & KLIK DI LUAR SIDEBAR
    // ==========================================
    const sidebar = document.getElementById('sidebar');
    let touchstartX = 0;
    let touchendX = 0;

    // 1. Sensor Deteksi Swipe (Usap Layar)
    document.addEventListener('touchstart', e => {
        touchstartX = e.changedTouches[0].screenX;
    });

    document.addEventListener('touchend', e => {
        touchendX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        // Jika jari mengusap ke KIRI lebih dari 50 pixel, dan sidebar sedang terbuka
        if (touchstartX - touchendX > 50 && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full'); // Tutup sidebar
        }
    }

    // 2. Sensor Deteksi Klik di Luar Sidebar
    document.addEventListener('click', function(event) {
        // Cek apakah yang diklik adalah bagian dalam sidebar atau tombol hamburger
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnHamburger = event.target.closest('button[onclick="toggleSidebar()"]');

        // Jika layar lebar (Desktop), abaikan fitur ini
        if (window.innerWidth >= 1024) return; 

        // Jika user mengeklik di LUAR sidebar dan BUKAN mengeklik tombol hamburger
        if (!isClickInsideSidebar && !isClickOnHamburger && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full'); // Tutup sidebar
        }
    });

</script>

</body>
</html>