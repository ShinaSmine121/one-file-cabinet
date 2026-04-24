<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi inputan tidak boleh kosong
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        $identifier = $request->identifier;
        $password = $request->password;

        // 2. Deteksi otomatis: Apakah ini Email (Dosen/Admin) atau NIM (Mahasiswa)?
        $loginType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        // 3. Siapkan kunci untuk dicocokkan ke database
        $credentials = [
            $loginType => $identifier,
            'password' => $password
        ];

        // 4. Proses pencocokan (Authentication)
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // 5. Jika sukses, cek role-nya untuk diarahkan ke laci yang tepat
            $role = Auth::user()->role;
            
            if ($role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Kita akan buat rute ini nanti
            } elseif ($role === 'dosen') {
                return redirect()->intended('/dosen/dashboard'); // Kita akan buat rute ini nanti
            } else {
                return redirect()->intended('/mahasiswa/dashboard'); // Kita akan buat rute ini nanti
            }
        }

        // 6. Jika gagal login (password salah / akun tidak ada)
        return back()->withErrors([
            'identifier' => 'NIM/Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('identifier');
    }
}