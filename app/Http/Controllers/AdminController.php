<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Fungsi untuk meng-generate akun mahasiswa satu angkatan
    public function generateMahasiswaMassal(Request $request)
    {
        // Validasi input dari form admin
        $request->validate([
            'angkatan' => 'required|numeric|digits:2', // Contoh input: 23
            'jumlah' => 'required|numeric|min:1'       // Contoh input: 70
        ]);

        $angkatan = $request->angkatan;
        $jumlah = $request->jumlah;
        $prefix = 'E1E1';

        for ($i = 1; $i <= $jumlah; $i++) {
            // str_pad mengubah angka 1 menjadi '001', 12 menjadi '012', dst.
            $urutan = str_pad($i, 3, '0', STR_PAD_LEFT);
            $nim = $prefix . $angkatan . $urutan; // Hasil akhir: E1E123001

            // Cek apakah NIM sudah ada agar tidak error jika terklik dua kali
            if(!User::where('nim', $nim)->exists()){
                User::create([
                    'name' => 'Mahasiswa ' . $nim, // Nama sementara, bisa diubah mahasiswa nanti
                    'nim' => $nim,
                    'role' => 'mahasiswa',
                    // Password default disamakan dengan NIM
                    'password' => Hash::make($nim), 
                ]);
            }
        }

        return back()->with('success', "$jumlah Akun mahasiswa angkatan 20$angkatan berhasil dibuat!");
    }
    public function storeUserManual(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:mahasiswa,dosen',
            'password' => 'required|min:6',
            // Jika mahasiswa wajib NIM, jika dosen wajib Email
            'nim' => 'required_if:role,mahasiswa|unique:users,nim',
            'email' => 'required_if:role,dosen|email|unique:users,email',
        ]);

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'nim' => $request->role == 'mahasiswa' ? $request->nim : null,
            'email' => $request->role == 'dosen' ? $request->email : null,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Akun ' . $request->role . ' baru berhasil dibuat secara manual!');
    }

    // Laci Index
    public function laciIndex(Request $request)
    {
        $query = \App\Models\Laci::query();

        // 1. Logika Filter: Jika ada input angkatan dari dropdown
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        $lacis = $query->latest()->get();

        // 2. Ambil daftar angkatan unik untuk mengisi pilihan di dropdown filter
        $listAngkatan = \App\Models\Laci::whereNotNull('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        return view('admin.laci', compact('lacis', 'listAngkatan'));
    }

    // Menyimpan laci baru dengan angkatan
    public function laciStore(Request $request)
    {
        // Validasi: nama laci wajib ada, angkatan wajib angka 2 digit
        $request->validate([
            'nama_laci' => 'required',
            'angkatan' => 'required|numeric|digits:2'
        ]);

        \App\Models\Laci::create([
            'nama_laci' => $request->nama_laci,
            'angkatan' => $request->angkatan
        ]);

        return back()->with('success', 'Laci baru untuk angkatan 20' . $request->angkatan . ' berhasil ditambahkan!');
    }

    // Menghapus laci
    public function laciDestroy($id)
    {
        $laci = \App\Models\Laci::findOrFail($id);
        $laci->delete();
        return back()->with('success', 'Laci berhasil dihapus.');
    }

    public function mahasiswaIndex(Request $request)
    {
        $query = \App\Models\User::where('role', 'mahasiswa');

        // 1. Fitur Search (Nama atau NIM)
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Fitur Filter Angkatan (Mengambil 2 digit di tengah NIM: E1E1**22**001)
        if ($request->has('angkatan') && $request->angkatan != '') {
            $query->where('nim', 'like', 'E1E1' . $request->angkatan . '%');
        }

        // 3. Ambil data dengan hitungan dokumen (Indikator Aktivitas)
        $mahasiswas = $query->withCount('dokumens')->orderBy('nim', 'asc')->paginate(10);

        // 4. Ambil daftar angkatan yang TERSEDIA di database secara dinamis
        $listAngkatan = \App\Models\User::where('role', 'mahasiswa')
            ->whereNotNull('nim')
            ->selectRaw('SUBSTRING(nim, 5, 2) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.mahasiswa', compact('mahasiswas', 'listAngkatan'));
    }

    // Fitur Reset Password (Kembali ke NIM)
    public function resetPassword($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($user->nim)
        ]);
        return back()->with('success', 'Password ' . $user->name . ' berhasil direset ke default (NIM).');
    }

    // Fitur Hapus Akun (Dinamis)
    public function destroyUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Simpan role-nya dulu dan jadikan huruf kapital di awal (Mahasiswa / Dosen)
        $roleName = ucfirst($user->role);
        
        // Hapus akun
        $user->delete();
        
        // Kirim pesan sukses secara dinamis
        return back()->with('success', 'Akun ' . $roleName . ' berhasil dihapus.');
    }

    // --- FITUR DOSEN ---

    public function dosenIndex(Request $request)
    {
        $query = \App\Models\User::where('role', 'dosen');

        // Pencarian berdasarkan Nama atau Email
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $dosens = $query->orderBy('name', 'asc')->paginate(10);
        return view('admin.dosen', compact('dosens'));
    }

    // Reset Password Dosen (Default: dosen123)
    public function resetPasswordDosen($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make('dosen123')
        ]);
        return back()->with('success', 'Password Dosen ' . $user->name . ' berhasil direset ke "dosen123".');
    }

    public function storeUser(Request $request)
    {
        // Validasi data dasar
        $request->validate([
            'role' => 'required|in:mahasiswa,dosen',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $userData = [
            'name' => $request->name,
            'role' => $request->role,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ];

        if ($request->role === 'mahasiswa') {
            // Gabungkan E1E1 + Angkatan + Nomor Absen (dipastikan 3 digit)
            $nim = 'E1E1' . $request->angkatan . str_pad($request->absen, 3, '0', STR_PAD_LEFT);
            
            // Cek apakah NIM sudah ada
            if (\App\Models\User::where('nim', $nim)->exists()) {
                return back()->with('error', 'Gagal! NIM ' . $nim . ' sudah terdaftar.');
            }
            $userData['nim'] = $nim;
            
        } elseif ($request->role === 'dosen') {
            // Cek apakah Email Dosen sudah ada
            if (\App\Models\User::where('email', $request->email)->exists()) {
                return back()->with('error', 'Gagal! Email ' . $request->email . ' sudah terdaftar.');
            }
            $userData['email'] = $request->email;
        }

        \App\Models\User::create($userData);

        return back()->with('success', 'Akun ' . ucfirst($request->role) . ' baru berhasil ditambahkan!');
    }

    public function arsipMahasiswa($id)
    {
        // 1. Cari data mahasiswa yang dimaksud
        $mahasiswa = \App\Models\User::where('role', 'mahasiswa')->findOrFail($id);
        
        // 2. Ambil 2 digit angkatan dari NIM mahasiswa tersebut
        $angkatanMhs = substr($mahasiswa->nim, 4, 2);

        // 3. Filter laci: Hanya tampilkan laci yang angkatannya cocok 
        // atau laci umum (angkatan null)
        $lacis = \App\Models\Laci::where('angkatan', $angkatanMhs)
                                 ->orWhereNull('angkatan')
                                 ->get();

        $dokumens = \App\Models\Dokumen::where('user_id', $id)->get();

        return view('admin.arsip', compact('mahasiswa', 'lacis', 'dokumens'));
    }

    public function updateStatusDokumen(Request $request, $id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        $dokumen->update([
            'status' => $request->status,
            'catatan_dosen' => $request->catatan_dosen
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Review berhasil disimpan',
                'status' => $request->status
            ]);
        }
        return back();
    }

    public function destroyDokumen(Request $request, $id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        
        // Hapus file fisiknya dari storage (opsional, pastikan sesuaikan dengan sistemmu)
        // Storage::delete($dokumen->path_file);
        
        $dokumen->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil dihapus permanen'
            ]);
        }
        return back();
    }

    public function download($id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);

        // Gunakan Storage facade agar konsisten dengan DosenController
        if (!Storage::exists($dokumen->path_file)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        return Storage::download($dokumen->path_file, $dokumen->nama_file_asli);
    }

    public function preview($id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);

        if (!\Illuminate\Support\Facades\Storage::exists($dokumen->path_file)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        return \Illuminate\Support\Facades\Storage::response($dokumen->path_file);
    }    

    public function bulkDeleteMahasiswa(Request $request)
    {
        $angkatan = $request->angkatan;
        if (!$angkatan) {
            return response()->json(['success' => false, 'message' => 'Angkatan tidak ditentukan.'], 400);
        }

        // Cari semua mahasiswa di angkatan tersebut (Prefix E1E1 + Angkatan)
        $users = \App\Models\User::where('role', 'mahasiswa')
                    ->where('nim', 'like', 'E1E1' . $angkatan . '%')
                    ->get();

        $userCount = $users->count();
        if ($userCount === 0) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data mahasiswa untuk angkatan ini.'], 404);
        }

        // Ambil ID semua mahasiswa tersebut untuk menghapus dokumennya
        $userIds = $users->pluck('id');
        $dokumens = \App\Models\Dokumen::whereIn('user_id', $userIds)->get();
        $dokumenCount = $dokumens->count();

        // 1. Hapus file fisik dari storage agar tidak memenuhi server
        foreach ($dokumens as $dok) {
            if (\Illuminate\Support\Facades\Storage::exists($dok->path_file)) {
                \Illuminate\Support\Facades\Storage::delete($dok->path_file);
            }
        }

        // 2. Hapus data dokumen & user dari database
        \App\Models\Dokumen::whereIn('user_id', $userIds)->delete();
        \App\Models\User::whereIn('id', $userIds)->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil! $userCount akun mahasiswa dan $dokumenCount dokumen angkatan 20$angkatan telah dihapus permanen."
        ]);
    }

}