<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laci;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua data laci dari database
        $lacis = Laci::all();
        // Mengambil riwayat dokumen yang pernah diupload mahasiswa ini
        $dokumens = Dokumen::where('user_id', Auth::id())->latest()->get();

        return view('mahasiswa.dashboard', compact('lacis', 'dokumens'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'laci_id' => 'required',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx|max:5120', // Maks 5MB
        ]);

        $user = Auth::user();
        $laci = Laci::findOrFail($request->laci_id);
        $file = $request->file('file_dokumen');

        // Logika Penamaan Otomatis: NIM_NamaLaci_Tanggal.pdf
        $namaLaciBersih = str_replace(' ', '', $laci->nama_laci); // Hilangkan spasi
        $ekstensi = $file->getClientOriginalExtension();
        $tanggal = now()->format('d-m-Y');
        
        $namaFileSistem = $user->nim . '_' . $namaLaciBersih . '_' . $tanggal . '.' . $ekstensi;
        $namaFileAsli = $file->getClientOriginalName();

        // Simpan file ke dalam folder 'storage/app/public/dokumen_mahasiswa'
        $path = $file->storeAs('public/dokumen_mahasiswa', $namaFileSistem);

        // Simpan logikanya ke Database
        Dokumen::create([
            'user_id' => $user->id,
            'laci_id' => $laci->id,
            'nama_file_asli' => $namaFileAsli,
            'nama_file_sistem' => $namaFileSistem,
            'path_file' => $path,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah ke ' . $laci->nama_laci);
    }

    public function berkasSaya()
    {
        // Ambil semua laci
        $lacis = \App\Models\Laci::all();
        
        // Ambil semua dokumen khusus milik mahasiswa yang sedang login
        $dokumens = \App\Models\Dokumen::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        
        // Kirim KEDUA variabel tersebut ke view
        return view('mahasiswa.berkas', compact('lacis', 'dokumens'));
    }

    public function riwayatBerkas()
    {
        // Mengambil dokumen untuk riwayat (lengkap dengan data laci)
        $dokumens = \App\Models\Dokumen::where('user_id', \Illuminate\Support\Facades\Auth::id())->with('laci')->latest()->get();
        return view('mahasiswa.riwayat', compact('dokumens'));
    }

    public function hapusBerkas($id)
    {
        // Pastikan hanya pemilik file yang bisa menghapus
        $dokumen = \App\Models\Dokumen::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        
        // Hapus file fisik dari storage
        if (\Illuminate\Support\Facades\Storage::exists($dokumen->path_file)) {
            \Illuminate\Support\Facades\Storage::delete($dokumen->path_file);
        }
        
        // Hapus data dari database
        $dokumen->delete();
        
        return back()->with('success', 'Berkas berhasil dihapus.');
    }

    public function downloadBerkas($id)
    {
        // Pastikan mahasiswa hanya bisa mengunduh berkas miliknya sendiri
        $dokumen = \App\Models\Dokumen::where('id', $id)
                    ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                    ->firstOrFail();
        
        if (\Illuminate\Support\Facades\Storage::exists($dokumen->path_file)) {
            return \Illuminate\Support\Facades\Storage::download($dokumen->path_file, $dokumen->nama_file_asli);
        }

        return back()->with('error', 'File tidak ditemukan di server.');
    }


    public function updateNama(Request $request)
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());

        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'password' => 'required|string|min:6', // Minimal 6 karakter
        ], [
            'password.min' => 'Password baru minimal harus 6 karakter.'
        ]);

        // Mencegah mahasiswa menggunakan NIM sebagai password baru
        if ($request->password === $user->nim) {
            return back()->withErrors(['password' => 'Password baru tidak boleh sama dengan NIM Anda demi keamanan.']);
        }

        $user->update([
            'name' => $request->name,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        return back()->with('success', 'Profil dan Password berhasil diperbarui! Selamat datang, ' . $user->name);
    }

}