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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kolom untuk ID pengguna yang terhubung
            $table->unsignedBigInteger('kelas_id')->nullable()->after('id'); // Kolom untuk ID kelas, diubah menjadi nullable
            $table->string('nim')->unique(); // Kolom untuk Nomor Induk Mahasiswa
            $table->string('nama'); // Kolom untuk Nama Mahasiswa   
            $table->string('tempat_lahir'); // Kolom untuk Tempat Lahir
            $table->date('tanggal_lahir'); // Kolom untuk Tanggal Lahir
            $table->boolean('edit')->default(false); // Kolom boolean untuk edit, default false
            $table->timestamps();
        
            // Menambahkan foreign key constraint (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->nullable(); // Menambahkan nullable di foreign key
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
