<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'laci_id',
        'nama_file_asli',
        'nama_file_sistem',
        'path_file',
        'status',
        'catatan_dosen',
    ];

    // Hubungan ke tabel User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hubungan ke tabel Laci
    public function laci()
    {
        return $this->belongsTo(Laci::class);
    }
}