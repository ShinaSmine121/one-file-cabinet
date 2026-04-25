<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Manajemen Mahasiswa | One File Cabinet UHO</title>

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
                        <span class="hidden sm:inline">Manajemen Mahasiswa</span>
                        <span class="sm:hidden">Data Mahasiswa</span>
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

        {{-- FILTER CARD --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden p-6 mb-6">
            <form method="GET" class="flex flex-col md:flex-row gap-4 items-stretch md:items-end">
                <div class="flex-1 w-full">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Cari Nama / NIM</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#1E3A8A] outline-none"
                               placeholder="Ketik nama atau NIM">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Angkatan</label>
                    <select name="angkatan" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#1E3A8A] outline-none bg-white">
                        <option value="">Semua Angkatan</option>
                        @foreach($listAngkatan as $thn)
                            <option value="{{ $thn }}" {{ request('angkatan') == $thn ? 'selected' : '' }}>
                                20{{ $thn }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Tombol Filter dan Reset: Memanjang di HP, Mengecil di PC --}}
                <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto mt-2 md:mt-0">
                    <button type="submit" 
                    class="w-full sm:w-auto bg-[#1E3A8A] text-white px-6 py-2.5 rounded-lg font-bold 
                    transition-all duration-300 flex items-center justify-center gap-2 
                    shadow-md click-effect hover-gradiant-primary 
                    hover:scale-105 hover:shadow-lg active:scale-95">
                        <span class="material-symbols-outlined text-sm transition-transform duration-300 group-hover:rotate-6">
                            filter_alt
                        </span> 
                        Filter
                    </button>
                    @if(request('search') || request('angkatan'))
                        <a href="{{ route('admin.mahasiswa.index') }}" class="w-full sm:w-auto border border-slate-300 text-slate-700 px-4 py-2.5 rounded-lg font-medium hover:bg-slate-50 transition-colors flex items-center justify-center click-effect">
                            <span class="material-symbols-outlined text-sm">close</span> Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- TOMBOL HAPUS MASSAL DIPISAH KE BAWAH AGAR RAPI --}}
            @if(request('angkatan'))
            <div class="mt-5 pt-4 border-t border-slate-100 flex justify-end animate-reveal">
                <button type="button" 
                    id="btnBulkDelete"
                    data-angkatan="{{ request('angkatan') }}" 
                    data-total="{{ method_exists($mahasiswas, 'total') ? $mahasiswas->total() : $mahasiswas->count() }}"
                    onclick="askBulkDelete(this)" 
                    class="bg-red-50 text-red-600 border border-red-200 px-5 py-2 rounded-lg font-bold hover:bg-red-600 hover:text-white transition-all flex items-center gap-2 click-effect shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">delete_sweep</span> 
                    Hapus Seluruh Data Angkatan 20{{ request('angkatan') }}
                </button>
            </div>
            @endif
        </div>

        {{-- TABEL MAHASISWA --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="p-4 text-left font-semibold">Mahasiswa</th>
                            <th class="p-4 text-center font-semibold">Dokumen</th>
                            <th class="p-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($mahasiswas as $mhs)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4">
                                <div class="font-semibold text-slate-900">{{ $mhs->name }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $mhs->nim }}</div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <span class="material-symbols-outlined text-sm">description</span>
                                    {{ $mhs->dokumens_count ?? 0 }} file
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('admin.mahasiswa.arsip', $mhs->id) }}"
                                    class="p-2.5 text-slate-500 hover:text-[#1E3A8A] hover:bg-blue-50 rounded-lg transition-colors click-effect" title="Buka Arsip">
                                        <span class="material-symbols-outlined">folder_shared</span>
                                    </a>
                                    
                                    <button onclick="askConfirm('reset', `{{ route('admin.mahasiswa.reset', $mhs->id) }}`, `{{ $mhs->name }}`)"
                                        class="p-2.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors click-effect" title="Reset Password">
                                        <span class="material-symbols-outlined">lock_reset</span>
                                    </button>
                                    <button onclick="askConfirm('delete', `{{ route('admin.mahasiswa.destroy', $mhs->id) }}`, `{{ $mhs->name }}`)"
                                        class="p-2.5 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors click-effect" title="Hapus Mahasiswa">
                                        <span class="material-symbols-outlined">person_remove</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-slate-500">
                                <span class="material-symbols-outlined text-3xl mb-2">search_off</span>
                                <p>Tidak ada data mahasiswa ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($mahasiswas, 'links'))
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $mahasiswas->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

{{-- MODAL KONFIRMASI --}}
<div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[60] backdrop-blur-sm">
    <div class="bg-white p-8 rounded-2xl w-[420px] max-w-[95%] shadow-2xl animate-reveal text-center">
        {{-- Ikon tetap di tengah karena parent-nya text-center --}}
        <div id="modalIcon" class="mb-4 flex justify-center"></div>
        
        {{-- JUDUL: Rata Tengah --}}
        <h3 id="modalTitle" class="font-black text-xl text-slate-900 mb-3 text-center leading-tight"></h3>
        
        {{-- DESKRIPSI: Rata Kiri-Kanan (Justify) --}}
        <p id="modalMsg" class="text-sm text-slate-500 mb-8 text-justify leading-relaxed"></p>

        <div class="flex gap-3 justify-stretch">
            <button onclick="closeConfirm()" class="flex-1 px-5 py-3 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 font-bold transition click-effect">
                Batal
            </button>
            <form id="confirmForm" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="_method" id="formMethod">
                <button id="btnAction" class="w-full px-5 py-3 rounded-xl text-white font-bold transition click-effect"></button>
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

    function askConfirm(type, url, name) {
        const modal = document.getElementById('confirmModal');
        const title = document.getElementById('modalTitle');
        const msg = document.getElementById('modalMsg');
        const btn = document.getElementById('btnAction');
        const form = document.getElementById('confirmForm');
        const method = document.getElementById('formMethod');
        const icon = document.getElementById('modalIcon');

        form.action = url;

        if (type === 'delete') {
            title.innerText = 'Hapus Mahasiswa?';
            msg.innerText = `Anda akan menghapus "${name}" secara permanen. Data dokumen terkait juga akan terhapus.`;
            btn.innerText = 'Ya, Hapus';
            btn.className = 'px-5 py-2 rounded-lg text-white font-medium bg-red-600 hover:bg-red-700 transition click-effect';
            method.value = 'DELETE';
            icon.innerHTML = '<span class="material-symbols-outlined text-4xl text-red-500">delete_forever</span>';
        } else {
            title.innerText = 'Reset Password?';
            msg.innerText = `Password untuk "${name}" akan direset menjadi NIM-nya. Lanjutkan?`;
            btn.innerText = 'Reset';
            btn.className = 'px-5 py-2 rounded-lg text-white font-medium bg-amber-500 hover:bg-amber-600 transition click-effect';
            method.value = 'POST';
            icon.innerHTML = '<span class="material-symbols-outlined text-4xl text-amber-500">lock_reset</span>';
        }

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

    // Fungsi Konfirmasi Hapus Massal dengan Proteksi Data Kosong
    function askBulkDelete(el) {
        const angkatan = el.dataset.angkatan;
        const total = parseInt(el.dataset.total);

        const modal = document.getElementById('confirmModal');
        const title = document.getElementById('modalTitle');
        const msg = document.getElementById('modalMsg');
        const btn = document.getElementById('btnAction');
        const form = document.getElementById('confirmForm');
        const method = document.getElementById('formMethod');
        const icon = document.getElementById('modalIcon');

        // Reset state awal
        btn.classList.remove('hidden');

        if (total === 0) {
            // CASE: DATA KOSONG
            title.innerText = 'Data Sudah Kosong';
            msg.innerHTML = `Sistem tidak menemukan adanya data mahasiswa yang terdaftar untuk angkatan <b>20${angkatan}</b>. Oleh karena itu, tidak ada tindakan penghapusan yang perlu dilakukan saat ini. Silakan hubungi admin jika ini adalah sebuah kekeliruan.`;
            
            btn.classList.add('hidden'); // Sembunyikan tombol hapus
            icon.innerHTML = '<span class="material-symbols-outlined text-6xl text-blue-500">info</span>';
        } else {
            // CASE: ADA DATA (HAPUS MASSAL)
            title.innerText = `Hapus Massal Angkatan 20${angkatan}?`;
            msg.innerHTML = `Peringatan: Tindakan ini akan menghapus <b>${total} data mahasiswa</b> beserta seluruh berkas fisik yang telah mereka unggah ke dalam sistem secara permanen. Pastikan Anda telah melakukan backup data jika diperlukan karena tindakan ini tidak dapat dibatalkan kembali oleh sistem.`;
            
            btn.innerText = 'Ya, Hapus Semua';
            btn.className = 'w-full px-5 py-3 rounded-xl text-white font-bold bg-red-600 hover:bg-red-700 transition click-effect shadow-lg shadow-red-600/20';

            form.onsubmit = function(e) {
                e.preventDefault();
                submitBulkDelete(angkatan);
            };

            method.value = 'DELETE';
            icon.innerHTML = '<span class="material-symbols-outlined text-6xl text-red-600 animate-bounce">warning</span>';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Pastikan fungsi closeConfirm juga mereset tampilan tombol
    function closeConfirm() {
        const modal = document.getElementById('confirmModal');
        const btn = document.getElementById('btnAction');
        
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        
        // Reset tombol aksi agar muncul kembali di pemanggilan berikutnya
        setTimeout(() => {
            btn.classList.remove('hidden');
        }, 300);
    }

    // Eksekusi Hapus Massal via AJAX
    async function submitBulkDelete(angkatan) {
        const btn = document.getElementById('btnAction');
        const origText = btn.innerText;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Memproses...';
        btn.disabled = true;

        try {
            const response = await fetch("{{ route('admin.mahasiswa.bulk_delete') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ 
                    angkatan: angkatan,
                    _method: 'DELETE' 
                })
            });

            const result = await response.json();

            if (result.success) {
                // LANGSUNG TUTUP MODAL
                closeConfirm();
                
                // Segarkan halaman seketika agar tabelnya langsung kosong
                window.location.reload();
            } else {
                alert(result.message);
                btn.innerText = origText;
                btn.disabled = false;
            }
        } catch (error) {
            alert('Terjadi kesalahan koneksi.');
            btn.innerText = origText;
            btn.disabled = false;
        }
    }
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