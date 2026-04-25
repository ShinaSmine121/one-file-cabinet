<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | One File Cabinet UHO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .uho-gradient {
            background: linear-gradient(135deg, #00236f 0%, #1e3a8a 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-slate-50 antialiased">

<div class="min-h-screen flex">
    {{-- SISI KIRI: Visual & Branding (Hidden on Mobile) --}}
    <div class="hidden lg:flex lg:w-1/2 uho-gradient flex-col justify-between p-12 text-white relative overflow-hidden">
        {{-- Dekorasi Abstrak --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/20 rounded-full -mr-48 -mt-48 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-yellow-400/10 rounded-full -ml-48 -mb-48 blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-2 bg-white/10 rounded-xl backdrop-blur-md border border-white/20">
                    <span class="material-symbols-outlined text-yellow-400 text-3xl">account_balance</span>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight uppercase">One File Cabinet</h1>
            </div>
            
            <div class="mt-20">
                <h2 class="text-5xl font-extrabold leading-tight">Digitalisasi Arsip <br><span class="text-yellow-400">Teknik Informatika</span></h2>
                <p class="mt-6 text-blue-100 text-lg max-w-md leading-relaxed">
                    Sistem manajemen dokumen terpadu untuk mahasiswa dan dosen Jurusan Teknik Informatika. Cepat, aman, dan terorganisir.
                </p>
            </div>
        </div>

        <div class="relative z-10 flex items-center gap-4 text-sm font-medium text-blue-200">
            <span>© 2026 Jurusan Teknik Informatika UHO</span>
            <span class="w-1 h-1 bg-blue-400 rounded-full"></span>
            <span>Kendari, Sulawesi Tenggara</span>
        </div>
    </div>

    {{-- SISI KANAN: Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white lg:bg-transparent">
        <div class="max-w-md w-full">
            {{-- Mobile Logo --}}
            <div class="lg:hidden flex justify-center mb-8">
                <div class="flex items-center gap-2">
                    <div class="p-2 bg-blue-900 rounded-lg text-white">
                        <span class="material-symbols-outlined">account_balance</span>
                    </div>
                    <span class="font-black text-blue-900 uppercase">One File Cabinet</span>
                </div>
            </div>

            <div class="glass-effect p-6 sm:p-8 lg:p-10 rounded-3xl lg:shadow-2xl lg:border lg:border-slate-100">
                <div class="mb-10">
                    <h3 class="text-3xl font-extrabold text-slate-900">Selamat Datang</h3>
                    <p class="text-slate-500 mt-2 font-medium">Silakan masuk untuk mengakses laci dokumen Anda.</p>
                </div>

              {{-- Alert Error (Menangkap Session Error DAN Validation Error) --}}
                @if(session('error') || $errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl flex items-start gap-3 animate-pulse shadow-sm">
                    <span class="material-symbols-outlined text-xl shrink-0">error</span>
                    <div class="text-sm font-bold mt-0.5">
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" autocomplete="off" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-widest mb-2 px-1">NIM / Email Kampus</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center {{ (session('error') || $errors->any()) ? 'text-red-500' : 'text-slate-400 group-focus-within:text-blue-900' }} transition-colors">
                                <span class="material-symbols-outlined">person</span>
                            </span>
                            {{-- Tambahkan value="{{ old('identifier') }}" agar ketikan NIM sebelumnya tidak hilang saat error --}}
                            <input type="text" name="identifier" required value="{{ old('identifier') }}"
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border {{ (session('error') || $errors->any()) ? 'border-red-400 focus:border-red-600 focus:ring-red-100 bg-red-50/30' : 'border-slate-200 focus:border-blue-900 focus:ring-blue-100' }} rounded-2xl text-sm focus:bg-white focus:ring-4 outline-none transition-all" 
                                placeholder="E1E1xx... / example@uho.ac.id">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 px-1">
                            <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-widest">Kata Sandi</label>
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center {{ (session('error') || $errors->any()) ? 'text-red-500' : 'text-slate-400 group-focus-within:text-blue-900' }} transition-colors">
                                <span class="material-symbols-outlined">lock</span>
                            </span>
                            <input type="password" name="password" required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border {{ (session('error') || $errors->any()) ? 'border-red-400 focus:border-red-600 focus:ring-red-100 bg-red-50/30' : 'border-slate-200 focus:border-blue-900 focus:ring-blue-100' }} rounded-2xl text-sm focus:bg-white focus:ring-4 outline-none transition-all" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center px-1">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-slate-300 text-blue-900 focus:ring-blue-900 transition-all cursor-pointer">
                            <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Ingat perangkat ini</span>
                        </label>
                    </div>

                    <button type="submit" 
                        class="w-full bg-blue-900 text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-blue-900/20 hover:bg-blue-800 hover:shadow-xl hover:-translate-y-0.5 active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span>MASUK SEKARANG</span>
                        <span class="material-symbols-outlined text-xl">login</span>
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-sm text-slate-500 font-medium">Butuh bantuan akses? <br> 
                        <a href="#" onclick="openHelpModal(event)" class="text-blue-900 font-bold hover:underline transition-all">Hubungi Admin Lab Informatika</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL BANTUAN AKSES (POP-UP) --}}
{{-- MODAL BANTUAN AKSES (POP-UP) --}}
<div id="helpModal" class="fixed inset-0 bg-slate-900/60 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div id="helpModalContent" class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl transform scale-95 transition-all duration-300">
        
        {{-- Header Modal --}}
        <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
            <h3 class="text-xl font-extrabold text-blue-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-yellow-500 text-2xl">warning</span>
                Pusat Bantuan
            </h3>
            <button onclick="closeHelpModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1.5 rounded-xl hover:bg-red-50 active:scale-95">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        {{-- Body Modal --}}
        <div class="text-sm text-slate-600 font-medium text-justify leading-relaxed mb-6 space-y-3">
            <p>
                Untuk mereset kata sandi atau kendala akses lainnya, silakan mengunjungi langsung <b class="text-slate-800">Ruang Admin (Ruang Jurusan Teknik Informatika)</b> pada jam kerja 09:00 - 15:30 WITA.
            </p>
            <p class="p-3 bg-blue-50 rounded-xl text-blue-900 border border-blue-100 text-xs">
                <b class="flex items-center gap-1 mb-1"><span class="material-symbols-outlined text-[14px]">info</span> Opsi Alternatif:</b>
                Anda juga dapat menghubungi Admin melalui WhatsApp untuk respons cepat.
            </p>
        </div>
        
        {{-- Footer Modal (Dua Tombol: Tumpuk di HP, Sebelahan di PC) --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <button onclick="closeHelpModal()" class="flex-1 px-4 py-3 border-2 border-slate-100 text-slate-500 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-700 active:scale-95 transition-all">
                Tutup
            </button>
            
            {{-- Ganti nomor 6281234567890 dengan nomor WhatsApp Admin yang asli --}}
            <a href="https://wa.me/6282190314067?text=Halo%20Admin%20Jurusan,%20saya%20mahasiswa%20Teknik%20Informatika.%20Saya%20butuh%20bantuan%20akses%20login%20untuk%20sistem%20One%20File%20Cabinet." target="_blank" 
            class="flex-[2] bg-blue-900 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-900/20 hover:bg-blue-800 active:scale-95 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">forum</span>
                Chat Admin
            </a>
        </div>
    </div>
</div>

<script>
    function openHelpModal(e) {
        if(e) e.preventDefault(); // Mencegah halaman scroll ke atas
        const modal = document.getElementById('helpModal');
        const content = document.getElementById('helpModalContent');
        
        // Tampilkan elemen dulu
        modal.classList.remove('hidden');
        
        // Trigger animasi perlahan (fade-in & zoom-in)
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function closeHelpModal() {
        const modal = document.getElementById('helpModal');
        const content = document.getElementById('helpModalContent');
        
        // Trigger animasi menghilang
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        
        // Sembunyikan elemen setelah animasi selesai (300ms)
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Fitur tambahan: Tutup modal kalau user klik di luar kotak putih
    document.getElementById('helpModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeHelpModal();
        }
    });
</script>

</body>
</html>