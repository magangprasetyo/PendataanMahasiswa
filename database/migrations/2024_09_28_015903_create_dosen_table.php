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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kolom untuk ID pengguna yang terhubung
            $table->unsignedBigInteger('kelas_id')->nullable(); // Kolom untuk ID kelas
            $table->string('kode_dosen')->unique(); // Kolom untuk Nomor Induk Mahasiswa
            $table->string('nip'); // Kolom untuk Nama Mahasiswa
            $table->string('nama'); // Kolom untuk Tempat Lahir
            $table->timestamps();

            // Menambahkan foreign key constraint (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade'); // Sesuaikan dengan tabel kelas yang ada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
