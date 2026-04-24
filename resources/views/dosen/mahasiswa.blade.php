<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar Mahasiswa | One File Cabinet UHO</title>
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

{{-- SIDEBAR (KONSISTEN DENGAN DASHBOARD) --}}
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

{{-- HEADER + MAIN (MARGIN LEFT w-56) --}}
<div class="ml-56 min-h-screen flex flex-col">
    <header class="w-full h-16 sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-6 h-full">
            <h2 class="text-xl font-bold text-[#1E3A8A]">Database Arsip Mahasiswa</h2>
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
        {{-- FILTER & SEARCH --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm mb-6">
            <form action="{{ route('dosen.mahasiswa.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIM mahasiswa..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-2 focus:ring-[#1E3A8A] text-sm">
                </div>
                <div class="relative">
                    <select name="angkatan" class="border border-slate-200 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-[#1E3A8A] bg-white text-sm font-medium text-slate-600 appearance-none pr-10">
                        <option value="">Semua Angkatan</option>
                        @foreach($listAngkatan as $thn)
                            <option value="{{ $thn }}" {{ request('angkatan') == $thn ? 'selected' : '' }}>20{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-[#1E3A8A] text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-blue-900 transition-all shadow-md click-effect hover-gradiant-primary">
                    Filter
                </button>
            </form>
        </div>

        {{-- TABEL DAFTAR MAHASISWA --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-white text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-4 text-left">Identitas Mahasiswa</th>
                            <th class="p-4 text-center">Total Berkas</th>
                            <th class="p-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($mahasiswas as $mhs)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4">
                                <div class="font-bold text-slate-900">{{ $mhs->name }}</div>
                                <div class="text-[10px] text-slate-400 font-medium">NIM: {{ $mhs->nim }}</div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-[10px] font-black border border-blue-100">
                                    {{ $mhs->dokumens_count }} Berkas
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <a href="{{ route('dosen.mahasiswa.arsip', $mhs->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-[#1E3A8A] font-bold text-xs rounded-lg hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm click-effect">
                                    <span class="material-symbols-outlined text-[18px]">folder_shared</span> Buka Arsip
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-12 text-center">
                                <div class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="material-symbols-outlined text-4xl">person_search</span>
                                </div>
                                <h4 class="text-slate-900 font-bold text-lg">Tidak Ada Data</h4>
                                <p class="text-slate-500 text-sm mt-1">Mahasiswa tidak ditemukan dengan filter tersebut.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($mahasiswas, 'links'))
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $mahasiswas->links() }}
            </div>
            @endif
        </div>
    </main>
</div>

</body>
</html>