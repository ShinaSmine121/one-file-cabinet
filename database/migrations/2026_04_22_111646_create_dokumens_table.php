<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID Mahasiswa
            $table->foreignId('laci_id')->constrained('lacis')->onDelete('cascade'); // ID Laci
            $table->string('nama_file_asli'); // Nama file sebelum diubah
            $table->string('nama_file_sistem'); // Nama otomatis: NIM_Laci_Tanggal.pdf
            $table->string('path_file'); // Lokasi file di server
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending'); // Status dosen
            $table->text('catatan_dosen')->nullable(); // Pesan dari dosen jika ada yang salah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
