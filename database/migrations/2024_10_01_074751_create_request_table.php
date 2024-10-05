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
        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id')->unique(); // Kolom kelas_id
            $table->unsignedBigInteger('mahasiswa_id')->unique(); // Kolom mahasiswa_id
            $table->string('keterangan'); // Kolom keterangan
            $table->timestamps();

             // Definisi foreign key jika diperlukan
             $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
             $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
