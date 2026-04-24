<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 Akun Admin UHO
        User::create([
            'name' => 'Admin Lembaga TI',
            'email' => 'admin.ti@uho.ac.id',
            'role' => 'admin',
            'password' => Hash::make('admin123'), // Password untuk login admin
        ]);
    }
}