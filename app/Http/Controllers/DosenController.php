<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\User;
use App\Models\Laci;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Dashboard Dosen - Menampilkan statistik dan antrean dokumen pending.
     */
    public function index(Request $request)
    {
        // 1. Statistik untuk kartu
        $totalDokumen = Dokumen::count();
        $pendingCount = Dokumen::where('status', 'pending')->count();
        $disetujuiCount = Dokumen::where('status', 'disetujui')->count();
        $ditolakCount = Dokumen::where('status', 'ditolak')->count();

        // 2. Query untuk dokumen pending (meja kerja)
        $query = Dokumen::with(['user', 'laci'])->where('status', 'pending');

        // Pencarian berdasarkan nama/NIM mahasiswa
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan angkatan (dua digit terakhir NIM)
        if ($request->filled('angkatan')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nim', 'like', 'E1E1' . $request->angkatan . '%');
            });
        }

        $dokumenPending = $query->latest()->get();

        // 3. Daftar angkatan untuk dropdown filter
        $listAngkatan = User::where('role', 'mahasiswa')
            ->whereNotNull('nim')
            ->selectRaw('SUBSTRING(nim, 5, 2) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Kirim semua variabel yang dibutuhkan view
        return view('dosen.dashboard', compact(
            'totalDokumen',
            'pendingCount',
            'disetujuiCount',
            'ditolakCount',
            'dokumenPending',
            'listAngkatan'
        ));
    }

    /**
     * Download file dokumen.
     */
    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (Storage::exists($dokumen->path_file)) {
            return Storage::download($dokumen->path_file, $dokumen->nama_file_asli);
        }

        return back()->with('error', 'File tidak ditemukan di server.');
    }

    /**
     * Preview file dokumen langsung di browser (Inline).
     */
    public function preview($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (Storage::exists($dokumen->path_file)) {
            return Storage::response($dokumen->path_file);
        }

        return back()->with('error', 'File tidak ditemukan di server.');
    }


    /**
     * Update status review dokumen (setujui/tolak + catatan).
     */
    public function updateStatus(Request $request, $id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        
        $dokumen->update([
            'status' => $request->status,
            'catatan_dosen' => $request->catatan_dosen
        ]);

        // CEK JIKA INI PERMINTAAN AJAX DARI JAVASCRIPT
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Review berhasil disimpan',
                'status' => $request->status
            ]);
        }

        // Jika bukan AJAX (fallback)
        return back()->with('success', 'Review berhasil disimpan.');
    }

    /**
     * Menampilkan daftar mahasiswa beserta filter angkatan dan pencarian.
     */
    public function mahasiswaIndex(Request $request)
    {
        $query = User::where('role', 'mahasiswa');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('angkatan')) {
            $query->where('nim', 'like', 'E1E1' . $request->angkatan . '%');
        }

        $mahasiswas = $query->withCount('dokumens')->orderBy('nim', 'asc')->paginate(10);

        $listAngkatan = User::where('role', 'mahasiswa')
            ->whereNotNull('nim')
            ->selectRaw('SUBSTRING(nim, 5, 2) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('dosen.mahasiswa', compact('mahasiswas', 'listAngkatan'));
    }

    public function arsipMahasiswa($id)
    {
        // 1. Cari data mahasiswa
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        
        // 2. Ambil 2 digit angkatan dari NIM mahasiswa
        $angkatanMhs = substr($mahasiswa->nim, 4, 2);

        // 3. Terapkan filter laci sesuai angkatan mahasiswa tersebut
        $lacis = Laci::where('angkatan', $angkatanMhs)
                     ->orWhereNull('angkatan')
                     ->get();

        $dokumens = Dokumen::where('user_id', $id)->get();

        return view('dosen.arsip', compact('mahasiswa', 'lacis', 'dokumens'));
    }
}