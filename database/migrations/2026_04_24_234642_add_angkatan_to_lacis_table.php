<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lacis', function (Blueprint $table) {
            // Kita tambahkan kolom angkatan (2 digit) setelah kolom nama_laci
            $table->string('angkatan', 2)->nullable()->after('nama_laci');
        });
    }

    public function down(): void
    {
        Schema::table('lacis', function (Blueprint $table) {
            $table->dropColumn('angkatan');
        });
    }
};