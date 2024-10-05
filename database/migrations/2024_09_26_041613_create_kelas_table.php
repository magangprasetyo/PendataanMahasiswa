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
            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->string('nama'); // Kolom untuk Nomor Induk Mahasiswa
                $table->string('jumlah')->nullable(); // Kolom untuk Nama Mahasiswa
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
