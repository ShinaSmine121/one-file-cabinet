<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laci extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_laci',
        'deskripsi',
        'angkatan',
    ];

    /**
     * Relasi ke dokumen (satu laci bisa memiliki banyak dokumen)
     */
    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'laci_id');
    }
}