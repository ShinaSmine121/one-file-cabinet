<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard | One File Cabinet UHO</title>
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
            <a class="flex items-center gap-4 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-6 py-3 click-effect" href="#">
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

<div class="ml-72 min-h-screen flex flex-col">
    
    <header class="w-full h-16 sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-8 h-full mx-auto w-full">
            <h2 class="text-xl font-bold text-[#1E3A8A]">Dashboard Administrator</h2>
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

    <main class="p-8 mx-auto w-full space-y-8">
        
        {{-- NOTIFIKASI SUKSES (OTOMATIS HILANG) --}}
        @if(session('success'))
            <div id="autoHideSuccess" class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2 animate-reveal">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR --}}
        @if(session('error'))
            <div id="autoHideError" class="p-4 mb-6 bg-red-100 border border-red-400 text-red-700 rounded-lg font-semibold animate-reveal transition-all duration-500">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div id="autoHideValidationError" class="p-4 mb-6 bg-red-100 border border-red-400 text-red-700 rounded-lg font-semibold animate-reveal transition-all duration-500">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Generate Massal Card --}}
        <section class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-2">Generate Akun Mahasiswa Massal</h3>
            <p class="text-sm text-slate-500 mb-6">Buat puluhan akun mahasiswa secara otomatis berdasarkan angkatan (Format: E1E1XX001).</p>
            
            <form action="{{ route('admin.generate.mahasiswa') }}" method="POST" class="flex items-end gap-4">
                @csrf
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Angkatan (2 digit)</label>
                    <input type="number" name="angkatan" required min="10" max="99" placeholder="Contoh: 23" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#1E3A8A] outline-none">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Jumlah Mahasiswa</label>
                    <input type="number" name="jumlah" required min="1" max="200" placeholder="Contoh: 70" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#1E3A8A] outline-none">
                </div>
                <button type="submit" class="bg-[#1E3A8A] text-white px-6 py-2.5 rounded-lg font-bold transition-all flex items-center gap-2 click-effect hover-gradiant-primary">
                    <span class="material-symbols-outlined text-sm">group_add</span> Generate Akun
                </button>
            </form>
        </section>

        {{-- FORM TAMBAH SATUAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            
            {{-- Form Tambah Mahasiswa --}}
            <section class="bg-white rounded-xl border border-slate-100 shadow-sm p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                
                <h3 class="text-lg font-bold text-slate-900 mb-6 relative z-10 flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-900">school</span> Tambah Mahasiswa
                </h3>
                
                <form action="{{ route('admin.store.user') }}" method="POST" class="space-y-4 relative z-10">
                    @csrf
                    <input type="hidden" name="role" value="mahasiswa">
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required placeholder="Yura Yunita" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-900 outline-none transition-colors">
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Angkatan (XX)</label>
                            <div class="flex items-center">
                                <span class="bg-slate-200 text-slate-600 font-bold px-3 py-2 rounded-l-lg border border-r-0 border-slate-200">E1E1</span>
                                <input type="text" name="angkatan" required maxlength="2" placeholder="23" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-r-lg focus:bg-white focus:ring-2 focus:ring-blue-900 outline-none transition-colors">
                            </div>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">No. Urut (XXX)</label>
                            <input type="text" name="absen" required maxlength="3" placeholder="001" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-900 outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-900 outline-none transition-colors">
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-900 text-white px-4 py-3 rounded-lg font-bold transition-all shadow-lg shadow-blue-900/20 mt-2 click-effect hover:bg-gradient-to-r hover:from-blue-800 hover:to-blue-950">
                        Simpan Mahasiswa
                    </button>
                </form>
            </section>

            {{-- Form Tambah Dosen --}}
            <section class="bg-white rounded-xl border border-slate-100 shadow-sm p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>

                <h3 class="text-lg font-bold text-slate-900 mb-6 relative z-10 flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-600">person_4</span> Tambah Dosen
                </h3>
                
                <form action="{{ route('admin.store.user') }}" method="POST" class="space-y-4 relative z-10">
                    @csrf
                    <input type="hidden" name="role" value="dosen">
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap & Gelar</label>
                        <input type="text" name="name" required placeholder="Dr. Yura, M.T." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-amber-500 outline-none transition-colors">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email Kampus</label>
                        <input type="email" name="email" required placeholder="dosen@uho.ac.id" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-amber-500 outline-none transition-colors">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-amber-500 outline-none transition-colors">
                    </div>
                    
                    <button type="submit" class="w-full bg-amber-500 text-white px-4 py-3 rounded-lg font-bold transition-all shadow-lg shadow-amber-500/20 mt-2 click-effect hover:bg-gradient-to-r hover:from-amber-500 hover:to-amber-600">
                        Simpan Dosen
                    </button>
                </form>
            </section>

        </div>

        {{-- STATISTIK CARD --}}
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-blue-50 rounded-lg inline-block mb-4">
                    <span class="material-symbols-outlined text-[#1E3A8A]">group</span>
                </div>
                <p class="text-slate-500 font-label-sm uppercase tracking-wider mb-1">Total Mahasiswa</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ \App\Models\User::where('role', 'mahasiswa')->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-amber-50 rounded-lg inline-block mb-4">
                    <span class="material-symbols-outlined text-amber-600">inventory_2</span>
                </div>
                <p class="text-slate-500 font-label-sm uppercase tracking-wider mb-1">Total Laci Aktif</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ \App\Models\Laci::count() }}</h3>
            </div>
             <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-emerald-50 rounded-lg inline-block mb-4">
                    <span class="material-symbols-outlined text-emerald-600">description</span>
                </div>
                <p class="text-slate-500 font-label-sm uppercase tracking-wider mb-1">Dokumen Tersimpan</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ \App\Models\Dokumen::count() }}</h3>
            </div>
        </section>

    </main>
</div>

<script>
    // Fungsi dinamis untuk menghapus alert apa saja berdasarkan ID
    function setAutoHide(elementId, delay = 1500) {
        const element = document.getElementById(elementId);
        if (element) {
            setTimeout(() => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(-10px)';
                
                setTimeout(() => {
                    element.remove();
                }, 500);
            }, delay);
        }
    }

    // Panggil fungsi untuk ketiga jenis notifikasi
    setAutoHide('autoHideSuccess');
    setAutoHide('autoHideError');
    setAutoHide('autoHideValidationError');
</script>
</body>
</html>