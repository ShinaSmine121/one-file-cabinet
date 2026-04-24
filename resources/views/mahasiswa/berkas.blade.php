<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Berkas Saya | One File Cabinet</title>
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
        .modal-enter {
            transform: scale(0.95);
            opacity: 0;
        }
        .modal-enter-active {
            transform: scale(1);
            opacity: 1;
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="flex font-body-md text-slate-900">

{{-- SIDEBAR (IDENTIK DENGAN DASHBOARD) --}}
<nav class="h-screen w-56 border-r flex flex-col fixed left-0 top-0 bg-white shadow-sm z-40">
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
            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>
            <a href="{{ route('mahasiswa.berkas') }}" class="flex items-center gap-3 bg-slate-50 text-[#1E3A8A] border-r-4 border-[#1E3A8A] font-bold px-4 py-2.5">
                <span class="material-symbols-outlined">folder_open</span>
                <span class="text-sm">Berkas Saya</span>
            </a>
            <a href="{{ route('mahasiswa.riwayat') }}" class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-2.5">
                <span class="material-symbols-outlined">history</span>
                <span class="text-sm">Riwayat Berkas</span>
            </a>
        </div>

        <div class="mt-auto pt-6 border-t border-slate-100">
            <form action="{{ route('login') }}" method="GET">
                <button type="submit" class="flex items-center w-full gap-3 text-red-600 hover:bg-red-50 px-4 py-2.5 click-effect">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-bold">Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- HEADER + MAIN (ML-56) --}}
<div class="ml-56 min-h-screen flex flex-col w-full">
    <header class="w-full h-16 sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-6 h-full">
            <h2 class="text-xl font-bold text-[#1E3A8A]">Berkas Saya</h2>
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

    <main class="p-6 w-full max-w-[1400px]">
        @if(session('success'))
            <div id="autoHideSuccess" class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <p class="text-slate-500">Klik pada laci untuk melihat dan mengelola berkas yang telah diunggah.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($lacis as $laci)
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-11 h-11 bg-blue-100 text-blue-800 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">folder</span>
                        </div>
                        <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full">
                            {{ $dokumens->where('laci_id', $laci->id)->count() }} Berkas
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $laci->nama_laci }}</h3>
                    <p class="text-sm text-slate-500 mb-5 line-clamp-2">{{ $laci->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    <button onclick="openLaciModal('{{ $laci->id }}')" 
                            class="w-full bg-white border border-slate-300 text-slate-700 font-medium py-2.5 px-4 rounded-lg hover:bg-slate-50 transition-colors flex items-center justify-center gap-2 click-effect">
                        <span class="material-symbols-outlined text-lg">visibility</span>
                        Lihat Berkas
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full p-12 bg-white rounded-xl border border-dashed border-slate-300 text-center">
                <span class="material-symbols-outlined text-5xl text-slate-300 mb-3">inventory_2</span>
                <p class="text-slate-500">Belum ada laci yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </main>
</div>

{{-- MODAL DAFTAR BERKAS --}}
<div id="laciModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-3xl w-full max-h-[80vh] flex flex-col shadow-2xl modal-enter">
        <div class="p-6 border-b flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-slate-900" id="modalLaciTitle">Nama Laci</h3>
                <p class="text-sm text-slate-500" id="modalLaciDesc"></p>
            </div>
            <button onclick="closeLaciModal()" class="text-slate-400 hover:text-red-500 p-1 click-effect">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 overflow-y-auto flex-1" id="modalFileList"></div>
        <div class="p-4 border-t bg-slate-50 flex justify-end">
            <button onclick="closeLaciModal()" class="px-5 py-2 bg-[#1E3A8A] text-white rounded-lg font-bold hover:bg-blue-900 transition-colors shadow-md click-effect">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- MODAL KONFIRMASI --}}
<div id="confirmModal" class="fixed inset-0 bg-black/60 hidden z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl text-center modal-enter">
        <div id="confirmIcon" class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4"></div>
        <h3 id="confirmTitle" class="text-xl font-bold text-slate-900 mb-2">Konfirmasi</h3>
        <p id="confirmMessage" class="text-slate-500 mb-6 text-sm"></p>
        <div class="flex gap-3">
            <button onclick="closeConfirm()" class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 click-effect">Batal</button>
            <button id="confirmActionBtn" class="flex-1 px-4 py-2.5 rounded-xl font-bold text-white shadow-lg transition-all click-effect"></button>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@php
    $lacisData = $lacis->mapWithKeys(function ($laci) use ($dokumens) {
        return [
            $laci->id => [
                'nama_laci' => $laci->nama_laci,
                'deskripsi' => $laci->deskripsi,
                'dokumens' => $dokumens->where('laci_id', $laci->id)->map(function ($dok) {
                    return [
                        'nama_file_asli' => $dok->nama_file_asli,
                        'created_at' => $dok->created_at->format('d M Y'),
                        'status' => $dok->status,
                        'download_url' => route('mahasiswa.download', $dok->id),
                        'delete_url' => route('mahasiswa.hapus', $dok->id),
                    ];
                })->values()->all(),
            ]
        ];
    });
@endphp

<script type="application/json" id="lacisData">{!! json_encode($lacisData) !!}</script>

<script>
    const lacisData = JSON.parse(document.getElementById('lacisData').textContent);

    function openLaciModal(laciId) {
        const laci = lacisData[laciId];
        document.getElementById('modalLaciTitle').innerText = laci.nama_laci;
        document.getElementById('modalLaciDesc').innerText = laci.deskripsi || 'Manajemen berkas dalam laci ini.';
        const fileListDiv = document.getElementById('modalFileList');
        
        if (laci.dokumens.length === 0) {
            fileListDiv.innerHTML = `<div class="text-center py-10 text-slate-500"><span class="material-symbols-outlined text-5xl mb-3 text-slate-200">folder_open</span><p>Belum ada berkas.</p></div>`;
        } else {
            let html = `<div class="space-y-3">`;
            laci.dokumens.forEach(dok => {
                html += `
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200 group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-red-500 text-3xl">picture_as_pdf</span>
                            <div>
                                <p class="font-bold text-sm text-slate-800">${dok.nama_file_asli}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">${dok.created_at} • ${dok.status}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="askConfirm('download', '${dok.download_url}')" class="p-2 bg-white border border-slate-200 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm click-effect" title="Unduh">
                                <span class="material-symbols-outlined text-xl">download</span>
                            </button>
                            <button onclick="askConfirm('delete', '${dok.delete_url}')" class="p-2 bg-white border border-slate-200 text-slate-400 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm click-effect" title="Hapus">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    </div>
                `;
            });
            fileListDiv.innerHTML = html + `</div>`;
        }
        const modal = document.getElementById('laciModal');
        modal.classList.remove('hidden');
        modal.querySelector('.modal-enter').classList.add('modal-enter-active');
    }

    function askConfirm(type, url) {
        const modal = document.getElementById('confirmModal');
        const iconBox = document.getElementById('confirmIcon');
        const actionBtn = document.getElementById('confirmActionBtn');
        const title = document.getElementById('confirmTitle');
        const msg = document.getElementById('confirmMessage');

        if (type === 'delete') {
            iconBox.className = "w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 bg-red-100 text-red-600";
            iconBox.innerHTML = '<span class="material-symbols-outlined text-3xl">delete_forever</span>';
            title.innerText = "Hapus Berkas?";
            msg.innerText = "Tindakan ini permanen. Berkas Anda akan hilang dari sistem dan tidak dapat dikembalikan.";
            actionBtn.innerText = "Ya, Hapus";
            actionBtn.className = "flex-1 px-4 py-2.5 rounded-xl font-bold text-white shadow-lg bg-red-600 hover:bg-red-700 click-effect";
            actionBtn.onclick = () => {
                const form = document.getElementById('deleteForm');
                form.action = url;
                form.submit();
            };
        } else {
            iconBox.className = "w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 bg-blue-100 text-blue-600";
            iconBox.innerHTML = '<span class="material-symbols-outlined text-3xl">download</span>';
            title.innerText = "Unduh Berkas?";
            msg.innerText = "Apakah Anda ingin mengunduh salinan berkas ini ke perangkat Anda?";
            actionBtn.innerText = "Unduh";
            actionBtn.className = "flex-1 px-4 py-2.5 rounded-xl font-bold text-white shadow-lg bg-blue-900 hover:bg-blue-800 click-effect";
            actionBtn.onclick = () => { window.location.href = url; closeConfirm(); };
        }
        modal.classList.remove('hidden');
        modal.querySelector('.modal-enter').classList.add('modal-enter-active');
    }

    function closeLaciModal() { 
        const modal = document.getElementById('laciModal');
        modal.classList.add('hidden');
    }
    function closeConfirm() { 
        const modal = document.getElementById('confirmModal');
        modal.classList.add('hidden');
    }

    document.getElementById('laciModal').addEventListener('click', function(e) {
        if (e.target === this) closeLaciModal();
    });
    document.getElementById('confirmModal').addEventListener('click', function(e) {
        if (e.target === this) closeConfirm();
    });

    // Auto-hide success notification after 3 seconds
    const successAlert = document.getElementById('autoHideSuccess');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.3s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 300);
        }, 1500);
    }
</script>
</body>
</html>