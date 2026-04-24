<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Manajemen Dosen | One File Cabinet UHO</title>

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
            <a class="flex items-center gap-4 text-slate-500 hover:bg-slate-50 px-6 py-3 transition-colors click-effect" href="{{ route('admin.mahasiswa.index') }}">
                <span class="material-symbols-outlined">group</span>
                <span class="font-label-md">Manajemen Mahasiswa</span>
            </a>
            <a class="flex items-center gap-4 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-6 py-3 click-effect" href="{{ route('admin.dosen.index') }}">
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

    <header class="w-full h-16 sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-8 h-full mx-auto w-full">
            <h2 class="text-xl font-bold text-[#1E3A8A]">Manajemen Dosen</h2>
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

    <main class="p-8 mx-auto w-full space-y-6">

        {{-- NOTIFIKASI SUKSES OTOMATIS HILANG --}}
        @if(session('success'))
            <div id="autoHideSuccess" class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2 animate-reveal">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER CARD --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden p-6">
            <form method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Cari Nama atau Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#1E3A8A] outline-none"
                               placeholder="Ketik nama atau email dosen">
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-[#1E3A8A] text-white px-6 py-2.5 rounded-lg font-bold transition-all flex items-center gap-2 click-effect hover-gradiant-primary">
                        <span class="material-symbols-outlined text-sm">search</span> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.dosen.index') }}" class="border border-slate-300 text-slate-700 px-4 py-2.5 rounded-lg font-medium hover:bg-slate-50 transition-colors flex items-center click-effect">
                            <span class="material-symbols-outlined text-sm">close</span> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- TABEL DOSEN --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="p-4 text-left font-semibold">Dosen</th>
                            <th class="p-4 text-left font-semibold">Email Kampus</th>
                            <th class="p-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dosens as $dsn)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4">
                                <div class="font-semibold text-slate-900">{{ $dsn->name }}</div>
                            </td>
                            <td class="p-4">
                                <span class="text-sm text-slate-500">{{ $dsn->email }}</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-1">
                                    <button onclick="askConfirm('reset', `{{ route('admin.dosen.reset', $dsn->id) }}`, `{{ $dsn->name }}`)"
                                        class="p-2.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors click-effect" title="Reset Password">
                                        <span class="material-symbols-outlined">lock_reset</span>
                                    </button>
                                    <button onclick="askConfirm('delete', `{{ route('admin.dosen.destroy', $dsn->id) }}`, `{{ $dsn->name }}`)"
                                        class="p-2.5 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors click-effect" title="Hapus Dosen">
                                        <span class="material-symbols-outlined">person_remove</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-slate-500">
                                <span class="material-symbols-outlined text-3xl mb-2">search_off</span>
                                <p>Tidak ada data dosen ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($dosens, 'links'))
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $dosens->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

{{-- MODAL KONFIRMASI --}}
<div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[60] backdrop-blur-sm">
    <div class="bg-white p-6 rounded-xl w-[400px] max-w-[90%] shadow-xl animate-reveal">
        <div id="modalIcon" class="mb-3 text-center"></div>
        <h3 id="modalTitle" class="font-bold text-lg text-slate-900 mb-1"></h3>
        <p id="modalMsg" class="text-sm text-slate-500 mb-6"></p>

        <div class="flex gap-3 justify-end">
            <button onclick="closeConfirm()" class="px-5 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 font-medium transition click-effect">Batal</button>
            <form id="confirmForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod">
                <button id="btnAction" class="px-5 py-2 rounded-lg text-white font-medium transition click-effect"></button>
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
            title.innerText = 'Hapus Dosen?';
            msg.innerText = `Anda akan menghapus akun "${name}" secara permanen. Lanjutkan?`;
            btn.innerText = 'Ya, Hapus';
            btn.className = 'px-5 py-2 rounded-lg text-white font-medium bg-red-600 hover:bg-red-700 transition click-effect';
            method.value = 'DELETE';
            icon.innerHTML = '<span class="material-symbols-outlined text-4xl text-red-500">person_remove</span>';
        } else {
            title.innerText = 'Reset Password?';
            msg.innerText = `Password untuk "${name}" akan direset ke default (dosen123). Lanjutkan?`;
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
</script>

</body>
</html>