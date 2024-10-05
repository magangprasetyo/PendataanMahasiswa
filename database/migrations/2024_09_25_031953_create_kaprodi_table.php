<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaprodiTable extends Migration
{
    public function up()
    {
        Schema::create('kaprodi', function (Blueprint $table) {
            $table->id(); // Kolom primary key id
            $table->unsignedBigInteger('user_id'); // Kolom user_id
            $table->string('kode_kaprodi'); // Kolom kode_kaprodi
            $table->string('nip'); // Kolom nip
            $table->string('nama'); // Kolom nama
            $table->timestamps(); // Jika ingin menambahkan timestamps

            // Menambahkan foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kaprodi');
    }
}
